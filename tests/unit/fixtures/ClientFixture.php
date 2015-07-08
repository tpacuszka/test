<?php
namespace tests\unit\fixtures;

use yii\test\ActiveFixture;

class ClientFixture extends ActiveFixture
{
    public $modelClass = 'app\models\Client';
    public $depends = ['tests\unit\fixtures\UserFixture'];
}