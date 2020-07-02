<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\DataLingkungan */

$this->title = 'Update Data Lingkungan: ' . $model->idDataLingkungan;
$this->params['breadcrumbs'][] = ['label' => 'Data Lingkungans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idDataLingkungan, 'url' => ['view', 'id' => $model->idDataLingkungan]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="data-lingkungan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
