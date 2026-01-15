<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%api_credentials}}`.
 */
class m260115_135830_add_stk_callback_url_column_to_api_credentials_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%api_credentials}}','stk_callback_url',$this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }
}
