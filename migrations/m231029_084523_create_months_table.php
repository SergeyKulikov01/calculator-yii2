<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%months}}`.
 */
class m231029_084523_create_months_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function Up()
    {
        $this->createTable('{{%months}}', [
            'id' => $this->primaryKey()->unsigned(),
            'name' => $this->string(10)->notNull()->unique(),
//            'created_at' => $this->datetime()->defaultExpression(CURRENT_TIMESTAMP)->notNull(),
//            'updated_at' => $this->datetime()->defaultExpression(CURRENT_TIMESTAMP)->append('ON UPDATE CURRENT_TIMESTAMP')->notNull(),
            'created_at' => $this->datetime()->append('DEFAULT CURRENT_TIMESTAMP')->notNull(),
            'updated_at' => $this->datetime()->append('DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')->notNull(),
        ]);

        $this->createIndex(
            'idx-months-id',
            '{{%months}}',
            'id'
        );

        $this->batchInsert('{{%months}}',['name'], [
            ['Январь'],
            ['Февраль'],
            ['Март'],
            ['Апрель'],
            ['Май'],
            ['Июнь'],
            ['Июль'],
            ['Август'],
            ['Сентябрь'],
            ['Октябрь'],
            ['Ноябрь'],
            ['Декабрь']
            ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%months}}');
    }
}
