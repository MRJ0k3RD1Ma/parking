<?php

use common\models\ClientPaid;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\ClientPaidSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Mijoz to`lovlari';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="client-paid-index">

<div class="card">
    <div class="card-body">



    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute'=>'date',
                'value'=>function($d){
                    $url = Yii::$app->urlManager->createUrl(['/cp/client-paid/update','id'=>$d->id]);
                    return Html::button($d->date,['class'=>'btn btn-link md-btnupdate','value'=>$url]);
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
            [
                'attribute'=>'client_id',
                'value'=>function($d){
                    return $d->client->name;
                },
                'filter'=>\yii\helpers\ArrayHelper::map(\common\models\Client::find()->all(),'id','name')
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
                    $url = Yii::$app->urlManager->createUrl(['/cp/client-paid/delete','id'=>$d->id]);
                    return Html::a('<span class="fa fa-trash"></span>',$url,['class'=>'btn btn-danger','data-method'=>'post','data-confirm'=>'Are you sure you want to delete this item?']);
                }
            ],
        ],
    ]); ?>


    </div>
</div>
</div>
