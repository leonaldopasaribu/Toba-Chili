<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\ZonaWaktu */

$this->title = 'Update Zona Waktu: ' . $model->idZonaWaktu;
$this->params['breadcrumbs'][] = ['label' => 'Zona Waktus', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idZonaWaktu, 'url' => ['view', 'id' => $model->idZonaWaktu]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="zona-waktu-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
