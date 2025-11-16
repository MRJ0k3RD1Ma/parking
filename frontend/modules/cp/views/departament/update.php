<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Departament $model */

$this->title = 'Update Departament: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Departaments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="departament-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
