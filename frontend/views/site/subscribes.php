<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $books common\models\Book[] */

$this->title = "Books by Subscribed Authors";
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>

<ul>
    <?php foreach ($books as $book): ?>
        <li>
            <div class="grid container">
                <div><?= $book->title ?> </div>
                <div><?= $book->isbn ?> </div>
            </div>
        </li>
    <?php endforeach; ?>
</ul>