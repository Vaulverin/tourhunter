<?php

use yii\db\Migration;

/**
 * Handles the creation of table `transfer`.
 * Has foreign keys to the tables:
 *
 * - `user`
 * - `user`
 */
class m170609_120524_create_transfer_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('transfer', [
            'id' => $this->primaryKey(),
            'sender_id' => $this->integer()->notNull(),
            'recipient_id' => $this->integer()->notNull(),
            'summ' => $this->float()->notNull(),
            'transferDate' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        // creates index for column `sender`
        $this->createIndex(
            'idx-transfer-sender',
            'transfer',
            'sender_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-transfer-sender',
            'transfer',
            'sender_id',
            'user',
            'id'
        );

        // creates index for column `recipient`
        $this->createIndex(
            'idx-transfer-recipient',
            'transfer',
            'recipient_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-transfer-recipient',
            'transfer',
            'recipient_id',
            'user',
            'id'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-transfer-sender',
            'transfer'
        );

        // drops index for column `sender`
        $this->dropIndex(
            'idx-transfer-sender',
            'transfer'
        );

        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-transfer-recipient',
            'transfer'
        );

        // drops index for column `recipient`
        $this->dropIndex(
            'idx-transfer-recipient',
            'transfer'
        );

        $this->dropTable('transfer');
    }
}
