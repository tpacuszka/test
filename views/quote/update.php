<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Quote */

$this->title = 'Update Quote: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Quotes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="quote-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'clients' => $clients,
        'items' => $items
    ]) ?>

</div>
