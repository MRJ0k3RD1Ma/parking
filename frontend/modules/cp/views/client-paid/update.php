<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\ClientPaid $model */

$this->title = 'Update Client Paid: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Client Paids', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="client-paid-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
