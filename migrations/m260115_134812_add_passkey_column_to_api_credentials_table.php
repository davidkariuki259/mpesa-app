<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%api_credentials}}`.
 */
class m260115_134812_add_passkey_column_to_api_credentials_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%api_credentials}}','passkey',$this->string());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }
}
