<?php

namespace app\components;

use yii\base\Widget;
use yii\helpers\Html;

class RelatedProductsWidget extends Widget 
{
    /**
     * @var Array
     */
    public $products;
    
    /**
     * @var integer
     */
    public $salesValue;
    
    public function init()
    {
        parent::init();
        
        if (empty($this->products)) {
            $this->products = "<div class='panel panel-default'>"
                . "<div class='panel-body'>"
                . "There aren't any related products"
                . "</div></div></div>";
        } else {       
            $message = "<div class='panel panel-default'>"
                    . "<div class='panel-heading'>Related products</div>"                    
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
                    . "<div class='panel-footer'>Overall sales value: " 
                    . $this->salesValue .' $'
                    ."</div></div>";
            
            $this->products = $message;
        }
    }
    
    public function run()
    {
        
        return Html::tag('div', $this->products, ['class' => 'col-md-12']);
                
    }
}