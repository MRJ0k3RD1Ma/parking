<?php

use common\models\Car;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\CarSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Kirish/chiqishlar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="car-index">

<div class="card">
    <div class="card-body">


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'number',
//            'type_id',
            [
                'attribute'=>'type_id',
                'value'=>function($model){
                    return $model->type->name;
                },
                'filter'=>ArrayHelper::map(\common\models\CarType::find()->where(['status'=>1])->all(),'id','name'),
            ],
            'price',
            'enter_time',
            'exit_time',
            [
                'attribute'=>'payment_id',
                'value'=>function($model){
                    return @$model->payment->name;
                },
                'filter'=>ArrayHelper::map(\common\models\Payment::find()->where(['status'=>1])->all(),'id','name'),
            ],
            [
                'label'=>'',
                'value'=>function($d){
                    $url = Yii::$app->urlManager->createUrl(['/cp/car/clear','id'=>$d->id]);
                    return Html::a('<span class="fa fa-refresh"></span>',$url,['class'=>'btn btn-danger']);
                },
                'format'=>'raw',
            ],
        ],
    ]); ?>


    </div>
</div>
</div>
