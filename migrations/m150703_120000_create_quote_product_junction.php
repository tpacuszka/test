<?php

use yii\db\Schema;
use yii\db\Migration;

class m150703_120000_create_quote_product_junction extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        
        $this->createTable('{{%relation_quote_product}}', [
            'quoteid' => Schema::TYPE_PK,
            'productid' => Schema::TYPE_INTEGER.' NOT NULL',
        ], $tableOptions);
        
        $this->addForeignKey('fkrqp_quoteid', '{{%relation_quote_product}}', 'quoteid', '{{%quote}}', 'id');
        $this->addForeignKey('fkrqp_productid', '{{%relation_quote_product}}', 'productid', '{{%product}}', 'id');
    }

    public function down()
    {
        $this->dropTable('{{%quote_product}}');
        $this->dropForeignKey('fkrqp_quoteid', '{{%relation_quote_product}}');
        $this->dropForeignKey('fkrqp_productid', '{{%relation_quote_product}}');
    }
    

}
