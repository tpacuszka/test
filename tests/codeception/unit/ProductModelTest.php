<?php

use yii\codeception\DbTestCase;
use tests\unit\fixtures\ProductFixture;
use tests\unit\fixtures\ClientFixture;
use tests\unit\fixtures\UserFixture;
use app\models\ProductModel;

class ProductModelTest extends DbTestCase
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    
    public function fixtures()
    {
        return [
            'users' => UserFixture::className(),
            'clients' => ClientFixture::className(),
            'products' => ProductFixture::className(),
        ];
    }

    // tests
    public function testDiscardDeleted()
    {
        $productModel = new ProductModel;
        
        $deleted = sizeof($productModel->getDeletedProducts());
        $this->assertEquals(3, $deleted);
        
        $productModel->discardDeleted();
        $deleted = sizeof($productModel->getDeletedProducts());
        
        $this->assertEquals(0, $deleted);        
    }
    
    public function testGetNewestProducts()
    {
        $productModel = new ProductModel;
        
        $products = $productModel->getNewestProducts();
        
        $this->assertEquals('array', gettype($products));
        $this->assertEquals(5, sizeof($products));
    }

}