<?php

use yii\helpers\Html;
use yii\grid\GridView;
use dosamigos\datetimepicker\DateTimePicker;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\search\DataLingkunganSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Lingkungan';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="box box-primary" style="padding:10px 10px 10px 10px">
    <h1><i class="fa fa-leaf"></i> <?php echo $tanaman->labelTanaman; ?></h1>

    <!-- <p>
        <?= Html::a('Create Data Lingkungan', ['create'], ['class' => 'btn btn-success']) ?>
    </p> -->

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
                        'format' => 'yyyy-mm-dd - HH:ii P',
                    ],
                ])
            ],

            [
                'attribute' => 'pH',
                'label' => 'pH Tanah',
                'value' => function ($data) {
                    return $data->pH;
                }
            ],

            [
                'attribute' => 'kelembabanTanah',
                'label' => 'Kelembaban Tanah',
                'value' => function ($data) {
                    return $data->kelembabanTanah . ' %';
                }
            ],

            [
                'attribute' => 'kelembabanUdara',
                'label' => 'Kelembaban Udara',
                'value' => function ($data) {
                    return $data->kelembabanUdara . ' %';
                }
            ],

            [
                'attribute' => 'suhu',
                'label' => 'Suhu',
                'value' => function ($data) {
                    return $data->suhu . ' C';
                }
            ],

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>