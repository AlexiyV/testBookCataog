<?php

namespace frontend\models;

use common\models\Author;
use common\models\Book;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class BookForm extends Model
{
    public const INIT_DELETE_SCENARIO = 'init';
    public const SAVE_SCENARIO = 'save';

    public function scenarios()
    {
        return [
            self::INIT_DELETE_SCENARIO => ['id'],
            self::SAVE_SCENARIO => ['id', 'name', 'year', 'info', 'isbn', 'image', 'authors'],
        ];
    }

    public int | null $id = null;
    public string | null $name = null;
    public int | null $year = null;
    public string | null $info = null;
    public string | null $isbn = null;
    public string | null $image = null;
    public array | null $authors = null;

    public function rules()
    {
        return [
            [['name', 'year', 'info', 'isbn', 'image'], 'required'],
            [['id', 'year'], 'integer'],
            [['name', 'info', 'isbn', 'image'], 'string'],
            ['authors', 'each', 'rule' => ['integer']],
        ];
    }

    public function saveBook()
    {
        if ($this->validate()) {
            if ($this->id) {
                $book = Book::findOne($this->id);
                if (!$book) {
                    $this->addError('id', 'Book not found');
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

            $book->unlinkAll('authors', true);
            $authors = Author::find()
                ->where(['id' => $this->authors])
                ->all();
            foreach ($authors as $author) {
                $book->link('authors', $author);
            }

            return $book->save();
        }
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
                $this->authors = ArrayHelper::getColumn($book->authors, 'id');
            }
        }
    }

    public function getAuthorsList()
    {
        return ArrayHelper::map(Author::find()->all(), 'id', 'fio') ;
    }

    public function deleteBook()
    {
        if ($this->id) {
            return Book::deleteAll(['id' => $this->id]);
        }
        return false;
    }
}