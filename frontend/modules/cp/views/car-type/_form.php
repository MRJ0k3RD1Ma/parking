<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\CarType $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="car-type-form">
    <script>
        var deletehour = function(){}
    </script>
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->dropDownList(Yii::$app->params['car.payment.type'], ['prompt' => '']) ?>

    <div id="1D" style="display: <?= $model->type == '1D' ? 'block' : 'none'?>">
        <?= $form->field($model, 'daily')->textInput() ?>
    </div>

    <div id="1T" style="display: <?= $model->type == '1T' ? 'block' : 'none'?>">
        <?= $form->field($model, 'onetime')->textInput() ?>
    </div>

    <div id="1H" style="display: <?= $model->type == '1H' ? 'block' : 'none'?>">
        <div id="prices" data-maxid="<?= $model->isNewRecord ? "1" : \common\models\CarTypePlan::find()->max('id')+1 ?>" style="border: 1px solid #979393; padding:10px; border-radius: 10px;">
            <?php if(!$model->isNewRecord){?>
                <?php foreach ($model->plans as $item):?>
                    <div class="row price-item" data-id="<?=$item->id?>">
                        <div class="col-md-5">
                            <?= $form->field($model, 'plan['.$item->id.'][hour]')->textInput(['value'=>$item->hour])->label('Turish soati') ?>
                        </div>
                        <div class="col-md-5">
                            <?= $form->field($model, 'plan['.$item->id.'][price]')->textInput(['value'=>$item->price])->label('Narxi') ?>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-danger delete" onclick="deletehour(<?= $item->id?>)" type="button" style="margin-top:18px; width:100%; height:auto"><span class="fa fa-times"></span></button>
                        </div>
                    </div>
                <?php endforeach;?>
            <?php }else{
                ?>
                <div class="row price-item" data-id="0">
                    <div class="col-md-5">
                        <?= $form->field($model, 'plan[0][hour]')->textInput()->label('Turish soati') ?>
                    </div>
                    <div class="col-md-5">
                        <?= $form->field($model, 'plan[0][price]')->textInput()->label('Narxi') ?>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-danger" onclick="deletehour(0)" type="button" style="margin-top:18px; width:100%; height:auto"><span class="fa fa-times"></span></button>
                    </div>
                </div>
        <?php
            }?>

        </div>
        <button class="btn btn-info" id="hourly-plan_add" type="button" style="width: 100%"><span class="fa fa-plus"></span></button>
    </div>

    <div id="1HI" style="display: <?= $model->type == '1HI' ? 'block' : 'none'?>">
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'hourly_enter')->textInput() ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'enter')->textInput() ?>

            </div>
        </div>

    </div>


    <?= $form->field($model, 'free_time')->textInput() ?>


    <div class="form-group">
        <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
    $this->registerJs("
        $('#cartype-type').change(function(){
            var type = $(this).val();
                $('#1D').hide();
                $('#1T').hide();
                $('#1H').hide();
                $('#1HI').hide();
            if(type == '1D'){
                $('#1D').show();
            }
            if(type == '1T'){
                $('#1T').show();
            }
            if(type == '1H'){
                $('#1H').show();
            }
            if(type == '1HI'){
                $('#1HI').show();
            }
        });
        
        $('#hourly-plan_add').click(function(){
            var maxid = $('#prices').data('maxid');
            maxid = parseInt(maxid) + 1;
            $('#prices').data('maxid', maxid);
            $('#prices').attr('data-maxid', maxid);
            data = '<div class=\"row price-item\" data-id=\"'+maxid+'\"><div class=\"col-md-5\"><div class=\"form-group field-cartype-plan-'+maxid+'-hour\"><label class=\"control-label\" for=\"cartype-plan-'+maxid+'-hour\">Turish soati</label><input type=\"text\" id=\"cartype-plan-'+maxid+'-hour\" class=\"form-control\" name=\"CarType[plan]['+maxid+'][hour]\"></div></div><div class=\"col-md-5\"><div class=\"form-group field-cartype-plan-'+maxid+'-price\"><label class=\"control-label\" for=\"cartype-plan-'+maxid+'-price\">Narxi</label><input type=\"text\" id=\"cartype-plan-'+maxid+'-price\" class=\"form-control\" name=\"CarType[plan]['+maxid+'][price]\"></div>                    </div><div class=\"col-md-2\"><button class=\"btn btn-danger\" onclick=\"deletehour('+maxid+')\" type=\"button\" style=\"margin-top:18px; width:100%; height:auto\"><span class=\"fa fa-times\"></span></button></div></div>';
            $('#prices').append(data);
            
        })
        deletehour = function(id){
            $('.price-item[data-id=\"'+id+'\"]').remove();
        }
        
    ")
?>
