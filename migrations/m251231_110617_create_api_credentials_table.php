<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%api_credentials}}`.
 */
class m251231_110617_create_api_credentials_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%api_credentials}}', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%api_credentials}}');
    }
}
