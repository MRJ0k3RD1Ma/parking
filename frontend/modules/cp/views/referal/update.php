<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Referal $model */

$this->title = 'Update Referal: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Referals', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="referal-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
