<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\OtherPaidGroup $model */

$this->title = 'Create Other Paid Group';
$this->params['breadcrumbs'][] = ['label' => 'Other Paid Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="other-paid-group-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
