<?php

use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $model app\models\Item */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="item-form">
    <form id="product-form" method="post">
        <b>Products:</b>
        <div class="col-md-12">
            <table class="table table-bordered items-table">
                <thead>
                    <tr>
                        <th>
                            Options
                            <input type="hidden" id="items-amount" name="items-amount" value="1">
                        </th>
                        <th>
                            Description
                        </th>
                        <th>
                            Amount
                        </th>
                        <th>
                            Price
                        </th>
                    </tr>
                </thead>
                <tbody id="items-body">
                    <tr class="item hide">
                        <td class="col-md-1">
                            <span class="glyphicon glyphicon-trash"></span>
                        </td>
                        <td class="col-md-5 form-group">                        
                            <input type="text" class="form-control item-name" id="item-name" name="item-name" placeholder="Name"><br>                        
                            <textarea class="form-control item-description" id="item-description" name="item-description" placeholder="Description"></textarea><br>                        
                            <textarea class="form-control item-data" id="item-data" name="item-data" placeholder="Technical data"></textarea><br>                
                        </td>
                        <td class="col-md-3 form-group">                        
                            <input type="text" class="form-control item-amount" id="item-amount" name="item-amount" placeholder="Amount"><br>
                        </td>
                        <td class="col-md-3 form-group">

                            <input type="text" class="form-control item-price" id="item-price" name="item-price" placeholder="Price"><br>

                            <input type="text" class="form-control item-discount" id="item-discount" name="item-discount" placeholder="Discount"><br>

                            <input type="text" class="form-control item-final" id="item-final" name="item-final" placeholder="Final price">                
                        </td>
                    <tr>
                    <?php if (sizeof($items) > 0):?> 
                        <?php foreach ($items as $item): ?>    
                        <tr class="item">
                            <td class="col-md-1">
                                <span class="glyphicon glyphicon-trash"></span>
                            </td>
                            <td class="col-md-5 form-group">                        
                                <input type="text" class="form-control item-name" id="item-name1" name="item-name1" placeholder="Name" value="<?= $item->name ?>"><br>                        
                                <textarea class="form-control item-description" id="item-description1" name="item-description1" placeholder="Description"><?= $item->description ?></textarea><br>                        
                                <textarea class="form-control item-data" id="item-data1" name="item-data1" placeholder="Technical data"><?= $item->data ?></textarea><br>                
                            </td>
                            <td class="col-md-3 form-group">                        
                                <input type="text" class="form-control item-amount" id="item-amount1" name="item-amount1" placeholder="Amount" value="<?= $item->amount ?>"><br>
                            </td>
                            <td class="col-md-3 form-group">

                                <input type="text" class="form-control item-price" id="item-price1" name="item-price1" placeholder="Price" value="<?= $item->price ?>"><br>

                                <input type="text" class="form-control item-discount" id="item-discount1" name="item-discount1" placeholder="Discount" value="<?= $item->discount ?>"><br>

                                <input type="readonly" class="form-control item-final" id="item-final1" name="item-final1" placeholder="Final price" value="<?= $item->final ?>">                
                            </td>
                        </tr>
                        <?php endforeach ?>
                    <?php else: ?>
                        <tr class="item">
                            <td class="col-md-1">
                                <span class="glyphicon glyphicon-trash"></span>                                
                            </td>
                            <td class="col-md-5 form-group">                        
                                <input type="text" class="form-control item-name" id="item-name1" name="item-name1" placeholder="Name"><br>                        
                                <textarea class="form-control item-description" id="item-description1" name="item-description1" placeholder="Description"></textarea><br>                        
                                <textarea class="form-control item-data" id="item-data1" name="item-data1" placeholder="Technical data"></textarea><br>                
                            </td>
                            <td class="col-md-3 form-group">                        
                                <input type="text" class="form-control item-amount" id="item-amount1" name="item-amount1" placeholder="Amount"><br>
                            </td>
                            <td class="col-md-3 form-group">

                                <input type="text" class="form-control item-price" id="item-price1" name="item-price1" placeholder="Price"><br>

                                <input type="text" class="form-control item-discount" id="item-discount1" name="item-discount1" placeholder="Discount"><br>

                                <input type="text" class="form-control item-final" id="item-final1" name="item-final1" placeholder="Final price">                
                            </td>
                        </tr>
                    <?php endif ?>
                </tbody>                   
            </table>
            <div class="col-md-2">
                <?= Html::button('Add item', ["class" => "btn btn-info", 'id' => 'add-item']) ?>
            </div><br>
        </div>
    </form>
</div>
