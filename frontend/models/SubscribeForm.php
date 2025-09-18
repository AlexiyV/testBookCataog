<?php

namespace frontend\models;

use common\models\Author;
use common\models\Subscribe;
use yii\base\Model;

class SubscribeForm extends Model
{
    public $id_author;
    public $name;
    public $phone;

    public const INIT_SCENARIO = 'init';
    public const SAVE_SCENARIO = 'save';

    public function scenarios()
    {
        return [
            self::INIT_SCENARIO => ['id_author'],
            self::SAVE_SCENARIO => ['id_author', 'name', 'phone'],
        ];
    }

    public function rules()
    {
        return [
            [['id_author', 'name', 'phone'], 'required'],
            [['id_author'], 'integer'],
            [['name', 'phone'], 'string'],
        ];
    }

    public function save()
    {
        if ($this->validate()) {
            $author = Author::findOne($this->id_author);
            if (!$author) {
                $this->addError('id_author', 'Author not found');
                return false;
            }

            $model = new Subscribe();
            $model->id_author = $author->id;
            $model->name = $this->name;
            $model->phone = $this->phone;

            return $model->save();
        }
        return false;
    }
}