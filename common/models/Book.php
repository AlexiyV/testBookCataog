<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * Книга - название, год выпуска, описание, isbn, фото главной страницы.
 * @property integer $id
 * @property string $name
 * @property integer $year
 * @property string $info
 * @property string $isbn
 * @property string $image
 */
class Book extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%book}}';
    }

    public function getAuthors()
    {
        return $this->hasMany(Author::class, ['id' => 'id_author'])
            ->viaTable(BookAuthorRelation::tableName(), ['id_book' => 'id']);
    }
}