<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\search\DataTestingFeatureSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Testing Features';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-testing-feature-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Data Testing Feature', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idTesting',
            'suhu_min',
            'kelembabanUdara_maximum',
            'kelembabanUdara_minimum',
            'kelembabanUdara_avg',
            //'kondisi_actual',
            //'kondisi_predict',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
