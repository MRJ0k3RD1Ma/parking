<?php

use common\models\LocDistrict;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\LocDistrictSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Tumanlar ro`yhati';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="loc-district-index">

<div class="card">
    <div class="card-body">


    <p>
        <?= Html::button('Tuman qo`shish', ['class' => 'btn btn-success md-btncreate','value'=>Yii::$app->urlManager->createUrl(['/cp/loc-district/create'])]) ?>
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
                    $url = Yii::$app->urlManager->createUrl(['/cp/loc-district/update','id'=>$d->id]);
                    return Html::button($d->name,['class'=>'btn btn-link md-btnupdate','value'=>$url]);
                },
                'format'=>'raw',
            ],
//            'id',
//            'region_id',
            [
                'attribute'=>'region_id',
                'value'=>function($d){
                    return $d->region->name;
                },
                'filter'=>ArrayHelper::map(\common\models\LocRegion::find()->where(['status'=>1])->all(),'id','name'),
            ],
//            'name',
//            'status',
            'created',
            //'updated',
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
                    $url = Yii::$app->urlManager->createUrl(['/cp/loc-district/delete','id'=>$d->id]);
                    return Html::a('<span class="fa fa-trash"></span>',$url,['class'=>'btn btn-danger','data-method'=>'post','data-confirm'=>'Siz rostdan ham ushbu elementni o`chirmoqchimisiz?']);
                },
                'format'=>'raw',
            ],
        ],
    ]); ?>


    </div>
</div>
</div>
