<?php

use common\models\Departament;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\DepartamentSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Bo`limlar ro`yhati';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="departament-index">

<div class="card">
    <div class="card-body">


    <p>
        <?= Html::button('Bo`lim qo`shish', ['class' => 'btn btn-success md-btncreate','value'=>Yii::$app->urlManager->createUrl(['/cp/departament/create'])]) ?>
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
                    $url = Yii::$app->urlManager->createUrl(['/cp/departament/update','id'=>$d->id]);
                    return Html::button($d->name,['class'=>'btn btn-link md-btnupdate','value'=>$url]);
                },
                'format'=>'raw',
            ],
//            'id',
//            'name',
//            'owner_id',
            [
                'attribute'=>'owner_id',
                'value'=>function($d){
                    return $d->owner->name;
                },
                'filter'=>\yii\helpers\ArrayHelper::map(\common\models\User::find()->where(['status'=>1])->andWhere('id in (select owner_id from departament)')->all(),'id','name')
            ],
//            'status',
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
                    $url = Yii::$app->urlManager->createUrl(['/cp/departament/delete','id'=>$d->id]);
                    return Html::a("<span class='fa fa-trash'></span>",$url,['class'=>'btn btn-danger','data-method'=>'post','data-confirm'=>'Siz rostdan ham ushbu elementni o`chirmoqchimisiz?']);
                }
            ],
        ],
    ]); ?>


    </div>
</div>
</div>
