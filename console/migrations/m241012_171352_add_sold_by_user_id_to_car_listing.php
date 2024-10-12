<?php

use yii\db\Migration;

/**
 * Class m241012_171352_add_sold_by_user_id_to_car_listing
 */
class m241012_171352_add_sold_by_user_id_to_car_listing extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('car_listing', 'bought_by_user_id', $this->integer());
        $this->addForeignKey(
        'fk-car_listing-bought_by_user_id',
        'car_listing',
        'bought_by_user_id',
        'user',
        'id',
        'SET NULL'
    );


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-car_listing-bought_by_user_id', 'car_listing');
        $this->dropColumn('car_listing', 'bought_by_user_id');
    }
}
