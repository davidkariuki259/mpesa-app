<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%transactions}}`.
 */
class m260108_103439_create_transactions_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%transactions}}', [
            'id' => $this->primaryKey(),
            'type' => $this->string(15),
            'transaction_id' => $this->string(),
            'transaction_time' => $this->dateTime(),
            'success_status' => $this->smallInteger(),
            'amount' => $this->float(),
            'phone_number' => $this->integer(),
            'first_name' => $this->string(),
            'second_name' => $this->string(),
            'last_name' => $this->string(),
            'account_balance' => $this->float(),
            'description' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%transactions}}');
    }
}
