<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use dektrium\user\models\User;
use app\assets\QuoteAsset;
/* @var $this yii\web\View */
/* @var $model app\models\Quote */
/* @var $form yii\widgets\ActiveForm */
QuoteAsset::register($this);
?>

<div class="quote-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success create-quote' : 'btn btn-primary create-quote']) ?>
    </div>
    
    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'owner')
            ->dropDownList(
            ArrayHelper::map(User::find()->all(), 'id', 'username')
                    );
    ?>
    <strong>Client:</strong><br>
    <?php
        use yii\web\JsExpression;
        use yii\jui\AutoComplete;
        
        echo AutoComplete::widget([
            'clientOptions' => [
                'source' => $clients,
                'select' => new JsExpression("function(event, ui) {
                    console.log(ui);
                    $('#quote-client').val(ui.item.id);    
                    }")]
        ]); ?>
    <br>
    <?= Html::activeHiddenInput($model, 'client')?>
    <br>

    <?= $form->field($model, 'header')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>
    
    <?php ActiveForm::end(); ?>
    
    <?= $this->render('//item/_form', ['items' => $items]) ?>
       
</div>
