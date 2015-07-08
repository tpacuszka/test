<?php

namespace app\rbac;

use yii\rbac\Rule;

class AdminRule extends Rule
{
   public $name = 'isAdmin';
   
   /**
    * @param integer $user
    * @param Item $item
    * @param array $params
    * 
    * @return boolean
    */
   
   public function execute($user, $item, $params)
   {
       return \Yii::$app->authManager->getRolesByUser($user->getId()) === 'admin';
       
   }
}