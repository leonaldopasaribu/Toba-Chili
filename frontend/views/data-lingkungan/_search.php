<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\search\DataLingkunganSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="data-lingkungan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idDataLingkungan') ?>

    <?= $form->field($model, 'idKondisiDaun') ?>

    <?= $form->field($model, 'waktuPencatatan') ?>

    <?= $form->field($model, 'pH') ?>

    <?= $form->field($model, 'kelembabanTanah') ?>

    <?php // echo $form->field($model, 'kelembabanUdara') ?>

    <?php // echo $form->field($model, 'suhu') ?>

    <?php // echo $form->field($model, 'deleted') ?>

    <?php // echo $form->field($model, 'deleted_at') ?>

    <?php // echo $form->field($model, 'deleted_by') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
