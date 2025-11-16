<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\VisitReferal $model */

$this->title = 'Update Visit Referal: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Visit Referals', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="visit-referal-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
