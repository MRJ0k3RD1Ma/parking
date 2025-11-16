<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\VisitRoom $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Visit Rooms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="visit-room-view">
    <div class="card">
        <div class="card-body">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('O`zgartirish', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('O`chirish', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'room_id',
            'visit_id',
            'client_id',
            'card_number',
            'card_id',
            'date_start',
            'date_end',
            'state',
            'status',
            'created',
            'updated',
            'register_id',
            'modify_id',
            'is_food_connected',
            'price',
            'price_count',
            'doctor_id',
        ],
    ]) ?>

        </div>
    </div>
</div>
