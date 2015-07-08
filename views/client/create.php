<?php

use yii\helpers\Html;
use app\assets\ClientAsset;



/* @var $this yii\web\View */
/* @var $model app\models\Client */

ClientAsset::register($this);
$this->title = 'Create Client';
$this->params['breadcrumbs'][] = ['label' => 'Clients', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="client-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>