<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\CarType $model */

$this->title = 'Create Car Type';
$this->params['breadcrumbs'][] = ['label' => 'Car Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="car-type-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
