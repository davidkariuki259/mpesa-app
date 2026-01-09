<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%logs}}`.
 */
class m260109_134313_add_date_column_to_logs_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%logs}}','date_time',$this->dateTime());
        $this->addColumn('{{%logs}}','method',$this->string(10));
        $this->addColumn('{{%logs}}','response_code',$this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }
}
