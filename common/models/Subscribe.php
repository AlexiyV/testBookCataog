<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * @property integer $id
 * @property integer $id_author
 * @property string $name
 * @property string $phone
 *
 * @property Author $author
 */
class Subscribe extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%subscribe}}';
    }

    public function getAuthor()
    {
        return $this->hasOne(Author::class, ['id' => 'id_author']);
    }
}