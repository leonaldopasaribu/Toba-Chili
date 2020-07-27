<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use frontend\models\DataLingkungan;
use frontend\models\DataTesting;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\search\TanamanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daftar Tanaman';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-primary">
    <div class="tanaman-index">
        <div class="content">
            <div class="row">
                <div class="col-lg-6 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-blue">
                        <div class="inner">
                            <h2><b>Jumlah Data</b></h2>
                            <h1><i> <?php echo number_format($totalTanaman)  ?> Data</i> </h1>
                            <br>
                        </div>
                        <div class="icon">
                            <i class="fa fa-leaf"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-blue">
                        <div class="inner">
                            <h2><b>Import Data</b></h2><br>
                            <br>
                            <?= Html::a('<i class="fa fa-upload"></i> Import Kondisi Daun', ['/kondisi-daun/import'], ['class' => 'btn btn-success']) ?>
                            <?= Html::a('<i class="fa fa-upload"></i> Import Data Lingkungan', ['/data-lingkungan/import'], ['class' => 'btn btn-success']) ?>
                        </div>
                        <div class="icon">
                            <i class="fa fa-leaf"></i>
                        </div>
                        <!-- <a href="<?= Url::to(['/kondisi-daun/index']) ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
                    </div>
                </div>
                <div class="row">
                </div>
                <div class="content">
                    <div class="row">

                        <?php
                        $i = 0;
                        foreach ($tanamanCount as $row) {
                            $noTanaman = $row->idTanaman;
                            $i++;

                            $kondisiCount = DataLingkungan::find()->joinWith(['kondisiDaun'])->andWhere(['idTanaman' => $row->idTanaman])->count();
                        ?>

                            <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box bg-aqua">
                                    <div class="inner">
<?php
                                    $countSehat = DataTesting::find()->count();?>
                                        <h2><b><?php echo $row->labelTanaman; ?></b></h2>
                                        <h2><i><?php echo number_format($kondisiCount) ?> Data</i></h2>
                                        <br>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-leaf"></i>
                                    </div>
                                    <a href="<?= Url::to(['/kondisi-daun/index', 'idTanaman' => $row->idTanaman]) ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>

                        <?php
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>