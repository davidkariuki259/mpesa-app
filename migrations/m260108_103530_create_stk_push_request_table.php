<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%stk_push_request}}`.
 */
class m260108_103530_create_stk_push_request_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%stk_push_request}}', [
            'id' => $this->primaryKey(),
            'business_short_code' => $this->integer(),
            'timestamp' => $this->dateTime(),
            'party_a' => $this->integer(),
            'party_b' => $this->integer(),
            'phone_number' => $this->integer(),
            'amount' => $this->float(),
            'account_reference' => $this->string(),
            'transaction_description' => $this->string(),
            'merchant_request_id' => $this->string(),
            'checkout_request_id' => $this->string(),
            'response_code' => $this->integer(),
            'response_description' => $this->string(),
            'customer_message' => $this->string(),

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%stk_push_request}}');
    }
}
