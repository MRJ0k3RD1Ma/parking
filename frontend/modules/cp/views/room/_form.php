<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Room $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="room-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'departament_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Departament::find()->where(['status'=>1,])->all(),'id','name')) ?>

    <?= $form->field($model, 'capacity')->textInput() ?>

    <?= $form->field($model, 'user_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\User::find()->where(['status'=>1])->all(),'id','name'),['prompt'=>'Xonaga mas`ul doktorni tanlang']) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price_food')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
