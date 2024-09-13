<?php

use yii\db\Migration;

/**
 * Class m240912_172026_book_table
 */
class m240912_172026_book_table extends Migration
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
        echo "m240912_172026_book_table cannot be reverted.\n";

        return false;
    }

    public function up()
    {
        $this->createTable('book', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'up_year' => $this->integer()->notNull(),
            'descr' => $this->text(),
            'isbn' => $this->string()->notNull()->unique(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
        ]);
    }

    public function down()
    {
        $this->dropTable('book');
    }
}
