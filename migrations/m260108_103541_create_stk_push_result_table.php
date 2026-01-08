<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%stk_push_result}}`.
 */
class m260108_103541_create_stk_push_result_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%stk_push_result}}', [
            'id' => $this->primaryKey(),
            'merchant_request_id' => $this->string(),
            'checkout_request_id' => $this->string(),
            'status' => $this->smallInteger(),
            'result_code' => $this->integer(),
            'result_description' => $this->string(),
            'amount' => $this->float(),
            'transaction_id' => $this->string(),
            'timestamp' => $this-dateTime(),
            'phone_number' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%stk_push_result}}');
    }
}
