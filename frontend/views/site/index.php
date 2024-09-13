<?php

/** @var yii\web\View $this */

use yii\helpers\Url;

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <div class="flex container">
        <a class="btn btn-primary" href="<?= Url::toRoute(['site/index', 'year' => 2021]) ?>">Топ 10 за 2021 год</a>
        <br>
        <a class="btn btn-primary" href="<?= Url::toRoute(['site/index', 'year' => 2022]) ?>">Топ 10 за 2022 год</a>
        <br>
        <a class="btn btn-primary" href="<?= Url::toRoute(['site/index', 'year' => 2023]) ?>">Топ 10 за 2023 год</a>
    </div>

    <br>
    <br>
    <ol>
        <?php foreach ($topTen as $author) : ?>
            <li><?= $author ?></li>
        <?php endforeach ?>
    </ol>
       

</div>
