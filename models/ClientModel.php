<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Client;

class ClientModel extends Model
{
    /**
     * Returns array with all clients with id and name
     * 
     * @return Array
     */
    public function getAllClients()
    {
        $clients = Client::find()->all();
        
        $clientsArr = [];
        foreach ($clients as $client) {
            $clientArr = ['label' => $client->name, 
                        'value' => $client->name,
                        'id' => $client->id];
            $clientsArr[] = $clientArr;
            
        }
        
        return $clientsArr;
    }
    
    /**
     * Gets products related to client
     * @param integer $id
     * @return array
     */
    public function getClientProducts($id)
    {
        $client = Client::find()->where(['id' => $id])->one();        
        $products = $client->getProducts();
        
        $productsArr = [];
        
        //iterates through objects and inserts data to array
        foreach ($products->all() as $productObj) {
            $product = ['id' => $productObj->id,
                        'name' => $productObj->product_name,
                        'price' => $productObj->price];
            $productsArr[] = $product;
        }
        return $productsArr;
    }
    
    /**
     * Calculates value of all products sold to client 
     * @param double $id
     */
    public function getSalesValue($id)
    {
        $products = $this->getClientProducts($id);
        $salesValue = 0;
        
        foreach ($products as $product) {
            $salesValue += $product['price'];
        }
       
        return $salesValue;
    }
    
    /**
     * Returns all clients owned by user with $userId
     * @param integer $userId
     * @return Array
     */
    public function getUserClients($userId)
    {
        $clients = Client::find()->where(['owned_by' => $userId])->all();
        
        return $clients;
    }
    
    /**
     * Gets latest 5 clients added last week
     * @return Array
     */
    public function getNewestClients() {
        $lastWeekStart = time() - 60*60*24*7;
        
        $clients = Client::find()
                ->where(['>=', 'created_at', $lastWeekStart])
                ->orderBy("created_at DESC")
                ->all();
        $clientsArr = [];
        
        $limit = sizeof($clients) > 5 ? 5 : sizeof($clients);
        
        for ($i = 0; $i < $limit; $i++) {
            $client = [];
            $client['id'] = $clients[$i]->id;
            $client['name'] = $clients[$i]->name;
            $client['address'] = $clients[$i]->address; 
            $clientsArr[] = $client;
        }
        
        return $clientsArr;
    }
}