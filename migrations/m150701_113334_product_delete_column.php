<?php

use yii\db\Schema;
use yii\db\Migration;

class m150701_113334_product_delete_column extends Migration
{
    public function up()
    {
        $this->addColumn('{{%product}}', 'deleted', Schema::TYPE_INTEGER.' NOT NULL');        
    }

    public function down()
    {
        $this->dropColumn('{{%product}}','deleted');
        
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
