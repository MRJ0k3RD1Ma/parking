<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\ClientGroup $model */

$this->title = 'Update Client Group: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Client Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="client-group-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
