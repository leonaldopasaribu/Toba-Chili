<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\DataTestingFeature */

$this->title = $model->idTesting;
$this->params['breadcrumbs'][] = ['label' => 'Data Testing Features', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="data-testing-feature-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->idTesting], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idTesting], [
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
            'idTesting',
            'suhu_min',
            'kelembabanUdara_maximum',
            'kelembabanUdara_minimum',
            'kelembabanUdara_avg',
            'kondisi_actual',
            'kondisi_predict',
        ],
    ]) ?>

</div>
