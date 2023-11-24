<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m231116_134718_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey()->unsigned(),
            'name' => $this->char(20)->notNull()->unsigned(),
            'username' => $this->char(40)->notNull()->unique()->unsigned(),
            'role' => $this->char(20)->notNull()->unsigned()->defaultValue('Пользователь'),
            'password' => $this->text()->notNull()->unsigned(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
