<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * @property integer $id
 * @property integer $id_author
 * @property string $name
 * @property string $phone
 */
class Subscribe extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%subscribe}}';
    }
}