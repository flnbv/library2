<?php

use yii\db\Migration;

/**
 * Class m240912_172227_subscribe_table
 */
class m240912_172227_subscribe_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240912_172227_subscribe_table cannot be reverted.\n";

        return false;
    }

    public function up()
    {
        $this->createTable('subscribe', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'author_id' => $this->integer()->notNull(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
        ]);

        $this->createIndex('idx-subscribe-user_id', 'subscribe', 'user_id');
        $this->addForeignKey('fk-subscribe-user_id', 'subscribe', 'user_id', 'user', 'id', 'CASCADE');

        $this->createIndex('idx-subscribe-author_id', 'subscribe', 'author_id');
        $this->addForeignKey('fk-subscribe-author_id', 'subscribe', 'author_id', 'user', 'id', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('fk-subscribe-author_id', 'subscribe');
        $this->dropIndex('idx-subscribe-author_id', 'subscribe');

        $this->dropForeignKey('fk-subscribe-user_id', 'subscribe');
        $this->dropIndex('idx-subscribe-user_id', 'subscribe');

        $this->dropTable('subscribe');
    }
}
