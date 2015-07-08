<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use dektrium\user\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'product_name')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'price')->textInput() ?>
    
    <?= $form->field($model, 'owned_by')
            ->dropDownList(
            ArrayHelper::map(User::find()->all(), 'id', 'username')
                    );
    ?>
    <strong>Client:</strong>
    <?php
        use yii\web\JsExpression;
        use yii\jui\AutoComplete;
        
        echo AutoComplete::widget([
            'clientOptions' => [
                'source' => $clients,
                'select' => new JsExpression("function(event, ui) {
                    console.log(ui);
                    $('#product-client_id').val(ui.item.id);    
                    }")]
        ]); ?>
    <br>
    <?= Html::activeHiddenInput($model, 'client_id')?>
    <?= $form->field($model, 'file')->fileInput() ?>
    <br>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success create-product' : 'btn btn-primary update-product']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
