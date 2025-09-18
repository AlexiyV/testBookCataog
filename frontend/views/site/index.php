<?php

/** @var yii\web\View $this */
/* @var \common\models\Book[] $books */
/* @var bool $isGuest */
$this->title = 'My Yii Application';

?>
<div class="site-index">
    <div class="p-5 mb-4 bg-transparent rounded-3">
        <div class="container-fluid py-5 text-center">
            <h1 class="display-4">Каталог книг!</h1>
            <?php if (!$isGuest): ?>
                <p><a href="?r=site/edit">Создать</a></p>
            <?php endif; ?>
        </div>
    </div>

    <div class="body-content">

        <?php foreach ($books as $book): ?>
        <div class="row" style="border-top: 1px solid gray">
            <div class="col-lg-4">
                <h2><?= $book->name ?></h2>
                <?php if (!$isGuest): ?>
                <p><a href="/?r=site/edit&id_book=<?= $book->id ?>">Изменить</a> <a href="/?r=site/delete&id_book=<?= $book->id ?>">Удалить</a></p>
                <?php endif; ?>
                <p>Год: <?= $book->year ?></p>
                <p>Описание: <?= $book->info ?></p>
                <p>ISBN: <?= $book->isbn ?></p>
                <p>Фото: <?= $book->image ?></p>
                <p>Авторы:</p>
                <ul>
                <?php foreach ($book->authors as $author): ?>
                    <li><?= $author->fio ?> <a href="/?r=site/subscribe&id_author=<?= $author->id ?>">Подписаться</a></li>
                <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
