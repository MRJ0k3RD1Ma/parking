<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Source $model */

$this->title = 'Update Source: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Sources', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="source-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
