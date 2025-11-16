<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\ClientPaid $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="client-paid-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'client_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Client::find()->where(['status'=>1])->all(),'id',function($d){return $d->name.'-'.$d->phone;}),['prompt'=>'']) ?>

    <?= $form->field($model, 'payment_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Payment::find()->where(['status'=>1])->all(),'id','name'),['prompt'=>'']) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date')->textInput(['type'=>'date']) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>



    <div class="form-group">
        <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
