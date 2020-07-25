<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use frontend\models\DataLingkungan;
use frontend\models\ZonaWaktu;
use frontend\models\Tanaman;
use dosamigos\datetimepicker\DateTimePicker;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\search\TanamanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Klasifikasi Data';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-primary" style="padding:10px">
    <div class="tanaman-index">
        <h3>Import Data</h3>
        <br>
        <div class="col-lg-6 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h2><b>Import Data Training</b></h2><br>
                    <br>
                    <?= Html::button('Import Data <i class="fa fa-fw fa-upload"></i>', ['value' => Url::to(['training']), 'title' => 'Import Data Training', 'class' => 'showModalButton btn btn-success']); ?>
                </div>
                <div class="icon">
                    <i class="fa fa-upload"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h2><b>Import Data Testing</b></h2><br>
                    <br>
                    <?= Html::button('Import Data <i class="fa fa-fw fa-upload"></i>', ['value' => Url::to(['testing']), 'title' => 'Import Data Testing', 'class' => 'showModalButton btn btn-success']); ?>
                </div>
                <div class="icon">
                    <i class="fa fa-upload"></i>
                </div>
            </div>
        </div>

        <div class="row">

            <!-- Tabel Data Training -->

            <div class="col-md-6">
                <h3>Tabel Data Training</h3>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'tableOptions' => ['class' => 'table table-stripped table-condensed table-bordered'],
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        [
                            'attribute' => 'suhu_min',
                            'label' => 'Suhu Minimum',
                            'value' => function ($data) {
                                return $data->suhu_min;
                            }
                        ],

                        [
                            'attribute' => 'kelembabanUdara_maximum',
                            'label' => 'Kelembaban Udara Max',
                            'value' => function ($data) {
                                return $data->kelembabanUdara_maximum;
                            }
                        ],

                        [
                            'attribute' => 'kelembabanUdara_minimum',
                            'label' => 'Kelembaban Udara Min',
                            'value' => function ($data) {
                                return $data->kelembabanUdara_maximum;
                            }
                        ],

                        [
                            'attribute' => 'kelembabanUdara_avg',
                            'label' => 'Kelembaban Udara Avg',
                            'value' => function ($data) {
                                return $data->kelembabanUdara_maximum;
                            }
                        ],

                        [
                            'attribute' => 'kondisi_actual',
                            'label' => 'Kondisi Actual',
                            'format' => 'raw',
                            'value' => function ($model) {
                                if ($model->kondisi_actual == "Sehat") {
                                    return '<b class="text-success">Sehat</b>';
                                } else if ($model->kondisi_actual == "Tidak Sehat") {
                                    return '<b class="text-danger">Tidak Sehat</b>';
                                } else {
                                    return '<b class="text-warning"> - </b>';
                                }
                            }
                        ],

                    ],
                ]); ?>
            </div>

            <!-- Tabel Data Testing -->

            <div class="col-md-6">
                <h3>Tabel Data Testing</h3>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider2,
                    'filterModel' => $searchModel2,
                    'tableOptions' => ['class' => 'table table-stripped table-condensed table-bordered'],
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        [
                            'attribute' => 'suhu_min',
                            'label' => 'Suhu Minimum',
                            'value' => function ($data) {
                                return $data->suhu_min;
                            }
                        ],

                        [
                            'attribute' => 'kelembabanUdara_maximum',
                            'label' => 'Kelembaban Udara Max',
                            'value' => function ($data) {
                                return $data->kelembabanUdara_maximum;
                            }
                        ],

                        [
                            'attribute' => 'kelembabanUdara_minimum',
                            'label' => 'Kelembaban Udara Min',
                            'value' => function ($data) {
                                return $data->kelembabanUdara_maximum;
                            }
                        ],

                        [
                            'attribute' => 'kelembabanUdara_avg',
                            'label' => 'Kelembaban Udara Avg',
                            'value' => function ($data) {
                                return $data->kelembabanUdara_maximum;
                            }
                        ],

                        [
                            'attribute' => 'kondisi_actual',
                            'label' => 'Kondisi Actual',
                            'format' => 'raw',
                            'value' => function ($model) {
                                if ($model->kondisi_actual == "Sehat") {
                                    return '<b class="text-success">Sehat</b>';
                                } else if ($model->kondisi_actual == "Tidak Sehat") {
                                    return '<b class="text-danger">Tidak Sehat</b>';
                                } else {
                                    return '<b class="text-warning"> - </b>';
                                }
                            }
                        ],

                        [
                            'attribute' => 'kondisi_predict',
                            'label' => 'Kondisi Actual',
                            'format' => 'raw',
                            'value' => function ($model) {
                                if ($model->kondisi_predict == "Sehat") {
                                    return '<b class="text-success">Sehat</b>';
                                } else if ($model->kondisi_predict == "Tidak Sehat") {
                                    return '<b class="text-danger">Tidak Sehat</b>';
                                } else {
                                    return '<b class="text-warning"> - </b>';
                                }
                            }
                        ],
                    ],
                ]); ?>
            </div>
        </div>
    
        <center><?= Html::a('KLASIFIKASI DATA', ['predict'], ['class'=>'btn-lg btn-success grid-button']) ?></center>

        <div class="content">
            <div class="row">
                <div class="col-md-6 col-xs-12 col-md-offset-3">
                    <!-- small box -->
                    <div class="small-box bg-green">
                        <!-- <div class="inner">
                            <h2><b>Prediksi Data</b></h2>
                            <h2><i> SEHAT = 20 Data</i></h2>
                            <h2><i> TIDAK SEHAT = 0 Data</i></h2>
                            <br>
                        </div>
                        <div class="icon">
                            <i class="fa fa-leaf"></i>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>