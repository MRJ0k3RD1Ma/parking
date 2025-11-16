<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\CarType $model */

$this->title = 'Update Car Type: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Car Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="car-type-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
