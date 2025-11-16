<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Payment $model */

$this->title = 'Update Payment: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Payments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="payment-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
