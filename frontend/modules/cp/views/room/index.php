<?php

use common\models\Room;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\RoomSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Xonalar ro`yhati';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="room-index">

<div class="card">
    <div class="card-body">

    <p>
        <?= Html::button('Xona qo`shish', ['class' => 'btn btn-success md-btncreate','value'=>Yii::$app->urlManager->createUrl(['/cp/room/create'])]) ?>
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
                    $url = Yii::$app->urlManager->createUrl(['/cp/room/update','id'=>$d->id]);
                    return Html::button($d->name,['class'=>'btn btn-link md-btnupdate','value'=>$url]);
                },
                'format'=>'raw',
            ],
//            'id',
//            'name',
//            'departament_id',
            [
                'attribute'=>'departament_id',
                'value'=>function($d){
                    return $d->departament->name;
                },
                'filter'=>ArrayHelper::map(\common\models\Departament::find()->all(),'id','name'),
            ],
            'capacity',
            'count_patient',
            //'user_id',
            'price',
            [
                'attribute'=>'user_id',
                'value'=>function($d){
                    return $d->user->name;
                },
                'filter'=>ArrayHelper::map(\common\models\User::find()->all(),'id','name'),
            ],
            //'price_food',
//            'state',
            //'status',
            //'created',
            //'updated',
            //'register_id',
            //'modify_id',
            [
                'attribute'=>'status',
                'value'=>function($d){
                    return Yii::$app->params['status'][$d->status];
                },
                'filter'=>Yii::$app->params['status'],
            ],
            'created',
            [
                'label'=>'',
                'format'=>'raw',
                'value'=>function($d){
                    $url = Yii::$app->urlManager->createUrl(['/cp/room/delete','id'=>$d->id]);
                    return Html::a("<span class='fa fa-trash'></span>",$url,['class'=>'btn btn-danger','data-method'=>'post','data-confirm'=>'Are you sure you want to delete this item?']);
                }
            ],
        ],
    ]); ?>


    </div>
</div>
</div>
