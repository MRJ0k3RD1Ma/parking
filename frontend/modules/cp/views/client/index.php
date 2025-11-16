<?php

use common\models\Client;
use common\models\ClientGroup;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\ClientSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Mijozlar ro`yhati';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="client-index">

<div class="card">
    <div class="card-body">


    <p>
        <?= Html::button('Mijoz qo`shish', ['class' => 'btn btn-success md-btncreate','value'=>Yii::$app->urlManager->createUrl(['/cp/client/create'])]) ?>
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
                    $url = Yii::$app->urlManager->createUrl(['/cp/client/view','id'=>$d->id]);
                    return Html::a($d->name,$url);
                },
                'format'=>'raw',
            ],
//            'id',
//            'name',
            'phone',
//            'group_id',
            [
                'attribute'=>'group_id',
                'value'=>function($d){
                    return $d->group->name;
                },
                'filter'=>\yii\helpers\ArrayHelper::map(ClientGroup::find()->where(['status'=>1])->all(),'id','name'),
            ],
            [
                'attribute'=>'gender',
                'value'=>function($d){
                    return Yii::$app->params['gender'][$d->gender];
                },
                'filter'=>Yii::$app->params['gender'],
            ],
//            'gender',
            //'birthday',
//            'region_id',
            [
                'attribute'=>'region_id',
                'value'=>function($d){
                    return $d->region->name;
                },
                'filter'=>\yii\helpers\ArrayHelper::map(\common\models\LocRegion::find()->where(['status'=>1])->all(),'id','name')
            ],
            [
                'attribute'=>'district_id',
                'value'=>function($d){
                    return $d->district->name;
                },
                'filter'=>\yii\helpers\ArrayHelper::map(\common\models\LocDistrict::find()->where(['status'=>1])->andWhere(['region_id'=>$searchModel->region_id])->all(),'id','name')
            ],
//            'district_id',
            //'address',
            'balance',
            //'description:ntext',
            //'source_id',
            [
                'attribute'=>'source_id',
                'value'=>function($d){
                    return $d->source->name;
                },
                'filter'=>\yii\helpers\ArrayHelper::map(\common\models\Source::find()->where(['status'=>1])->all(),'id','name')
            ],
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
        ],
    ]); ?>


    </div>
</div>
</div>
