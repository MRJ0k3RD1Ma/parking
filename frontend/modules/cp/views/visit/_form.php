<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Visit $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="visit-form">

    <?php $form = ActiveForm::begin(); ?>

    <div style="display: block">
        <?= $form->field($model, 'client_id')->textInput() ?>
    </div>
<script>
    var setUser = function(){}
</script>

    <style>


        /* Asosiy dropdown ro‘yxat */
        .liveuser {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            z-index: 1000;
            background: #fff;
            border: 1px solid #e2e5ec;
            border-radius: 8px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.08);
            margin: 6px 0 0 0;
            padding: 6px 0;
            list-style: none;
            max-height: 280px;
            overflow-y: auto;
            display: none;
        }

        /* Har bir element */
        .liveuser-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            cursor: pointer;
            transition: background 0.1s ease;
        }

        .liveuser-item:hover {
            background: #f5f7ff;
        }

        /* Avatar */
        .liveuser-item .avatar {
            flex: 0 0 38px;
            height: 38px;
            border-radius: 50%;
            background: #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: #475569;
            font-size: 13px;
        }

        /* Ma’lumot qismi */
        .liveuser-item .info {
            display: flex;
            flex-direction: column;
        }

        .liveuser-item .title {
            font-weight: 600;
            font-size: 14px;
        }

        .liveuser-item .sub {
            font-size: 12px;
            color: #6b7280;
        }


    </style>

    <div class="row">
        <div class="col-md-12">
            <div class="row" style="margin-bottom: -15px;">
                <div class="col-md-6">
                    <?= $form->field($client, 'name')->textInput(['maxlength' => true,'autocomplete'=>"off"]) ?>

                </div>
                <div class="col-md-6">
                    <?= $form->field($client, 'phone')->widget(\yii\widgets\MaskedInput::class, [
                        'mask' => '(99)999-9999',
                        'options' => [
                            'placeholder' => '(99)123-4567',
                            'class' => 'form-control',
                        ],
                    ]) ?>
                </div>
            </div>
            <ul class="liveuser">

            </ul>
        </div>
        <div class="col-md-12">
            <?= $form->field($client, 'source_id')->radioList(\yii\helpers\ArrayHelper::map(\common\models\Source::find()->where(['status'=>1])->all(),'id','name')) ?>

        </div>
        <div class="col-md-6">
            <?= $form->field($client, 'gender')->radioList(Yii::$app->params['gender'],['style'=>'margin-bottom:33px;']) ?>

            <?= $form->field($client, 'group_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\ClientGroup::find()->where(['status'=>1])->all(),'id','name'),['prompt'=>'']) ?>
            <?= $form->field($client, 'region_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\LocRegion::find()->where(['status'=>1])->all(),'id','name'),['prompt'=>'']) ?>

        </div>
        <div class="col-md-6">
            <?= $form->field($client, 'birthday')->textInput(['type'=>'date']) ?>
            <?= $form->field($client, 'description')->textarea(['rows' => 6]) ?>
            <?= $form->field($client, 'district_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\LocDistrict::find()->where(['status'=>1])->andWhere(['region_id'=>$client->region_id])->all(),'id','name')) ?>

        </div>
        <div class="col-md-12">
            <?= $form->field($client, 'address')->textInput(['maxlength' => true]) ?>

        </div>

    </div>


    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'departament_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Departament::find()->where(['status'=>1])->all(),'id','name'),['prompt'=>'']) ?>

        </div>
        <div class="col-md-6">

        </div>
    </div>
    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>


    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'is_emergency')->textInput() ?>

    <?= $form->field($model, 'emergency_car')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_onetime_payment')->textInput() ?>

    <?= $form->field($model, 'visit_date')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$url = Yii::$app->urlManager->createUrl(['/cp/visit/search']);
$url_getuser = Yii::$app->urlManager->createUrl(['/cp/visit/getuser']);
$this->registerJs("
    $('#client-name').keyup(searchUser);
    $('#client-phone').keyup(searchUser);
    
    function enableUser(){
       
        $('#client-group_id').prop('disabled',false);
        $('input[name=\'Client[gender]\']').prop('checked', false);
        $('input[name=\'Client[gender]\']').prop('disabled', false);
        $('input[name=\'Client[source_id]\']').prop('disabled', false);
        $('input[name=\'Client[source_id]\']').prop('checked', false);
        $('#client-birthday').prop('disabled',false);
        $('#client-region_id').prop('disabled',false);
        $('#client-district_id').prop('disabled',false);
        $('#client-address').prop('disabled',false);
        $('#client-description').prop('disabled',false);
        
    }
    
    
    function searchUser(){
        var user = $('#client-name').val();
        var phone = $('#client-phone').val();
        if(user || phone){
            $.get('$url?name='+user+'&phone='+phone).done(function(data){
                if(data == -1){
                    $('.liveuser').empty();
                    $('.liveuser').css('display','none');
                    enableUser();
                }else{
                    $('.liveuser').empty();
                    $('.liveuser').append(data);
                    $('.liveuser').css('display','block');
                }
            })
        }else{
             $('.liveuser').empty();
             $('.liveuser').css('display','none');
             enableUser();
        }   
    }
    
    setUser = function(id){
        $('#visit-client_id').val(id);
        $('.liveuser').empty();
        $('.liveuser').css('display','none');
        $.get('{$url_getuser}?id='+id).done(function(data){
            if(data == -1){
                alert('foydalanuvchi topilmadi');
                enableUser();
            }else{
                data = JSON.parse(data);
                $('#client-name').val(data.name);
                $('#client-phone').val(data.phone);
                $('#client-group_id').val(data.group_id);
                $('#client-group_id').prop('disabled',true);
                
                $('input[name=\'Client[gender]\'][value=\''+data.gender+'\']').prop('checked', true);
                $('input[name=\'Client[gender]\']').prop('disabled', true);
                
                $('input[name=\'Client[source_id]\'][value=\''+data.source_id+'\']').prop('checked', true);
                $('input[name=\'Client[source_id]\']').prop('disabled', true);
                
                $('#client-birthday').val(data.birthday);
                $('#client-birthday').prop('disabled',true);
                $('#client-region_id').val(data.region_id);
                $('#client-region_id').prop('disabled',true);
                
                $('#client-district_id').empty();
                $('#client-district_id').append(data.districts);
                
                $('#client-district_id').val(data.district_id);
                $('#client-district_id').prop('disabled',true);
                $('#client-address').val(data.address);
                $('#client-address').prop('disabled',true);
                $('#client-description').prop('disabled',true);
            }
        }) 
    }
    
")

?>