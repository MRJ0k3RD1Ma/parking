<?php

use common\models\Camera;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\CameraSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Kameralar ro`yhati';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="camera-index">

<div class="card">
    <div class="card-body">


    <p>
        <?= Html::button('Kamera qo`shish', ['class' => 'btn btn-success md-btncreate','value'=>Yii::$app->urlManager->createUrl(['/cp/camera/create'])]) ?>
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
                    $url = Yii::$app->urlManager->createUrl(['/cp/camera/update','id'=>$d->id]);
                    return Html::button($d->name,['class'=>'btn btn-link md-btnupdate', 'value'=>$url,]);
                },
                'format'=>'raw',
            ],
//            'id',
            'name',
            'type',
            'ipaddress',
//            'status',
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
            [
                'label'=>'',
                'format'=>'raw',
                'value'=>function($d){
                    $url = Yii::$app->urlManager->createUrl(['/cp/camera/delete','id'=>$d->id]);
                    return Html::a("<span class='fa fa-trash'></span>",$url,['class'=>'btn btn-danger', 'data-method'=>'post','data-confirm'=>'Are you sure you want to delete this item?']);
                }
            ],
        ],
    ]); ?>


    </div>
</div>
</div>
