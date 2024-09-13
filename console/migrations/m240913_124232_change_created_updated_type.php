<?php

use yii\db\Migration;

/**
 * Class m240913_124232_change_created_updated_type
 */
class m240913_124232_change_created_updated_type extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('user', 'created_at', $this->dateTime()->notNull());
        $this->alterColumn('user', 'updated_at', $this->dateTime()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('user', 'created_at', $this->integer()->notNull());
        $this->alterColumn('user', 'updated_at', $this->integer()->notNull());
        
        echo "m240913_124232_change_created_updated_type cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240913_124232_change_created_updated_type cannot be reverted.\n";

        return false;
    }
    */
}
