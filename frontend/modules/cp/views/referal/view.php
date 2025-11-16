<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Referal $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Hamkorlar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="referal-view">
    <div class="card">
        <div class="card-body">


    <p>
        <?= Html::button('O`zgartirish', ['class' => 'btn btn-primary md-btnupdate','value'=>Yii::$app->urlManager->createUrl(['/cp/referal/update', 'id' => $model->id])]) ?>
        <?= Html::a('O`chirish', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

            <div class="row">
                <div class="col-md-6">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'id',
                            'name',
                            'phone',
                            'balance',
                            'description:ntext',
                            'percent',
                            'status',
                            'created',
                            'updated',
//            'register_id',
                            [
                                'attribute'=>'register_id',
                                'value'=>function($model){
                                    return $model->register->name;
                                }
                            ],
                            [
                                'attribute'=>'modify_id',
                                'value'=>function($model){
                                    return $model->modify->name;
                                }
                            ],
//            'modify_id',
                        ],
                    ]) ?>
                </div>
                <div class="col-md-6">

                </div>
            </div>

        </div>
    </div>
</div>
