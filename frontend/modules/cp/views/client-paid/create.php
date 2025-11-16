<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\ClientPaid $model */

$this->title = 'Create Client Paid';
$this->params['breadcrumbs'][] = ['label' => 'Client Paids', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="client-paid-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
