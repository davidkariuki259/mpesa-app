<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%reversal_result}}`.
 */
class m260108_103604_create_reversal_result_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%reversal_result}}', [
            'id' => $this->primaryKey(),
            'result_type' => $this->string(),
            'result_code' => $this->integer(),
            'transaction_id' => $this->string(),
            'originator_conversation_id' => $this->string(),
            'conversation_id' => $this->string(),
            'account_balance' => $this->float(),
            'amount' => $this->float(),
            'completed_time' => $this->dateTime(),
            'original_transaction_id' => $this->string(),
            'charge' => $this->float(),
            'credit_party_name' => $this->string(),
            'debit_party_name' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%reversal_result}}');
    }
}
