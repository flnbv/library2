<?php

use yii\db\Migration;

/**
 * Class m240912_194355_add_role_for_user
 */
class m240912_194355_add_role_for_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'role', $this->integer()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'role');
        echo "m240912_194355_add_role_for_user cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240912_194355_add_role_for_user cannot be reverted.\n";

        return false;
    }
    */
}
