<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%api_credentials}}`.
 */
class m260110_102138_add_urls_columns_to_api_credentials_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%api_credentials}}','confirmation_url',$this->string());
        $this->addColumn('{{%api_credentials}}','validation_url',$this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }
}
