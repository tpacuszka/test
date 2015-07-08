<?php

namespace app\modules\reports;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\reports\controllers';

    public $urlRules = [
        ['class' => 'yii\rest\UrlRule', 
                    'controller' => ['client', 'product', 'quote', 'item']]
    ];
    
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
