<?php

use yii\db\Schema;
use yii\db\Migration;

class m150629_084434_create_user_relations extends Migration
{
    public function up()
    {
        $this->addColumn('{{%client}}', 'owned_by', Schema::TYPE_INTEGER.' NOT NULL');        
        $this->addForeignKey('fkc_owned_by', '{{%client}}', 'owned_by', '{{%user}}', 'id');
        
        $this->addColumn('{{%product}}', 'owned_by', Schema::TYPE_INTEGER.' NOT NULL');
        $this->addForeignKey('fkp_owned_by', '{{%product}}', 'owned_by', '{{%user}}', 'id');
    }

    public function down()
    {
        $this->dropForeignKey('fkc_owned_by','{{%client}}');
        $this->dropColumn('{{%client}}','owned_by');
        
        $this->dropForeignKey('fkp_owned_by','{{%product}}');
        $this->dropColumn('{{%product}}','owned_by');
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
