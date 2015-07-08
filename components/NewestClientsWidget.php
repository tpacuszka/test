<?php

namespace app\components;

use yii\base\Widget;
use yii\helpers\Html;

class NewestClientsWidget extends Widget 
{
    /**
     * @var Array
     */
    public $clients;    
    
    public function init()
    {
        parent::init();
        
        if (empty($this->clients)) {
            $this->clients = "<div class='panel panel-default'>"
                . "<div class='panel-body'>"
                . "There aren't any new clients"
                . "</div></div></div>";
        } else {       
            $message = "<div class='panel panel-default'>"
                    . "<div class='panel-heading'>Newest clients</div>"                    
                . "<div class='panel-body'>"
                . "<ul class='list-group'>";
            
            //adding every produc to list
            foreach ($this->clients as $client) {
                $message .= '<li class="list-group-item">'
                . '<a href="/clients/'.$client['id'].'">'
                . $client['name'].'</a>'
                . '<div class="pull-right">'.$client['address'].'</div>'
                . '</li>';
            }        
            $message .= "</ul></div>"
                    . "<div class='panel-footer'>"
                    ."</div></div>";
            
            $this->clients = $message;
        }
    }
    
    public function run()
    {
        
        return Html::tag('div', $this->clients, ['class' => 'col-md-6 col-sm-6 newest-clients']);
                
    }
}