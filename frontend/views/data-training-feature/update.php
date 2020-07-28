<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\DataTrainingFeature */

$this->title = 'Update Data Training Feature: ' . $model->idTraining;
$this->params['breadcrumbs'][] = ['label' => 'Data Training Features', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idTraining, 'url' => ['view', 'id' => $model->idTraining]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="data-training-feature-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
