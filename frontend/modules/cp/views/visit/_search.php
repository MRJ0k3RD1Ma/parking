<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\search\VisitSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="visit-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'client_id') ?>

    <?= $form->field($model, 'departament_id') ?>

    <?= $form->field($model, 'price') ?>

    <?= $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'state') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'updated') ?>

    <?php // echo $form->field($model, 'register_id') ?>

    <?php // echo $form->field($model, 'modify_id') ?>

    <?php // echo $form->field($model, 'is_emergency') ?>

    <?php // echo $form->field($model, 'emergency_car') ?>

    <?php // echo $form->field($model, 'is_onetime_payment') ?>

    <?php // echo $form->field($model, 'visit_date') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
