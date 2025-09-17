<?php

namespace frontend\models;

use common\models\Book;
use common\models\BookAuthorRelation;
use yii\base\Model;
use yii\db\Expression;

class Books extends Model
{
    public $year;

    public function rules()
    {
        return [
            ['year', 'default', 'value' => (integer)date('Y')],
            [['year'], 'integer'],
        ];
    }

    public function getBooks()
    {
        return Book::find()->with('authors')->all();
    }

    public function getTop()
    {
        return BookAuthorRelation::find()
            ->select([
                'a.id_author',
                'booksCount' => 'count(a.id_book)',
                'author.fio',
            ])
            ->from(['a' => BookAuthorRelation::tableName()])
            ->joinWith('author author')
            ->joinWith('book book')
            ->where(['book.year' => $this->year])
            ->groupBy('id_author')
            ->orderBy(new Expression('count(id_book) DESC'))
            ->limit(10)
            ->all();
    }
}