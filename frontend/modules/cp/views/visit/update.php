<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Visit $model */

$this->title = 'O`zgrtirish: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tashriflar', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'O`zgartirish';
?>
<div class="visit-update">

    <div class="card">
        <div class="card-body">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>



</div>
