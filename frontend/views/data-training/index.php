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
                    <?= Html::button('Import Data <i class="fa fa-fw fa-upload"></i>', ['value' => Url::to(['import']), 'title' => 'Import Data Training', 'class' => 'showModalButton btn btn-success']); ?>
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
                    <?= Html::button('Import Data <i class="fa fa-fw fa-upload"></i>', ['value' => Url::to(['import']), 'title' => 'Import Data Testing', 'class' => 'showModalButton btn btn-success']); ?>
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
                            'attribute' => 'waktuPencatatan',
                            'label' => 'Waktu Pencacatan',
                            'format' => 'raw',
                            'headerOptions' => ['style' => 'color:#3c8dbc'],
                            'value' => function ($model, $key, $index) {
                                if ($model->waktuPencatatan == NULL) {
                                    return '-';
                                } else {
                                    return date('d M Y H:i', strtotime($model->waktuPencatatan));
                                }
                            },
                            'filter' => DateTimePicker::widget([
                                'model' => $searchModel,
                                'attribute' => 'waktuPencatatan',
                                'template' => '{input}{reset}{button}',
                                'clientOptions' => [
                                    'startView' => 2,
                                    'minView' => 2,
                                    'maxView' => 2,
                                    'autoclose' => true,
                                    'format' => 'yyyy-mm-dd - HH:ii P',
                                ],
                            ])
                        ],

                        [
                            'attribute' => 'idTanaman',
                            'label' => 'Tanaman',
                            'filter' => ArrayHelper::map(Tanaman::find()->orderBy(['idTanaman' => SORT_ASC])->all(), 'labelTanaman', 'labelTanaman'),
                            'filterInputOptions' => ['class' => 'form-control', 'id' => null, 'prompt' => 'ALL'],
                            'value' => function ($data) {
                                return $data->tanaman->labelTanaman;
                            }
                        ],

                        [
                            'attribute' => 'idZonaWaktu',
                            'label' => 'Zona Waktu',
                            'filter' => ArrayHelper::map(ZonaWaktu::find()->orderBy(['idZonaWaktu' => SORT_ASC])->all(), 'namaZonaWaktu', 'namaZonaWaktu'),
                            'filterInputOptions' => ['class' => 'form-control', 'id' => null, 'prompt' => 'ALL'],
                            'value' => function ($data) {
                                return $data->zonaWaktu->namaZonaWaktu;
                            }
                        ],

                        [
                            'attribute' => 'kondisiDaun',
                            'label' => 'Kondisi Daun',
                            'format' => 'raw',
                            'filter' => ['0' => 'Tidak Sehat', '1' => 'Sehat'],
                            'filterInputOptions' => ['class' => 'form-control', 'id' => null, 'prompt' => 'ALL'],
                            'value' => function ($model) {
                                if ($model->kondisiDaun == 1) {
                                    return '<b class="text-success">Sehat</b>';
                                } else if ($model->kondisiDaun == 0) {
                                    return '<b class="text-danger">Tidak Sehat</b>';
                                } else {
                                    return '<b class="text-warning"> - </b>';
                                }
                            }
                        ],

                        //['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>
            </div>

            <!-- Tabel Data Testing -->

            <div class="col-md-6">
                <h3>Tabel Data Testing</h3>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'tableOptions' => ['class' => 'table table-stripped table-condensed table-bordered'],
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        [
                            'attribute' => 'waktuPencatatan',
                            'label' => 'Waktu Pencacatan',
                            'format' => 'raw',
                            'headerOptions' => ['style' => 'color:#3c8dbc'],
                            'value' => function ($model, $key, $index) {
                                if ($model->waktuPencatatan == NULL) {
                                    return '-';
                                } else {
                                    return date('d M Y H:i', strtotime($model->waktuPencatatan));
                                }
                            },
                            'filter' => DateTimePicker::widget([
                                'model' => $searchModel,
                                'attribute' => 'waktuPencatatan',
                                'template' => '{input}{reset}{button}',
                                'clientOptions' => [
                                    'startView' => 2,
                                    'minView' => 2,
                                    'maxView' => 2,
                                    'autoclose' => true,
                                    'format' => 'yyyy-mm-dd - HH:ii P',
                                ],
                            ])
                        ],

                        [
                            'attribute' => 'idTanaman',
                            'label' => 'Tanaman',
                            'filter' => ArrayHelper::map(Tanaman::find()->orderBy(['idTanaman' => SORT_ASC])->all(), 'labelTanaman', 'labelTanaman'),
                            'filterInputOptions' => ['class' => 'form-control', 'id' => null, 'prompt' => 'ALL'],
                            'value' => function ($data) {
                                return $data->tanaman->labelTanaman;
                            }
                        ],

                        [
                            'attribute' => 'idZonaWaktu',
                            'label' => 'Zona Waktu',
                            'filter' => ArrayHelper::map(ZonaWaktu::find()->orderBy(['idZonaWaktu' => SORT_ASC])->all(), 'namaZonaWaktu', 'namaZonaWaktu'),
                            'filterInputOptions' => ['class' => 'form-control', 'id' => null, 'prompt' => 'ALL'],
                            'value' => function ($data) {
                                return $data->zonaWaktu->namaZonaWaktu;
                            }
                        ],

                        [
                            'attribute' => 'kondisiDaun',
                            'label' => 'Kondisi Daun',
                            'format' => 'raw',
                            'filter' => ['0' => 'Tidak Sehat', '1' => 'Sehat'],
                            'filterInputOptions' => ['class' => 'form-control', 'id' => null, 'prompt' => 'ALL'],
                            'value' => function ($model) {
                                if ($model->kondisiDaun == 1) {
                                    return '<b class="text-success">Sehat</b>';
                                } else if ($model->kondisiDaun == 0) {
                                    return '<b class="text-danger">Tidak Sehat</b>';
                                } else {
                                    return '<b class="text-warning"> - </b>';
                                }
                            }
                        ],

                        //['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>
            </div>
        </div>

        <center><button class="btn-lg btn-success">KLASIFIKASI DATA</button></center>
        <hr>
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
                <div class="row">
                </div>
            </div>
        </div>
    </div>
</div>