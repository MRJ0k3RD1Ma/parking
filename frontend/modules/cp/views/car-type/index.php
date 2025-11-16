<?php

use common\models\CarType;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\CarTypeSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Moshina turlari';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="car-type-index">

<div class="card">
    <div class="card-body">


    <p>
        <?= Html::button('Moshina turi qo`shish', ['class' => 'btn btn-success md-btncreate','value'=>Yii::$app->urlManager->createUrl(['/cp/car-type/create'])]) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute'=>'name',
                'value'=>function($d){
                    $url = Yii::$app->urlManager->createUrl(['/cp/car-type/update','id'=>$d->id]);
                    return Html::button($d->name,['class'=>'btn btn-link md-btnupdate','value'=>$url]);
                },
                'format'=>'raw',
            ],
//            'id',
//            'name',
//            'type',
            [
                'attribute'=>'type',
                'value'=>function($d){
                    return $d->type;
                }
            ],
//            'daily',
//            'onetime:datetime',
            //'hourly',
            //'hourly_enter',
            //'enter',
            //'free_time:datetime',
            //'status',
            //'register_id',
            //'modify_id',
            //'created',
            //'updated',
            [
                'attribute'=>'status',
                'value'=>function($d){
                    return Yii::$app->params['status'][$d->status];
                },
                'filter'=>Yii::$app->params['status'],
            ],
        ],
    ]); ?>


    </div>
</div>
</div>
