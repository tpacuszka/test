<?php

namespace app\rbac;

use yii\rbac\Rule;

class WorkerRule extends Rule
{
   public $name = 'isWorker';
   
   /**
    * @param integer $user
    * @param Item $item
    * @param array $params
    * 
    * @return boolean
    */
   
   public function execute($user, $item, $params)
   {
       return true;
       
   }
}