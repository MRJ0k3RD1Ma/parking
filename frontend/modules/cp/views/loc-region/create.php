<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\LocRegion $model */

$this->title = 'Create Loc Region';
$this->params['breadcrumbs'][] = ['label' => 'Loc Regions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="loc-region-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
