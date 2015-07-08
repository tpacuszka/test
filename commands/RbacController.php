<?php

namespace app\commands;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        
        //add "createClient" permission
        $createClient = $auth->createPermission('createClient');
        $createClient->description = 'Create new client';
        $auth->add($createClient);
        
        //add "updateClient" permission
        $updateClient = $auth->createPermission('updateClient');
        $updateClient->description = 'Update client';
        $auth->add($updateClient);
        
        //add "deleteClient" permission
        $deleteClient = $auth->createPermission('deleteClient');
        $deleteClient->description = 'Delete client';
        $auth->add($deleteClient);
        
        //add "createProduct" permission
        $createProduct = $auth->createPermission('createProduct');
        $createProduct->description = 'Create new product';
        $auth->add($createProduct);
        
        //add "updateProduct" permission
        $updateProduct = $auth->createPermission('updateProduct');
        $updateProduct->description = 'Update product';
        $auth->add($updateProduct);
        
        //add "deleteProduct" permission
        $deleteProduct = $auth->createPermission('deleteProduct');
        $deleteProduct->description = 'Delete product';
        $auth->add($deleteProduct);
        
        //add "worker" role
        $worker = $auth->createRole('worker');
        $auth->add($worker);
        $auth->addChild($worker, $createClient);
        $auth->addChild($worker, $createProduct);
        
        //add "owner" role
        $owner = $auth->createRole('owner');
        $auth->add($owner);
        $auth->addChild($owner, $worker);
        $auth->addChild($owner, $updateClient);
        $auth->addChild($owner, $updateProduct);
        
        //add "admin" role
        $admin = $auth->createRole('admin');
        $auth->add($admin);        
        $auth->addChild($admin, $worker);
        $auth->addChild($admin, $owner);
        $auth->addChild($admin, $deleteClient);
        $auth->addChild($admin, $deleteProduct);
        
        $auth->assign($admin, 1);
    }
    
    public function actionUpdate()
    {
        $auth = Yii::$app->authManager;
        
        // add the rule
        $rule = new \app\rbac\OwnerRule();
        $auth->add($rule);

        // add the "updateOwnPost" permission and associate the rule with it.
        $updateOwnClient = $auth->createPermission('updateOwnClient');
        $updateOwnClient->description = 'Update own client';
        $updateOwnClient->ruleName = $rule->name;
        $auth->add($updateOwnClient);
        
        
        $owner = $auth->getRole('owner');
        $updateClient = $auth->getPermission('updateClient');
        
        // "updateOwnClient" will be used from "updateClient"
        $auth->addChild($updateClient, $updateOwnClient);
        
        // allow "owner" to update their own posts
        $auth->addChild($owner, $updateOwnClient);
        
        $updateOwnProduct = $auth->createPermission('updateOwnProduct');
        $updateOwnProduct->description = 'Update own product';
        $updateOwnProduct->ruleName = $rule->name;
        $auth->add($updateOwnProduct);
        
        $updateProduct = $auth->getPermission('updateProduct');
        
        // "updateOwnPost" will be used from "updatePost"
        $auth->addChild($updateProduct, $updateOwnProduct);

        
        // allow "author" to update their own posts
        $auth->addChild($owner, $updateOwnProduct);
    }
}