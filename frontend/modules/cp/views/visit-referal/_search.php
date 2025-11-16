<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\search\VisitReferalSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="visit-referal-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'visit_id') ?>

    <?= $form->field($model, 'referal_id') ?>

    <?= $form->field($model, 'service_id') ?>

    <?= $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'price_referal') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'updated') ?>

    <?php // echo $form->field($model, 'register_id') ?>

    <?php // echo $form->field($model, 'modify_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
