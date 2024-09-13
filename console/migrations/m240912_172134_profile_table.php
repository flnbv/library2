<?php

use yii\db\Migration;

/**
 * Class m240912_172134_profile_table
 */
class m240912_172134_profile_table extends Migration
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
        echo "m240912_172134_profile_table cannot be reverted.\n";

        return false;
    }

    public function up()
    {
        $this->createTable('profile', [
            'id' => $this->primaryKey(),
            'first_name' => $this->string()->notNull(),
            'last_name' => $this->string(),
            'surname' => $this->string(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
            'user_id' => $this->integer()->notNull(),
        ]);

        $this->createIndex('idx-profile-user_id', 'profile', 'user_id');
        $this->addForeignKey('fk-profile-user_id', 'profile', 'user_id', 'user', 'id', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('fk-profile-user_id', 'profile');
        $this->dropIndex('idx-profile-user_id', 'profile');

        $this->dropTable('profile');
    }
}
