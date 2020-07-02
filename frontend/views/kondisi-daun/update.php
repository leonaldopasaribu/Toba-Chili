<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\KondisiDaun */

$this->title = 'Update Kondisi Daun: ' . $model->idKondisi;
$this->params['breadcrumbs'][] = ['label' => 'Kondisi Dauns', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idKondisi, 'url' => ['view', 'id' => $model->idKondisi]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="kondisi-daun-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
