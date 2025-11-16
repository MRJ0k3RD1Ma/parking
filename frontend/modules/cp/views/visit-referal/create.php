<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\VisitReferal $model */

$this->title = 'Create Visit Referal';
$this->params['breadcrumbs'][] = ['label' => 'Visit Referals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="visit-referal-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
