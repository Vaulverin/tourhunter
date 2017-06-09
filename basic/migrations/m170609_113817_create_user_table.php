<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m170609_113817_create_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'username' => $this->string(100)->unique(),
            'accessToken' => $this->string(100)->unique(),
            'balance' => $this->float()->defaultValue(0),
        ]);
        $this->createIndex(
            'idx-user-username',
            'user',
            'username'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropIndex(
            'idx-user-username',
            'user'
        );
        $this->dropTable('user');
    }
}
