<?php
namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Item;
use app\models\Quote;

class ItemModel extends Model
{
    /**
     * Saves all items related to quote to database
     * @param Array $items
     * @param Quote $quote
     * @return boolean
     */
    public function saveItems($items, $quote)
    {   
        #$newItems = [];        
        foreach ($items as $item) {
            $newItem = new Item();
            $newItem->created_by = Yii::$app->user->getId();
            $newItem->created_at = time();
            
            $newItem->name = $item['name'];
            $newItem->description = $item['description'];
            $newItem->data = $item['data'];
            $newItem->price = $item['price'];
            
            if (!$newItem->save(true)) {
                #$quote->link('items', $newItems);                
                return false;
            }
            $quote->link('items', $newItem);
            #$newItems[] = $newItem;
        }        
        
        #$quote->link('items', $newItems);        
        return true;
    }
    
    /**
     * Fetches items data from submitted form
     * 
     * @param Post $post
     * @return Array
     */
    public function fetchItemsData($post)
    {
        $itemsAmount = $post['items-amount'];
        $items = [];
        
        for ($i = 1; $i <= $itemsAmount; $i++) {
            $item = [];
            $item['name'] = $post['item-name'.$i];
            $item['amount'] = $post['item-amount'.$i]; 
            $item['data'] = $post['item-data'.$i];
            $item['description'] = $post['item-description'.$i];
            $item['discount'] = $post['item-discount'.$i];
            $item['final'] = $post['item-final'.$i];
            $item['price'] = $post['item-price'.$i];
            
            $items[] = $item;
        }
            
        return $items;
    }
}