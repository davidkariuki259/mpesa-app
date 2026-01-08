<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%payments}}`.
 */
class m251231_105811_create_payments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%payments}}', [
            'id' => $this->primaryKey(),
            'transaction_id' => $this->string(),
            'transaction_time' => $this->dateTime(),
            'business_short_code' => $this->integer(),
            'bill_ref_number' => $this->string(),
            'invoice_number' => $this->string(),
            'third_party_transaction_id' => $this->string(),
            'amount' => $this->float(),
            'phone_number' => $this->integer(),
            'first_name' => $this->string(),
            'second_name' => $this->string(),
            'last_name' => $this->string(),
            'account_balance' => $this->float(),
            'reversal_status' => $this->smallInteger(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%payments}}');
    }
}
