<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Product;

class ProductModel extends Model
{        
    /**
     * Returns not deleted products
     * @return Array
     */
    public function getActiveProducts()
    {
        $products = Product::find()->where(['deleted' => 0])->all();
        
        return $products;
    }
    
    /**
     * Returns deleted products
     * @return Array
     */
    public function getDeletedProducts()
    {
        $products = Product::find()->where(['deleted' => 1])->all();
        
        return $products;
    }
    
    /**
     * Deletes all products with flag "deleted" from database
     * @param integer $id
     */
    public function discardDeleted($id = null)
    {
        if ($id) {
            $product = Product::find()->where(['id' => $id])->one();
            $product->delete();
        } else {
            Product::deleteAll('deleted = 1');
        }
    }
    
    /**
     * Gets latest 5 products added last week
     * @return Array
     */
    public function getNewestProducts() {
        $lastWeekStart = time() - 60*60*24*7;
        
        $products = Product::find()
                ->where(['>=', 'created_at', $lastWeekStart])
                ->orderBy("created_at DESC")
                ->all();
        $productsArr = [];
        
        for ($i = 0; $i < 5 ? $i < sizeof($products): $i < 5; $i++) {
            $product = [];
            $product['id'] = $products[$i]->id;
            $product['name'] = $products[$i]->product_name;
            $product['price'] = $products[$i]->price;
            $productsArr[] = $product;
        }
        
        return $productsArr;
    }
}