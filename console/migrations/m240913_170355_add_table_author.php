<?php

use yii\db\Migration;

/**
 * Class m240913_170355_add_table_author
 */
class m240913_170355_add_table_author extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropForeignKey('fk-authorship-book_id', 'authorship');
        $this->dropIndex('idx-authorship-book_id', 'authorship');

        $this->renameColumn('{{%authorship}}', 'user_id', 'author_id');

        $this->createTable('{{%author}}', [
            'id' => $this->primaryKey(),
            'first_name' => $this->string(255)->notNull(),
            'last_name' => $this->string(255)->notNull(),
            'surname' => $this->string(255)->null(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->notNull(),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')->notNull(),
        ]);

        $this->createIndex('idx-authorship-author_id', 'authorship', 'author_id');
        $this->addForeignKey('fk-authorship-author_id', 'authorship', 'author_id', 'author', 'id', 'CASCADE');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        $this->createIndex('idx-authorship-book_id', 'authorship', 'book_id');
        $this->addForeignKey('fk-authorship-book_id', 'authorship', 'book_id', 'book', 'id', 'CASCADE');

        $this->createIndex('idx-authorship-user_id', 'authorship', 'user_id');
        $this->addForeignKey('fk-authorship-user_id', 'authorship', 'user_id', 'user', 'id', 'CASCADE');

        $this->renameColumn('{{%authorship}}', 'author_id', 'user_id');

        $this->dropTable('{{%author}}');

        echo "m240913_170355_add_table_author cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240913_170355_add_table_author cannot be reverted.\n";

        return false;
    }
    */
}
