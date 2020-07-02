<?php

use frontend\models\KondisiDaun;
use yii\helpers\Html;
use yii\Grid\GridView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Tanaman */

// $this->title = $model->tanaman_id;
$this->params['breadcrumbs'][] = ['label' => 'Tanamen', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tanaman-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <!-- <?= Html::a('Update', ['update', 'id' => $model->idTanaman], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idTanaman], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?> -->
    </p>

    <table>
        <tbody>
            <?php $counter = 0; ?>
            <?php
            $hasilPemantauan = KondisiDaun::find()->where(['idTanaman' => $id])->all();

            foreach ($hasilPemantauan as $data) { ?>

                <tr>
                <?php $counter++;?> 
                    <th>Hasil Pemantauan <?php echo $counter; ?></th>
                    <td><?= $data->kondisiDaun; ?></td>
                    <td><?= $data->kondisiDaun; ?></td>
                </tr>

            <?php } ?>

        </tbody>
    </table>                            

</div>