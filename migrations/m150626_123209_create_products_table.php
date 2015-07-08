<?php

use yii\db\Schema;
use yii\db\Migration;

class m150626_123209_create_products_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        
        $this->createTable('{{%product}}', [
            'id' => Schema::TYPE_PK,
            'product_name' => Schema::TYPE_TEXT . ' NOT NULL DEFAULT ""',
            'price' => Schema::TYPE_DOUBLE,            
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'created_by' => Schema::TYPE_INTEGER.' NOT NULL', 
            'client_id' => Schema::TYPE_INTEGER,
        ], $tableOptions);
        
        $this->addForeignKey('fkp_created_by', '{{%product}}', 'created_by', '{{%user}}', 'id');
        $this->addForeignKey('fk_client_id', '{{%product}}', 'client_id', '{{%client}}', 'id');
    }

    public function down()
    {
        $this->dropTable('{{%product}}');
    }
}
