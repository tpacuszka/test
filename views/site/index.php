<?php
use app\components\NewestProductsWidget;
use app\components\NewestClientsWidget;
/* @var $this yii\web\View */
$this->title = 'My Yii Application';
?>
<div class="site-index">
    <?php if (Yii::$app->user->isGuest == false) {
   echo NewestProductsWidget::widget(['products' => $products]);
   echo NewestClientsWidget::widget(['clients' => $clients]);
    } ?>
</div>
