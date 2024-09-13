<?php

use yii\db\Migration;

/**
 * Class m240913_171539_add_fk_to_authorship
 */
class m240913_171539_add_fk_to_authorship extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createIndex('idx-authorship-book_id', 'authorship', 'book_id');
        $this->addForeignKey('fk-authorship-book_id', 'authorship', 'book_id', 'book', 'id', 'CASCADE');

        $this->dropForeignKey('fk-authorship-user_id', 'authorship');
        $this->dropIndex('idx-authorship-user_id', 'authorship');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        $this->createIndex('idx-authorship-user_id', 'authorship', 'user_id');
        $this->addForeignKey('fk-authorship-user_id', 'authorship', 'user_id', 'user', 'id', 'CASCADE');

        $this->dropForeignKey('fk-authorship-book_id', 'authorship');
        $this->dropIndex('fk-authorship-book_id', 'authorship');

        echo "m240913_171539_add_fk_to_authorship cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240913_171539_add_fk_to_authorship cannot be reverted.\n";

        return false;
    }
    */
}
