<?php

namespace frontend\models;

use common\models\Book;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class BookForm extends Model
{
    public const INIT_SCENARIO = 'init';
    public const SAVE_SCENARIO = 'save';

    public function scenarios()
    {
//        return Model::scenarios();
        return [
            self::INIT_SCENARIO => ['id'],
            self::SAVE_SCENARIO => ['id', 'name', 'year', 'info', 'isbn', 'image'],
        ];
    }

//* @property integer $id
//* @property string $name
//* @property integer $year
//* @property string $info
//* @property string $isbn
//* @property string $image
    public $id;
    public $name;
    public $year;
    public $info;
    public $isbn;
    public $image;

    public function rules()
    {
        return [
            [['name', 'year', 'info', 'isbn', 'image'], 'required'],
            [['id', 'year'], 'integer'],
            [['name', 'info', 'isbn', 'image'], 'string'],
        ];
    }

    public function saveBook()
    {
        if ($this->validate()) {
            if ($this->id) {
                $book = Book::findOne($this->id);
                if (!$book) {
                    // else throw exception
                    return false;
                }
            } else {
                $book = new Book();
            }

            $book->name = $this->name;
            $book->year = $this->year;
            $book->info = $this->info;
            $book->isbn = $this->isbn;
            $book->image = $this->image;

            return $book->save();
        }
        // else throw exception
        return false;
    }

    public function loadBook()
    {
        if ($this->id) {
            $book = Book::findOne($this->id);
            if ($book) {
                $this->name = $book->name;
                $this->year = $book->year;
                $this->info = $book->info;
                $this->isbn = $book->isbn;
                $this->image = $book->image;
            }
        }
    }

    public function deleteBook()
    {
        if ($this->id) {
            return Book::deleteAll(['id' => $this->id]);
        }
        return false;
    }
}