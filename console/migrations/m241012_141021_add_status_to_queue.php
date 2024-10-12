<?php

use yii\db\Migration;

/**
 * Class m241012_141021_add_status_to_queue
 */
class m241012_141021_add_status_to_queue extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Add status column to queue table
        $this->addColumn('queue', 'status', $this->string()->notNull()->defaultValue('pending'));

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Drop status column from queue table
        $this->dropColumn('queue', 'status');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m241012_141021_add_status_to_queue cannot be reverted.\n";

        return false;
    }
    */
}
