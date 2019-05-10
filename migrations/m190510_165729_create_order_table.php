<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%order}}`.
 */
class m190510_165729_create_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%order}}', [
            'id' => $this->primaryKey(),
            'sum' => $this->float(),
            'status' => "ENUM('inWork', 'complete')",
            'customer_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `customer_id`
        $this->createIndex(
            'idx-order-customer_id',
            '{{%order}}',
            'customer_id'
        );

        // add foreign key for table `customer`
        $this->addForeignKey(
            'fk-order-customer_id',
            'order',
            'customer_id',
            '{{%customer}}',
            'id',
            'CASCADE'
        );

        $this->insert('{{%order}}', [
            'sum' => 30.23,
            'status' => 'inWork',
            'customer_id' => 1,
        ]);

        $this->insert('{{%order}}', [
            'sum' => 20.00,
            'status' => 'inWork',
            'customer_id' => 2,
        ]);

        $this->insert('{{%order}}', [
            'sum' => 21.23,
            'status' => 'inWork',
            'customer_id' => 1,
        ]);

        $this->insert('{{%order}}', [
            'sum' => 23.09,
            'status' => 'inWork',
            'customer_id' => 2,
        ]);

        $this->insert('{{%order}}', [
            'sum' => 77.03,
            'status' => 'inWork',
            'customer_id' => 1,
        ]);

        $this->insert('{{%order}}', [
            'sum' => 50.00,
            'status' => 'inWork',
            'customer_id' => 2,
        ]);

        $this->insert('{{%order}}', [
            'sum' => 40.23,
            'status' => 'inWork',
            'customer_id' => 1,
        ]);

        $this->insert('{{%order}}', [
            'sum' => 50.01,
            'status' => 'inWork',
            'customer_id' => 2,
        ]);

        $this->insert('{{%order}}', [
            'sum' => 20.25,
            'status' => 'inWork',
            'customer_id' => 1,
        ]);

        $this->insert('{{%order}}', [
            'sum' => 11.00,
            'status' => 'inWork',
            'customer_id' => 2,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-order-customer_id',
            '{{%order}}'

        );

        // drops index for column `author_id`
        $this->dropIndex(
            'idx-order-customer_id',
            '{{%order}}'
        );

        $this->dropTable('{{%order}}');
    }
}
