<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
/** @var yii\web\View $this */
/** @var common\models\Client $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Mijozlar ro`yhati', 'url' => ['index']];
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
        <button class="btn btn-info md-btncreate" value="<?= Yii::$app->urlManager->createUrl(['/cp/client/pay','id'=>$model->id])?>"><span class="fa fa-money"></span> To'lov qabul qilish</button>
    </p>

            <div class="row">
                <div class="col-md-4">

                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'id',
                            'name',
                            'phone',
//                            'balance',
                            [
                                'attribute'=>'balance',
                                'value'=>function($model){
                                    return number_format($model->balance,2,'.',' ');
                                }
                            ],
                            'source.name',
//                            'gender',
                            [
                                'attribute'=>'gender',
                                'value'=>function($model){
                                    return Yii::$app->params['gender'][$model->gender];
                                }
                            ],
                            'birthday',
//                            'address',
                            [
                                'attribute'=>'address',
                                'value'=>function($model){
                                    return $model->region->name.' '.$model->district->name.' '.$model->address;
                                }
                            ],
                            'group.name',
                            'description:ntext',

//                            'status',
                            [
                                'attribute'=>'status',
                                'value'=>function($model){
                                    return Yii::$app->params['status'][$model->status];
                                }
                            ],
                            'created',
                            'updated',
                            [
                                'attribute'=>'register_id',
                                'value'=>function($model){return $model->register->name;}
                            ],
                            [
                                'attribute'=>'modify_id',
                                'value'=>function($model){return $model->modify->name;}
                            ],
                        ],
                    ]) ?>
                </div>
                <div class="col-md-8">


                    <div class="pd-20 card-box">
                        <h5 class="h4 text-blue mb-20">Mijoz bilan munosabatlar</h5>
                        <div class="tab">
                            <ul class="nav nav-tabs customtab" role="tablist">

                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#paid" role="tab" aria-selected="true">To'lovlar</a>
                                </li>

                            </ul>
                            <div class="tab-content">

                                <div class="tab-pane fade active show" id="paid" role="tabpanel" style="padding-top:20px;">

                                    <?= GridView::widget([
                                        'dataProvider' => $dataPaidProvider,
                                        'filterModel' => $searchPaidModel,
                                        'columns' => [
                                            ['class' => 'yii\grid\SerialColumn'],
                                            [
                                                'attribute'=>'date',
                                                'value'=>function($d){
                                                    $url = Yii::$app->urlManager->createUrl(['/cp/client/pay-update','id'=>$d->id]);
                                                    return Html::button($d->date,['class'=>'btn btn-link md-btnupdate','value'=>$url]);
                                                },
                                                'format'=>'raw',
                                            ],
                                            [
                                                'attribute'=>'price',
                                                'value'=>function($d){
                                                    return number_format($d->price,2,'.',' ');
                                                }
                                            ],
                                            [
                                                'attribute'=>'payment_id',
                                                'value'=>function($d){
                                                    return '<b>'.$d->payment->name.'</b><br><div style="position: relative"><span class="oneline" data-full="'.$d->description.'">'.$d->description.'</span></div>';;
                                                },
                                                'format'=>'raw',
                                                'filter'=>\yii\helpers\ArrayHelper::map(\common\models\Payment::find()->where(['status'=>1])->all(),'id','name'),
                                            ],
                                            'created',
                                            [
                                                'attribute'=>'status',
                                                'value'=>function($d){
                                                    return Yii::$app->params['status'][$d->status];
                                                },
                                                'filter'=>Yii::$app->params['status'],
                                            ],
                                            [
                                                'label'=>'',
                                                'value'=>function($d){
                                                    $url = Yii::$app->urlManager->createUrl(['/cp/client/pay-delete','id'=>$d->id]);
                                                    return Html::a('<span class="fa fa-trash"></span>',$url,['class'=>'btn btn-danger','data-method'=>'post','data-confirm'=>'Siz rostdan ham ushbu elementni o`chirmoqchimisiz?']);
                                                },
                                                'format'=>'raw'
                                            ],
                                        ],
                                    ]); ?>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
