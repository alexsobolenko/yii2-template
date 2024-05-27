<?php

use yii\db\Migration;

class m240527_122552_create_books_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%books}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'author_id' => $this->integer()->notNull(),
        ]);
        $this->createIndex('{{%idx-book-author_id}}', '{{%books}}', 'author_id');
        $this->addForeignKey('{{%fk-book-author_id}}', '{{%books}}', 'author_id', '{{%authors}}', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('{{%fk-book-author_id}}', '{{%books}}');
        $this->dropIndex('{{%idx-book-author_id}}', '{{%books}}');
        $this->dropTable('{{%books}}');
    }
}
