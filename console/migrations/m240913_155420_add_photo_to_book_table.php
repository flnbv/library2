<?php

use yii\db\Migration;

/**
 * Class m240913_155420_add_photo_to_book_table
 */
class m240913_155420_add_photo_to_book_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('book', 'photo', $this->string()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('book', 'photo');
        echo "m240913_155420_add_photo_to_book_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240913_155420_add_photo_to_book_table cannot be reverted.\n";

        return false;
    }
    */
}
