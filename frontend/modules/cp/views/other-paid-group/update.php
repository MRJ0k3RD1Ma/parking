<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\OtherPaidGroup $model */

$this->title = 'Update Other Paid Group: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Other Paid Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="other-paid-group-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
