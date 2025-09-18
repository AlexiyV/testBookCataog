<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * @property integer $id
 * @property integer $id_book
 * @property integer $id_author
 *
 * @property Book $book
 * @property Author $author
 */
class BookAuthorRelation extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%book_author_link}}';
    }

    public function getBook()
    {
        return $this->hasOne(Book::class, ['id' => 'id_book']);
    }

    public function getAuthor()
    {
        return $this->hasOne(Author::class, ['id' => 'id_author']);
    }
}