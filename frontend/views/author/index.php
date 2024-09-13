<?php

use common\models\Author;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\AuthorSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Authors';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="author-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Author', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'first_name',
            'last_name',
            'surname',
            // 'created_at',
            //'updated_at',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{subscribe}',
                'buttons' => [
                    'subscribe' => function ($url, $model, $key) use ($subscribedAuthorIds) {
                        if (Yii::$app->user->isGuest) {
                            return Html::a('Subscribe', ['/site/login'], ['class' => 'btn btn-primary']);
                        }

                        if (in_array($model->id, $subscribedAuthorIds)) {
                            return '<div class="btn btn-success">Subscribed!</div>';
                        }
                        
                        return Html::a('Subscribe', Url::toRoute(['/subscribe/create', 'author_id' => $model->id]), [
                            'class' => 'btn btn-primary',
                            'data-method' => 'post',
                            'data-params' => [
                                'author_id' => $model->id,
                            ],
                        ]);
                    },
                ],
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Author $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                },
                'template' => '{view} {update} {delete}', // Устанавливаем шаблон кнопок
            ],
        ],
    ]); ?>


</div>
