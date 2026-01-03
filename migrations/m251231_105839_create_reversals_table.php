<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%reversals}}`.
 */
class m251231_105839_create_reversals_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%reversals}}', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%reversals}}');
    }
}
