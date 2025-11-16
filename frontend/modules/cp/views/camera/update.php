<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Camera $model */

$this->title = 'Update Camera: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Cameras', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="camera-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
