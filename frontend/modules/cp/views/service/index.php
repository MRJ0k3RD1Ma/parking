<?php

use common\models\Departament;
use common\models\Service;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\ServiceSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Xizmatlar ro`yhati';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="service-index">

<div class="card">
    <div class="card-body">


    <p>
        <?= Html::button('Xizmat qo`shish', ['class' => 'btn btn-success md-btncreate','value'=>Yii::$app->urlManager->createUrl(['/cp/service/create'])]) ?>
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
                    $url = Yii::$app->urlManager->createUrl(['/cp/service/update','id'=>$d->id]);
                    return Html::button($d->name,['value'=>$url,'class'=>'btn btn-link md-btnupdate']);
                },
                'format'=>'raw',
            ],
//            'id',
//            'name',
            'price',
//            'departament_id',
            [
                'attribute'=>'departament_id',
                'value'=>function($d){
                    return $d->departament->name;
                },
                'filter'=>\yii\helpers\ArrayHelper::map(Departament::find()->where(['status'=>1])->all(),'id','name'),
            ],
//            'has_file',
            [
                'attribute'=>'has_file',
                'value'=>function($d){
                    return Yii::$app->params['or'][$d->has_file];
                },
                'filter'=>Yii::$app->params['or'],
            ],
            //'status',
            'created',
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
                    $url = Yii::$app->urlManager->createUrl(['/cp/service/delete','id'=>$d->id]);
                    return Html::a("<span class='fa fa-trash'></span>",$url,['class'=>'btn btn-danger','data-method'=>'post','data-confirm'=>'Siz rostdan ham ushbu elementni o`chirmoqchimisiz?']);
                }
            ],
        ],
    ]); ?>


    </div>
</div>
</div>
