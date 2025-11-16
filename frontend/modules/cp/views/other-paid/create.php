<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\OtherPaid $model */

$this->title = 'Create Other Paid';
$this->params['breadcrumbs'][] = ['label' => 'Other Paids', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="other-paid-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
