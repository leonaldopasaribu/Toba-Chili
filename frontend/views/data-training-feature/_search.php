<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\search\DataTrainingFeatureSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="data-training-feature-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idTraining') ?>

    <?= $form->field($model, 'suhu_min') ?>

    <?= $form->field($model, 'kelembabanUdara_maximum') ?>

    <?= $form->field($model, 'kelembabanUdara_minimum') ?>

    <?= $form->field($model, 'kelembabanUdara_avg') ?>

    <?php // echo $form->field($model, 'kondisi_actual') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
