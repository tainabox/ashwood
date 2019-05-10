<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%customer}}`.
 */
class m190510_165700_create_customer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%customer}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50),
            'email' => $this->string(50),
            'phone' => $this->string(50),
        ]);

        $this->insert('{{%customer}}', [
            'name' => 'Eugene',
            'email' => 'ostry89@mail.ru',
            'phone' => '+375293710538',
        ]);

        $this->insert('{{%customer}}', [
            'name' => 'Aleksei',
            'email' => 'a.belko@ashwood.by',
            'phone' => '+375293201383',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%customer}}');
    }
}
