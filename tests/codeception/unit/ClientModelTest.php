<?php

use yii\codeception\DbTestCase;
use tests\unit\fixtures\ProductFixture;
use tests\unit\fixtures\ClientFixture;
use tests\unit\fixtures\UserFixture;
use app\models\ClientModel;

class ClientModelTest extends DbTestCase
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
    public function testGetAllClients()
    {
        $clients = ClientModel::getAllClients();
        
        $this->assertEquals(3, sizeof($clients));
    }
    
    /**
     * tests if type and size of returned value is proper
     */
    public function testGetClientProducts()
    {
        $clientModel = new ClientModel();
        
        $client1 = $this->clients('client1');
        $products1 = $clientModel->getClientProducts($client1->id);
        
        $this->assertEquals('array', gettype($products1));
        $this->assertEquals(0, sizeof($products1));                
        
        $client2 = $this->clients('client3');
        $products2 = $clientModel->getClientProducts($client2->id);
        
        $this->assertEquals('array', gettype($products2));
        $this->assertEquals(3, sizeof($products2));
    }
    
    /**
     * tests if value of sales from client is ok
     */
    public function testGetSalesValue()
    {
        $clientModel = new ClientModel();
        
        $client1 = $this->clients('client1');
        $sales1 = $clientModel->getSalesValue($client1->id);
        
        $client2 = $this->clients('client3');
        $sales2 = $clientModel->getSalesValue($client2->id);
        
        $this->assertEquals(0, $sales1);
        $this->assertEquals(300, $sales2);
    }
    
    /**
     * tests if amount of clients owned by user is right
     */
    public function testGetUserClients()
    {
        $clientModel = new ClientModel();
        
        $user1 = $this->users('user1');        
        $clients1 = $clientModel->getUserClients($user1->id);
        
        $this->assertEquals(2, sizeof($clients1));
        
        $user2 = $this->users('user2');        
        $clients2 = $clientModel->getUserClients($user2->id);
        
        $this->assertEquals(1, sizeof($clients2));
    }
    
    public function testGetNewestClients()
    {
        $clientModel = new clientModel;
        
        $clients = $clientModel->getNewestClients();
        
        $this->assertEquals('array', gettype($clients));
        $this->assertNotNull(sizeof($clients));
    }
}