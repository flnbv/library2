<?php

use yii\db\Migration;

/**
 * Class m240912_172305_authorship_table
 */
class m240912_172305_authorship_table extends Migration
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
        echo "m240912_172305_authorship_table cannot be reverted.\n";

        return false;
    }

    public function up()
    {
        $this->createTable('authorship', [
            'id' => $this->primaryKey(),
            'book_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
        ]);

        $this->createIndex('idx-authorship-book_id', 'authorship', 'book_id');
        $this->addForeignKey('fk-authorship-book_id', 'authorship', 'book_id', 'book', 'id', 'CASCADE');

        $this->createIndex('idx-authorship-user_id', 'authorship', 'user_id');
        $this->addForeignKey('fk-authorship-user_id', 'authorship', 'user_id', 'user', 'id', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('fk-authorship-user_id', 'authorship');
        $this->dropIndex('idx-authorship-user_id', 'authorship');

        $this->dropForeignKey('fk-authorship-book_id', 'authorship');
        $this->dropIndex('idx-authorship-book_id', 'authorship');

        $this->dropTable('authorship');
    }
}
