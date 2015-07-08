<?php
namespace tests\unit\fixtures;

use yii\test\ActiveFixture;



class ProductFixture extends ActiveFixture
{
    public $modelClass = 'app\models\Product';
    public $depends = ['tests\unit\fixtures\UserFixture',
                        'tests\unit\fixtures\ClientFixture'];
    
}