<?php

use yii\db\Migration;

/**
 * Class m240913_182016_change_subs_fk
 */
class m240913_182016_change_subs_fk extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropForeignKey('fk-subscribe-author_id', 'subscribe');
        $this->dropIndex('idx-subscribe-author_id', 'subscribe');


        $this->createIndex('idx-subscribe-author_id', 'subscribe', 'author_id');
        $this->addForeignKey('fk-subscribe-author_id', 'subscribe', 'author_id', 'author', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {


        $this->dropForeignKey('fk-subscribe-author_id', 'subscribe');
        $this->dropIndex('idx-subscribe-author_id', 'subscribe');

        $this->createIndex('idx-subscribe-author_id', 'subscribe', 'author_id');
        $this->addForeignKey('fk-subscribe-author_id', 'subscribe', 'author_id', 'user', 'id', 'CASCADE');

        echo "m240913_182016_change_subs_fk cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240913_182016_change_subs_fk cannot be reverted.\n";

        return false;
    }
    */
}
