<?php

namespace common\models;

use Yii;
use yii\imagine\Image;
use yii\web\UploadedFile;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "book".
 *
 * @property int $id
 * @property string $title
 * @property int $up_year
 * @property string|null $descr
 * @property string $isbn
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Authorship[] $authorships
 */
class Book extends \yii\db\ActiveRecord
{

    public $authors = [];
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'book';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'up_year', 'isbn'], 'required'],
            [['up_year'], 'integer'],
            [['descr'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'isbn'], 'string', 'max' => 255],
            [['isbn'], 'unique'],
            [['photo'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg'],
            [['authors'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'up_year' => 'Up Year',
            'descr' => 'Descr',
            'isbn' => 'Isbn',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class => [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    public function afterSave($insert, $changedAttributes)
    {

        if (!$insert) {
            Authorship::deleteAll(['book_id' => $this->id]);
        } else {
            $subscribedUserIds = [];
            foreach ($this->authors as $authorId) {
                $authorship = new Authorship();
                $authorship->book_id = $this->id;
                $authorship->author_id = $authorId;
                $authorship->save();

                $subscribedUserIdsQuery = Subscribe::find()
                    ->where(['author_id' => $authorId])
                    ->all();

                $userIds = array_map(function($model) {
                    return $model->user_id;
                }, $subscribedUserIdsQuery);

                $userIds = array_unique($userIds);

                $subscribedUserIds = array_merge($subscribedUserIds, $userIds);
            }

            $users = User::find()
                ->where(['id' => $subscribedUserIds])
                ->all();

            foreach ($users as $user) {
                $message = "New book '{$this->title}' has been published by one of your subscribed authors!";
                Yii::$app->smsPilotSms->sendSms($user->phone, $message);
            }
        }
        parent::afterSave($insert, $changedAttributes);
        
    }

    public function upload()
    {
    if ($this->validate()) {
        $filePath = 'uploads/' . $this->photo->baseName . '.' . $this->photo->extension;
        
        $this->photo->saveAs($filePath);

        $resizedImagePath = 'uploads/resized_' . $this->photo->baseName . '.' . $this->photo->extension;

        \yii\imagine\Image::thumbnail($filePath, 300, 300)
            ->save($resizedImagePath, ['quality' => 80]);

        $this->photo = $resizedImagePath;
        return true;
    } else {
        return false;
    }
}

    /**
     * Gets query for [[Authorships]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthorships()
    {
        return $this->hasMany(Authorship::class, ['book_id' => 'id']);
    }
}
