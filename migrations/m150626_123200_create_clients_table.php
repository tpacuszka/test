<?php

use yii\db\Schema;
use yii\db\Migration;

class m150626_123200_create_clients_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        
        $this->createTable('{{%client}}', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_TEXT . ' NOT NULL DEFAULT ""',
            'address' => Schema::TYPE_STRING,
            'postal_code' => Schema::TYPE_STRING,
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'created_by' => Schema::TYPE_INTEGER.' NOT NULL' 
        ], $tableOptions);
        
        $this->addForeignKey('fkc_created_by', '{{%client}}', 'created_by', '{{%user}}', 'id');
    }

    public function down()
    {
        $this->dropTable('{{%client}}');
    }
    
    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }
    
    public function safeDown()
    {
    }
    */
}
