<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\VisitRoom $model */

$this->title = 'Create Visit Room';
$this->params['breadcrumbs'][] = ['label' => 'Visit Rooms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="visit-room-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
