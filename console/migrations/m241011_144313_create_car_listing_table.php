<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%car_listing}}`.
 */
class m241011_144313_create_car_listing_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%car_listing}}', [
            'id' => $this->primaryKey(),
            "title" => $this->string()->notNull(),
            'make' => $this->string()->notNull(),
            'model' => $this->string()->notNull(),
            'year' => $this->integer()->notNull(),
            'price' => $this->decimal(10, 2)->notNull(),
            'mileage' => $this->decimal(10, 2)->notNull(),
            'description' => $this->text()->notNull(),
            'status' => $this->string()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%car_listing}}');
    }
}
