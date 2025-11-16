<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Departament $model */

$this->title = 'Create Departament';
$this->params['breadcrumbs'][] = ['label' => 'Departaments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="departament-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
