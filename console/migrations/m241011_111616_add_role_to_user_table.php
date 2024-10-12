<?php

use yii\db\Migration;

/**
 * Class m241011_111616_add_role_to_user_table
 */
class m241011_111616_add_role_to_user_table extends Migration
{
    public function up()
    {
        $this->addColumn('{{%user}}', 'role', $this->string());

    }

    public function down()
    {
        $this->dropColumn('{{%user}}', 'role');
    }

}
