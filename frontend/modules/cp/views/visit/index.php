<?php

use common\models\Visit;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\VisitSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Tashriflar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="visit-index">

<div class="card">
    <div class="card-body">


    <p>
        <?= Html::a('Tashrif qo`shish',Yii::$app->urlManager->createUrl(['/cp/visit/create']), ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute'=>'visit_date',
                'value'=>function($d){
                    $url = Yii::$app->urlManager->createUrl(['/cp/visit/view','id'=>$d->id]);
                    return Html::a($d->visit_date,$url);
                },
                'format'=>'raw',
            ],
//            'id',
//            'client_id',
            [
                'attribute'=>'client_id',
                'value'=>function($d){
                    return $d->client->name;
                },
                'filter'=>\yii\helpers\ArrayHelper::map(\common\models\Client::find()->where(['status'=>1])->all(),'id',function($d){return $d->name.' '.$d->phone;}),
            ],
//            'departament_id',
            [
                'attribute'=>'departament_id',
                'value'=>function($d){
                    return $d->departament->name;
                },
                'filter'=>ArrayHelper::map(\common\models\Departament::find()->where(['status'=>1])->all(),'id','name'),
            ],
            'price',
//            'description:ntext',
            //'state',
            //'status',
            'created',
            //'updated',
            //'register_id',
            //'modify_id',
            //'is_emergency',
            //'emergency_car',
            //'is_onetime_payment:datetime',
            //'visit_date',
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
