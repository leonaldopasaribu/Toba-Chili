<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\search\DataTestingFeatureSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="data-testing-feature-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idTesting') ?>

    <?= $form->field($model, 'suhu_min') ?>

    <?= $form->field($model, 'kelembabanUdara_maximum') ?>

    <?= $form->field($model, 'kelembabanUdara_minimum') ?>

    <?= $form->field($model, 'kelembabanUdara_avg') ?>

    <?php // echo $form->field($model, 'kondisi_actual') ?>

    <?php // echo $form->field($model, 'kondisi_predict') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
