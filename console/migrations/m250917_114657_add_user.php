<?php

use common\models\User;
use yii\db\Migration;

class m250917_114657_add_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $user = new User();
        $user->id = 1;
        $user->username = 'admin';
        $user->password = 'admin';
        $user->email = 'test@test.ru';
        $user->status = User::STATUS_ACTIVE;
        $user->generateAuthKey();
        $user->save();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('{{%user}}', ['username' => 'admin']);

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250917_114657_add_user cannot be reverted.\n";

        return false;
    }
    */
}
