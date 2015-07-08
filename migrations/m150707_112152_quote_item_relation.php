<?php

use yii\db\Schema;
use yii\db\Migration;

class m150707_112152_quote_item_relation extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        
        $this->createTable('{{%relation_quote_item}}', [
            'id' => Schema::TYPE_PK.' NOT NULL',
            'quoteid' => Schema::TYPE_INTEGER.' NOT NULL',
            'itemid' => Schema::TYPE_INTEGER.' NOT NULL',
        ], $tableOptions);
        
        $this->addForeignKey('fkrqi_quoteid', '{{%relation_quote_item}}', 'quoteid', '{{%quote}}', 'id');
        $this->addForeignKey('fkrqi_itemid', '{{%relation_quote_item}}', 'itemid', '{{%item}}', 'id');
    }

    public function down()
    {
        $this->dropTable('{{%relation_quote_item}}');
        $this->dropForeignKey('fkrqi_quoteid', '{{%relation_quote_item}}');
        $this->dropForeignKey('fkrqi_id', '{{%relation_quote_item}}');
    }
}
