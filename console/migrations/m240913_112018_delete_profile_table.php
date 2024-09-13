<?php

use yii\db\Migration;

/**
 * Class m240913_112018_delete_profile_table
 */
class m240913_112018_delete_profile_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropForeignKey('fk-profile-user_id', 'profile');
        $this->dropIndex('idx-profile-user_id', 'profile');

        $this->dropTable('profile');

        $this->addColumn('{{%user}}', 'first_name', $this->string()->notNull());
        $this->addColumn('{{%user}}', 'last_name', $this->string());
        $this->addColumn('{{%user}}', 'surname', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
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

        $this->dropColumn('{{%user}}', 'first_name');
        $this->dropColumn('{{%user}}', 'last_name');
        $this->dropColumn('{{%user}}', 'surname');
        echo "m240913_112018_delete_profile_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240913_112018_delete_profile_table cannot be reverted.\n";

        return false;
    }
    */
}
