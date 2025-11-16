<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Visit $model */

$this->title = 'Tashrif qo`shish';
$this->params['breadcrumbs'][] = ['label' => 'Tashriflar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="visit-create">


    <div class="card">
        <div class="card-body">
            <?= $this->render('_form', [
                'model' => $model,
                'client'=>$client
            ]) ?>
        </div>
    </div>

</div>
