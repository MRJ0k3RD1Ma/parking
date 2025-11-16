<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\CarTypePlan $model */

$this->title = 'Create Car Type Plan';
$this->params['breadcrumbs'][] = ['label' => 'Car Type Plans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="car-type-plan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
