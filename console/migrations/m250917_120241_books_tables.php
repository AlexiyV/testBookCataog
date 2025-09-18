<?php

use yii\db\Migration;

class m250917_120241_books_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%book}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'year' => $this->integer(),
            'info' => $this->string(),
            'isbn' => $this->string(),
            'image' => $this->string(),
        ]);

        $this->createTable('{{%author}}', [
            'id' => $this->primaryKey(),
            'fio' => $this->string(),
        ]);

        $this->createTable('{{%book_author_link}}', [
            'id' => $this->primaryKey(),
            'id_book' => $this->integer(),
            'id_author' => $this->integer(),
        ]);

        $this->batchInsert('{{%book}}',
            ['id', 'name', 'year', 'info', 'isbn', 'image'],
            [
                [1, 'Книга 1', 2000, 'Описание для Книга 1', '978-5-91768-408-1', '/images/books-1/main-page.png'],
                [2, 'Книга 2', 2001, 'Описание для Книга 2', '978-5-91768-408-2', '/images/books-2/main-page.png'],
                [3, 'Книга 3', 2002, 'Описание для Книга 3', '978-5-91768-408-3', '/images/books-3/main-page.png'],
                [4, 'Книга 4', 2003, 'Описание для Книга 4', '978-5-91768-408-4', '/images/books-4/main-page.png'],
                [5, 'Книга 5', 2004, 'Описание для Книга 5', '978-5-91768-408-5', '/images/books-5/main-page.png'],
                [6, 'Книга 6', 2005, 'Описание для Книга 6', '978-5-91768-408-6', '/images/books-6/main-page.png'],
                [7, 'Книга 7', 2006, 'Описание для Книга 7', '978-5-91768-408-7', '/images/books-7/main-page.png'],
                [8, 'Книга 8', 2007, 'Описание для Книга 8', '978-5-91768-408-8', '/images/books-8/main-page.png'],
                [9, 'Книга 9', 2008, 'Описание для Книга 9', '978-5-91768-408-9', '/images/books-9/main-page.png'],
                [10, 'Книга 10', 2009, 'Описание для Книга 10', '978-5-91768-408-10', '/images/books-10/main-page.png'],
                [11, 'Книга 11', 2010, 'Описание для Книга 11', '978-5-91768-408-11', '/images/books-11/main-page.png'],
                [12, 'Книга 12', 2011, 'Описание для Книга 12', '978-5-91768-408-12', '/images/books-12/main-page.png'],
                [13, 'Книга 13', 2012, 'Описание для Книга 13', '978-5-91768-408-13', '/images/books-13/main-page.png'],
                [14, 'Книга 14', 2013, 'Описание для Книга 14', '978-5-91768-408-14', '/images/books-14/main-page.png'],
                [15, 'Книга 15', 2014, 'Описание для Книга 15', '978-5-91768-408-15', '/images/books-15/main-page.png'],
                [16, 'Книга 16', 2015, 'Описание для Книга 16', '978-5-91768-408-16', '/images/books-16/main-page.png'],
                [17, 'Книга 17', 2016, 'Описание для Книга 17', '978-5-91768-408-17', '/images/books-17/main-page.png'],
                [18, 'Книга 18', 2017, 'Описание для Книга 18', '978-5-91768-408-18', '/images/books-18/main-page.png'],
                [19, 'Книга 19', 2018, 'Описание для Книга 19', '978-5-91768-408-19', '/images/books-19/main-page.png'],
                [20, 'Книга 20', 2019, 'Описание для Книга 20', '978-5-91768-408-20', '/images/books-20/main-page.png'],
            ]
        );

        $this->batchInsert('{{%author}}',
            ['id', 'fio'],
            [
                [1, 'ФИО Автор 1'],
                [2, 'ФИО Автор 2'],
                [3, 'ФИО Автор 3'],
                [4, 'ФИО Автор 4'],
                [5, 'ФИО Автор 5'],
                [6, 'ФИО Автор 6'],
                [7, 'ФИО Автор 7'],
                [8, 'ФИО Автор 8'],
                [9, 'ФИО Автор 9'],
            ],
        );

        $this->batchInsert('{{%book_author_link}}',
            ['id', 'id_book', 'id_author'],
            [
                [1, 1, 1],
                [2, 1, 2],
                [3, 1, 3],
                [4, 2, 4],
                [5, 3, 5],
                [6, 3, 6],
                [7, 4, 7],
                [8, 5, 8],
                [9, 6, 9],
                [10, 7, 1],
                [11, 7, 3],
                [12, 8, 5],
                [13, 9, 7],
                [14, 10, 9],
                [15, 11, 2],
                [16, 12, 2],
                [17, 13, 4],
                [18, 13, 6],
                [19, 13, 8],
                [20, 14, 3],
                [21, 15, 3],
                [22, 16, 7],
                [23, 17, 9],
                [24, 18, 6],
                [25, 19, 6],
                [26, 20, 6],
            ],
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%book_author_link}}');
        $this->dropTable('{{%author}}');
        $this->dropTable('{{%book}}');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250917_120241_books_tables cannot be reverted.\n";

        return false;
    }
    */
}
