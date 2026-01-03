<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%stk_push}}`.
 */
class m251231_105829_create_stk_push_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%stk_push}}', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%stk_push}}');
    }
}
