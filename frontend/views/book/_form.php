<?php

use common\models\Author;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Book $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="book-form">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data'],
    ]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'up_year')->textInput() ?>

    <?= $form->field($model, 'descr')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'isbn')->textInput(['maxlength' => true]) ?>

    <br>
    <?= $form->field($model, 'photo')->fileInput() ?>
    <br>

    <?= $form->field($model, 'authors')->dropDownList(
        ArrayHelper::map(Author::find()->all(), 'id', function ($model) {
            return $model->first_name . ' ' . $model->last_name . ' ' . $model->surname;
        }),
        ['multiple' => true, 'class' => 'form-control', 'prompt' => 'Select authors...']
    ); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
