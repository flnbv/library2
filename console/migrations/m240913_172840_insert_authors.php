<?php

use yii\db\Migration;

/**
 * Class m240913_172840_insert_authors
 */
class m240913_172840_insert_authors extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('{{%author}}', ['first_name', 'last_name', 'surname', 'created_at', 'updated_at'], [
            ['John', 'Doe', 'Smith', new \yii\db\Expression('NOW()'), new \yii\db\Expression('NOW()')],
            ['Jane', 'Doe', 'Johnson', new \yii\db\Expression('NOW()'), new \yii\db\Expression('NOW()')],
            ['Alice', 'Brown', 'Taylor', new \yii\db\Expression('NOW()'), new \yii\db\Expression('NOW()')],
            ['Bob', 'White', 'Davis', new \yii\db\Expression('NOW()'), new \yii\db\Expression('NOW()')],
            ['Carol', 'Black', 'Wilson', new \yii\db\Expression('NOW()'), new \yii\db\Expression('NOW()')],
            ['David', 'Green', 'Moore', new \yii\db\Expression('NOW()'), new \yii\db\Expression('NOW()')],
            ['Eve', 'Blue', 'Anderson', new \yii\db\Expression('NOW()'), new \yii\db\Expression('NOW()')],
            ['Frank', 'Red', 'Thomas', new \yii\db\Expression('NOW()'), new \yii\db\Expression('NOW()')],
            ['Grace', 'Yellow', 'Jackson', new \yii\db\Expression('NOW()'), new \yii\db\Expression('NOW()')],
            ['Hank', 'Purple', 'White', new \yii\db\Expression('NOW()'), new \yii\db\Expression('NOW()')],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Удаляем все строки, которые были добавлены
        $this->delete('{{%author}}', ['first_name' => [
            'John', 'Jane', 'Alice', 'Bob', 'Carol', 
            'David', 'Eve', 'Frank', 'Grace', 'Hank'
        ]]);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240913_172840_insert_authors cannot be reverted.\n";

        return false;
    }
    */
}
