<?php

use yii\db\Migration;

/**
 * Class m240913_221109_add_phone_to_user
 */
class m240913_221109_add_phone_to_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Добавьте поле без уникального ограничения
        $this->addColumn('user', 'phone', $this->string()->notNull()->comment('Phone number'));
    }

    public function safeDown()
    {
        $this->dropColumn('user', 'phone');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240913_221109_add_phone_to_user cannot be reverted.\n";

        return false;
    }
    */
}
