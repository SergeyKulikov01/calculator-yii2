<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%history}}`.
 */
class m231119_123517_create_history_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%history}}', [
            'id' => $this->primaryKey()->unsigned(),
            'user_id' => $this->integer()->notNull(),
            'username' => $this->text()->notNull(),
            'tonnage' => $this->tinyInteger(3)->notNull(),
            'month' => $this->text()->notNull(),
            'type' => $this->text()->notNull(),
            'price' => $this->tinyInteger(3)->notNull()->unsigned(),
            'full_pricelist' => $this->json()->notNull(),
            'created_at' => $this->datetime()->append('DEFAULT CURRENT_TIMESTAMP')->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%history}}');
    }
}
