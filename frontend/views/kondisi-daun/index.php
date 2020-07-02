<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use dosamigos\datetimepicker\DateTimePicker;
use frontend\models\ZonaWaktu;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\search\KondisiDaunSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kondisi Daun';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-primary" style="padding:10px 10px 10px 10px">
    <h1><i class="fa fa-leaf"></i> <?php echo $tanaman->labelTanaman; ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

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
                        'format' => 'yyyy-mm-dd',
                    ],
                ])
            ],

            [
                'attribute' => 'namaZona',
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
                'filter' => ['0' => 'Tidak Sehat', '1' => 'Sehat', '2' => 'Belum Didefenisi'],
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

            [
                'attribute' => 'Edit Kondisi Daun',
                'format' => 'raw',
                'value' => function ($model) {
                    if ($model->kondisiDaun == 2) {
                        return Html::button('Edit Kondisi <i class="fa fa-fw fa-pencil"></i>', ['value' => Url::to(['kondisi-daun/update', 'id' => $model->idKondisi]), 'title' => 'Tentukan Kondisi Daun', 'class' => 'showModalButton btn btn-success']);
                    } else {
                        return "-";
                    }
                }

            ],

            [
                'attribute' => 'Aksi',
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::a('Lihat Detail <i class="fa fa-fw fa-eye"></i>', ['/data-lingkungan', 'idTanaman' => $model->idTanaman], ['class' => 'btn btn-info']);
                }

            ],

            // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>