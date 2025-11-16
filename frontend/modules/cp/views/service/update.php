<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Service $model */

$this->title = 'Update Service: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Services', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="service-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
