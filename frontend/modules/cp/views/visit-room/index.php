<?php

use common\models\VisitRoom;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\VisitRoomSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Visit Rooms';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="visit-room-index">

<div class="card">
    <div class="card-body">


    <p>
        <?= Html::button('Yaratish Visit Room', ['class' => 'btn btn-success md-btncreate','value'=>Yii::$app->urlManager->createUrl(['create'])]) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute'=>'id',
                'value'=>function($d){
                    $url = Yii::$app->urlManager->createUrl(['view','id'=>$d->id]);
                    return Html::a($d->id,$url);
                },
                'format'=>'raw',
            ],
            'id',
            'room_id',
            'visit_id',
            'client_id',
            'card_number',
            //'card_id',
            //'date_start',
            //'date_end',
            //'state',
            //'status',
            //'created',
            //'updated',
            //'register_id',
            //'modify_id',
            //'is_food_connected',
            //'price',
            //'price_count',
            //'doctor_id',
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
