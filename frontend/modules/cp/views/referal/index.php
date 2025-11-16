<?php

use common\models\Referal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\ReferalSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Hamkorlar guruhi';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="referal-index">

<div class="card">
    <div class="card-body">


    <p>
        <?= Html::button('Hamkor qo`shish', ['class' => 'btn btn-success md-btncreate','value'=>Yii::$app->urlManager->createUrl(['/cp/referal/create'])]) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute'=>'name',
                'value'=>function($d){
                    $url = Yii::$app->urlManager->createUrl(['/cp/referal/view','id'=>$d->id]);
                    return Html::a($d->name,$url);
                },
                'format'=>'raw',
            ],
            'name',
            'phone',
            'balance',
            'percent',
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
        ],
    ]); ?>


    </div>
</div>
</div>
