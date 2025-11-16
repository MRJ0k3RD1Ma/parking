<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Source $model */

$this->title = 'Create Source';
$this->params['breadcrumbs'][] = ['label' => 'Sources', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="source-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
