<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\User $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>

    <div class="row">
        <div class="col-md-8">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'username')->textInput(['maxlength' => true,'disabled'=>true]) ?>

            <?= $form->field($model, 'password')->passwordInput(['maxlength' => true])->label('Eski parolni kiriting') ?>

            <?= $form->field($model, 're_one_password')->passwordInput(['maxlength' => true])->label('Yangi parol kiriting') ?>
            <?= $form->field($model, 're_two_password')->passwordInput(['maxlength' => true])->label('Yangi parolni qayta kiriting') ?>

            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

        </div>
        <div class="col-md-4">
            <div class="form-group" style="margin-bottom: 33px;">
                <img src="/upload/<?= $model->isNewRecord ? 'default/avatar.png' : $model->image?>" id="blah" style="height:200px; width:auto;">
            </div>
            <div class="form-group">
                <label>Rasm</label>
                <div class="custom-file">
                    <input type="file" name="User[image]" id="user-image" class="custom-file-input">
                    <label class="custom-file-label">Rasmni tanlang</label>
                </div>
            </div>


        </div>


    </div>

    <div class="form-group">
        <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$this->registerJs("
        function readURL(input) {
          if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function(e) {
              $('#blah').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
          }
        }
        
        $('#user-image').change(function() {
          readURL(this);
        });
 
");