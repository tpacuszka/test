<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\components\RelatedProductsWidget;
use app\assets\ClientAsset;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model app\models\Client */
ClientAsset::register($this);
$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Clients', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="client-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name:ntext',
            'address',
            'postal_code',
            'created_at',
            'created_by',
        ],
    ]) ?>
    
    <?= Html::hiddenInput('client-id', $model->id, ['id' => 'client-id']) ?>
    <?= Html::hiddenInput('client-name', $model->name, ['id' => 'client-name']) ?>
    
    <?php
 
        Modal::begin([
            'toggleButton' => [
                'label' => '<i class="glyphicon glyphicon-plus"></i> Add products',
                'class' => 'btn btn-success modal-show',
                'id' => 'add-product'
            ],
            'closeButton' => [
              'label' => 'Close',
              'class' => 'btn btn-danger btn-sm pull-right',
            ],
            'size' => 'modal-md',
        ]);
       
        echo $this->render('/product/create', $popup);
        Modal::end();
    ?>
    <br><br>
     <?= RelatedProductsWidget::widget(['products' => $products, 
         'salesValue' => $salesValue]) ?>
</div>
