<?php

use yii\db\Schema;
use yii\db\Migration;

class m150703_114837_create_quote_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        
        $this->createTable('{{%quote}}', [
            'id' => Schema::TYPE_PK,
            'title' => Schema::TYPE_STRING.' NOT NULL',
            'client' => Schema::TYPE_INTEGER.' NOT NULL',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'created_by' => Schema::TYPE_INTEGER.' NOT NULL', 
            'owner' => Schema::TYPE_INTEGER.' NOT NULL', 
            'header' => Schema::TYPE_TEXT,
            'body' => Schema::TYPE_TEXT
        ], $tableOptions);
        
        $this->addForeignKey('fkq_created_by', '{{%quote}}', 'created_by', '{{%user}}', 'id');
        $this->addForeignKey('fkq_owner', '{{%quote}}', 'owner', '{{%user}}', 'id');
    }

    public function down()
    {
        $this->dropTable('{{%quote}}');
        $this->dropForeignKey('fkq_created_by', '{{%quote}}');
        $this->dropForeignKey('fkq_owner', '{{%quote}}');
    }
}
