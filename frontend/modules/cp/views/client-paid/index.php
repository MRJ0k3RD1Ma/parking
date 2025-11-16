<?php

use common\models\ClientPaid;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\ClientPaidSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Tushumlar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="client-paid-index">

<div class="card">
    <div class="card-body">


    <p>
        <?= Html::button('Tushum qo`shish', ['class' => 'btn btn-success md-btncreate','value'=>Yii::$app->urlManager->createUrl(['/cp/client-paid/create'])]) ?>
    </p>

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
//            'price',
            [
                'attribute'=>'price',
                'value'=>function($d){
                    return number_format($d->price,2,'.',' ');
                }
            ],
//            'id',
//            'client_id',
            [
                'attribute'=>'client_id',
                'value'=>function($d){
                    $url = Yii::$app->urlManager->createUrl(['/cp/client/view','id'=>$d->client_id]);
                    return Html::a($d->client->name,$url);
                },
                'filter'=>\yii\helpers\ArrayHelper::map(\common\models\Client::find()->where(['status'=>1])->all(),'id','name'),
                'format'=>'raw',
            ],
//            'payment_id',
            [
                'attribute'=>'payment_id',
                'value'=>function($d){
                    return '<b>'.$d->payment->name.'</b><br><div style="position: relative"><span class="oneline" data-full="'.$d->description.'">'.$d->description.'</span></div>';;
                },
                'format'=>'raw',
                'filter'=>\yii\helpers\ArrayHelper::map(\common\models\Payment::find()->where(['status'=>1])->all(),'id','name'),
            ],
//            'date',
//            'description:ntext',
            //'price',
            'created',
            //'updated',
            //'status',
            //'register_id',
            //'modify_id',
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
                    $url = Yii::$app->urlManager->createUrl(['/cp/client-paid/delete','id'=>$d->id]);
                    return Html::a('<span class="fa fa-trash"></span>',$url,['class'=>'btn btn-danger','data-method'=>'post','data-confirm'=>'Siz rostdan ham ushbu elementni o`chirmoqchimisiz?']);
                },
                'format'=>'raw'
            ],
        ],
    ]); ?>


    </div>
</div>
</div>
