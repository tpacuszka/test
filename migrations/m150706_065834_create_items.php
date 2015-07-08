<?php

use yii\db\Schema;
use yii\db\Migration;

class m150706_065834_create_items extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        
        $this->createTable('{{%item}}', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING.' NOT NULL',
            'description' => Schema::TYPE_TEXT,
            'data' => Schema::TYPE_TEXT,            
            'price' => Schema::TYPE_DOUBLE,
            'created_by' => Schema::TYPE_INTEGER.' NOT NULL', 
            'created_at' => Schema::TYPE_INTEGER.' NOT NULL', 
        ], $tableOptions);
        
        $this->addForeignKey('fki_created_by', '{{%item}}', 'created_by', '{{%user}}', 'id');       
    }

    public function down()
    {
        $this->dropTable('{{%item}}');
        $this->dropForeignKey('fki_created_by', '{{%item}}');        
    }
}
