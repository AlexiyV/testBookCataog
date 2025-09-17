<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * Авторы - ФИО
 * @property integer $id
 * @property string $fio
 */
class Author extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%author}}';
    }

    public function getBooks()
    {
        return $this->hasMany(Book::class, ['id' => 'id_book'])
            ->viaTable(BookAuthorRelation::tableName(), ['id_author' => 'id']);
    }
}