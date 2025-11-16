<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Camera $model */

$this->title = 'Create Camera';
$this->params['breadcrumbs'][] = ['label' => 'Cameras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="camera-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
