<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Client $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Mijozlar mashinalari', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="client-view">
    <div class="card">
        <div class="card-body">


    <p>
        <?= Html::button('O`zgartirish', ['class' => 'btn btn-primary md-btnupdate','value'=>Yii::$app->urlManager->createUrl(['/cp/client/update', 'id' => $model->id])]) ?>
        <?= Html::a('O`chirish', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::button('To`lov qabul qilish',['class'=>'btn btn-info md-btncreate', 'value'=>Yii::$app->urlManager->createUrl(['/cp/client/pay','id'=>$model->id])])?>
    </p>

            <div class="row">
                <div class="col-md-3">
                    <h4>Mijoz ma'lumotlari</h4>
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'id',
                            'name',
                            'phone',
                            'number',
//            'type.name',
                            [
                                'attribute'=>'type_id',
                                'value'=>function($d){
                                    return $d->type->name;
                                }
                            ],
                            'price',
                            'deadline',
//            'status',
                            [
                                'attribute'=>'status',
                                'value'=>function($d){
                                    return Yii::$app->params['status'][$d->status];
                                }
                            ],
                            'created',
                            'updated',
//            'register_id',
                            [
                                'attribute'=>'register_id',
                                'value'=>function($d){
                                    return $d->register->name;
                                }
                            ],
//            'modify_id',
                            [
                                'attribute'=>'modify_id',
                                'value'=>function($d){
                                    return $d->modify->name;
                                }
                            ],
                        ],
                    ]) ?>
                </div>

                <div class="col-md-9">
                    <h4>To'lovlar ro'yhati</h4>
                    <?= \yii\grid\GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            [
                                'attribute'=>'date',
                                'value'=>function($d){
                                    $url = Yii::$app->urlManager->createUrl(['/cp/client/payupdate','id'=>$d->id]);
                                    return Html::a($d->date,$url);
                                },
                                'format'=>'raw',
                            ],
//                            'id',
//                            'client_id',
                            'price',
//                            'payment_id',
                            [
                                'attribute'=>'payment_id',
                                'value'=>function($d){
                                    return $d->payment->name;
                                },
                                'filter'=>\yii\helpers\ArrayHelper::map(\common\models\Payment::find()->where(['status'=>1])->all(),'id','name')
                            ],
                            'description:ntext',
                            'deadline',
                            [
                                'attribute'=>'status',
                                'value'=>function($d){
                                    return Yii::$app->params['status'][$d->status];
                                },
                                'filter'=>Yii::$app->params['status'],
                            ],
                            [
                                'label'=>'',
                                'format'=>'raw',
                                'value'=>function($d){
                                    $url = Yii::$app->urlManager->createUrl(['/cp/client/paydelete','id'=>$d->id]);
                                    return Html::a('<span class="fa fa-trash"></span>',$url,['class'=>'btn btn-danger','data-method'=>'post','data-confirm'=>'Are you sure you want to delete this item?']);
                                }
                            ],
                        ],
                    ]); ?>
                </div>
            </div>

        </div>
    </div>
</div>
