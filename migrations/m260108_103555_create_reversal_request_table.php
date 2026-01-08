<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%reversal_request}}`.
 */
class m260108_103555_create_reversal_request_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%reversal_request}}', [
            'id' => $this->primaryKey(),
            'initiator' => $this->string(),
            'transaction_id' => $this->string(),
            'amount' => $this->float(),
            'date_initiated' => $this->dateTime(),
            'remarks' => $this->string(),
            'conversation_id' => $this->string(),
            'originator_conversation_id' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%reversal_request}}');
    }
}
