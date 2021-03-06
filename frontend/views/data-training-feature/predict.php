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

$this->title = 'Prediksi Data';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="box box-primary" style="padding:10px">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,

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
                        return '<center><b class="text-success">Sehat</b></center>';
                    } else if ($model->kondisi_actual == "Tidak Sehat") {
                        return '<center><b class="text-danger">Tidak Sehat</b></center>';
                    } else {
                        return '<b class="text-warning"> - </b>';
                    }
                }
            ],

            [
                'attribute' => 'kondisi_predict',
                'label' => 'Kondisi Predict',
                'format' => 'raw',
                'value' => function ($model) {
                    if ($model->kondisi_predict == "Sehat") {
                        return '<center><b class="text-success">Sehat</b></center>';
                    } else if ($model->kondisi_predict == "Tidak Sehat") {
                        return '<center><b class="text-danger">Tidak Sehat</b></center>';
                    } else {
                        return '<b class="text-warning"> - </b>';
                    }
                }
            ],
        ],
    ]); ?>

    <div class="content">
        <div class="row">
            <div class="col-md-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <center>
                            <h2><b>Prediksi Data</b></h2>

                            <?php
                            $sehat = count(Yii::$app->db->createCommand("SELECT * from data_testing_feature as num WHERE kondisi_predict LIKE 'Sehat'")->queryAll());
                            $tidakSehat = count(Yii::$app->db->createCommand("SELECT * from data_testing_feature as num WHERE kondisi_predict LIKE 'Tidak Sehat'")->queryAll());
                            // echo count($c);
                            // die();
                            ?>
                            <h2><i> SEHAT = <?php echo number_format($sehat) ?></i></h2>
                            <h2><i> TIDAK SEHAT = <?php echo number_format($tidakSehat) ?></i></h2>
                            <h2></h2>
                            <h2></h2>
                        </center>
                        <br>
                    </div>
                    <div class="icon">
                        <i class="fa fa-leaf"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <center>
                            <h2><b>Prediksi Data</b></h2>

                            <?php
                            $tp = count(Yii::$app->db->createCommand("SELECT * from data_testing_feature as num WHERE kondisi_actual LIKE 'Sehat'  AND kondisi_predict LIKE 'Sehat'")->queryAll());
                            $tn = count(Yii::$app->db->createCommand("SELECT * from data_testing_feature as num WHERE kondisi_actual LIKE 'Tidak Sehat'  AND kondisi_predict LIKE 'Tidak Sehat'")->queryAll());
                            $fp = count(Yii::$app->db->createCommand("SELECT * from data_testing_feature as num WHERE kondisi_actual LIKE 'Sehat'  AND kondisi_predict LIKE 'Tidak Sehat'")->queryAll());
                            $fn = count(Yii::$app->db->createCommand("SELECT * from data_testing_feature as num WHERE kondisi_actual LIKE 'Tidak Sehat'  AND kondisi_predict LIKE 'Sehat'")->queryAll());
                            ?>

                            <h2><i> TRUE POSITIF = <?php echo number_format($tp) ?></i></h2>
                            <h2><i> TRUE NEGATIF = <?php echo number_format($tn) ?></i></h2>
                            <h2><i> FALSE POSITIF = <?php echo number_format($fp) ?></i></h2>
                            <h2><i> FALSE NEGATIF = <?php echo number_format($fn) ?></i></h2>
                        </center>
                        <br>
                    </div>
                    <div class="icon">
                        <i class="fa fa-leaf"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>