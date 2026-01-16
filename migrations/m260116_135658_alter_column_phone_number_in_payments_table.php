<?php

use yii\db\Migration;

/**
 * Class m260116_135658_alter_column_phone_number_in_payments_table
 */
class m260116_135658_alter_column_phone_number_in_payments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('{{%payments}}','phone_number',$this->string());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m260116_135658_alter_column_phone_number_in_payments_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m260116_135658_alter_column_phone_number_in_payments_table cannot be reverted.\n";

        return false;
    }
    */
}
