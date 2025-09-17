<?php

/** @var yii\web\View $this */
/* @var \common\models\BookAuthorRelation $top */
/* @var integer $year */
$this->title = 'My Yii Application';

?>
<div class="site-index">
    <div class="p-5 mb-4 bg-transparent rounded-3">
        <div class="container-fluid py-5 text-center">
            <h1 class="display-4">Топ 10 авторов выпустивших больше книг за <?= $year ?> год</h1>
            <form>
                <select name="year">
                    <?php for($i = 2000; $i <= (integer)date('Y'); $i++): ?>
                        <option <?= $i == $year ? 'selected' : ''?>><?= $i ?></option>
                    <?php endfor; ?>
                </select>
                <input type="hidden" name="r" value="site/top">
                <input type="submit" value="Показать">
            </form>


        </div>
    </div>

    <div class="body-content">

        <?php foreach ($top as $item): ?>
            <div class="row">
                <div class="col-lg-4">
                    <h2><?= $item->author->fio ?></h2>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

