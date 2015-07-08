<?php

namespace app\rbac;

use yii\rbac\Rule;

class OwnerRule extends Rule
{
   public $name = 'isOwner';
   
   /**
    * @param integer $user
    * @param Item $item
    * @param array $params
    * 
    * @return boolean
    */
   
   public function execute($user, $item, $params)
   {
       return isset($params['post']) ? $params['post']->owned_by == $user : false;
       
   }
}