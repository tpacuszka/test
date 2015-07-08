<?php

namespace app\components;

use yii\base\Widget;
use yii\helpers\Html;

class NewestProductsWidget extends Widget 
{
    /**
     * @var Array
     */
    public $products;    
    
    public function init()
    {
        parent::init();
        
        if (empty($this->products)) {
            $this->products = "<div class='panel panel-default'>"
                . "<div class='panel-body'>"
                . "There aren't any new products"
                . "</div></div></div>";
        } else {       
            $message = "<div class='panel panel-default'>"
                    . "<div class='panel-heading'>Newest products</div>"                    
                . "<div class='panel-body'>"
                . "<ul class='list-group'>";
            
            //adding every produc to list
            foreach ($this->products as $product) {
                $message .= '<li class="list-group-item">'
                . '<a href="/products/'.$product['id'].'">'
                . $product['name'].'</a>'
                . '<div class="pull-right">'
                . $product['price']. ' $'
                . '</div></li>';
            }        
            $message .= "</ul></div>"
                    
                    ."</div></div>";
            
            $this->products = $message;
        }
    }
    
    public function run()
    {
        
        return Html::tag('div', $this->products, ['class' => 'col-md-6 col-sm-6 newest-products']);
                
    }
}