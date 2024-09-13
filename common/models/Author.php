<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "author".
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string|null $surname
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Authorship[] $authorships
 */
class Author extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'author';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['first_name', 'last_name', 'surname'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'Имя',
            'last_name' => 'Фамилия',
            'surname' => 'Отчество',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function getTopByYearAndLimit($year, $limit = 10) 
    {
        $authors = self::getTopByYearAndLimitQuery($year, $limit)->all();

        $names = [];

        foreach ($authors as $author) {
            $names[] = $author->last_name . ' ' . $author->first_name . ' ' . $author->surname;
        }

        return $names;
    }

    /**
     * {@inheritdoc}
     */
    public static function getTopByYearAndLimitQuery($year, $limit = 10) 
    {
        return self::find()
        ->select(['author.*', 'COUNT(authorship.book_id) as book_count'])
        ->joinWith('authorships') // Связь с таблицей authorship
        ->joinWith('authorships.book') // Связь с книгами
        ->where(['book.up_year' => $year]) // Условие по году
        ->groupBy('author.id')
        ->orderBy(['book_count' => SORT_DESC]);
    }

    /**
     * Gets query for [[Authorships]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthorships()
    {
        return $this->hasMany(Authorship::class, ['author_id' => 'id']);
    }

    public function getBooks()
    {
        return $this->hasMany(Book::class, ['id' => 'book_id'])
            ->viaTable('authorship', ['author_id' => 'id']);
    }
}
