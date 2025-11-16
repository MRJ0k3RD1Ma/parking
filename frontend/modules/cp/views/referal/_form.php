<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput; // <- qo'shdim

/** @var yii\web\View $this */
/** @var common\models\Referal $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="referal-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->widget(MaskedInput::class, [
        'mask' => '(99)999-9999',
        'options' => [
            'placeholder' => '(99)123-4567',
            'class' => 'form-control',
        ],
    ]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'percent')->textInput() ?>


    <div class="form-group">
        <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
