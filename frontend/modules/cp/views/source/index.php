<?php

use common\models\Source;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\SourceSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Eshitilgan manbalar ro`yhati';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="source-index">

<div class="card">
    <div class="card-body">


    <p>
        <?= Html::button('Manba qo`shish', ['class' => 'btn btn-success md-btncreate','value'=>Yii::$app->urlManager->createUrl(['/cp/source/create'])]) ?>
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
                    $url = Yii::$app->urlManager->createUrl(['/cp/source/update','id'=>$d->id]);
                    return Html::button($d->name,['class'=>'btn btn-link md-btnupdate','value'=>$url]);
                },
                'format'=>'raw',
            ],
            // 'id',
            // 'name',
            // 'status',
            'created',
            // 'updated',
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
                    $url = Yii::$app->urlManager->createUrl(['/cp/source/delete','id'=>$d->id]);
                    return Html::a('<span class="fa fa-trash"></span>',$url,['class'=>'btn btn-danger','data-method'=>'post','data-confirm'=>'Siz rostdan ham ushbu elementni o`chirmoqchimisiz?']);
                },
                'format'=>'raw'
            ],
        ],
    ]); ?>


    </div>
</div>
</div>
