<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Departament $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="departament-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'owner_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\User::find()->where(['status'=>1])->all(),'id','name')) ?>


    <div class="form-group">
        <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
