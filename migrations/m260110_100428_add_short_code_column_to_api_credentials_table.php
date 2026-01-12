<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%api_credentials}}`.
 */
class m260110_100428_add_short_code_column_to_api_credentials_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%api_credentials}}','short_code',$this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }
}
