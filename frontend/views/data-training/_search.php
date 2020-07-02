<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\search\DataTrainingSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="data-training-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idTraining') ?>

    <?= $form->field($model, 'idTanaman') ?>

    <?= $form->field($model, 'idZonaWaktu') ?>

    <?= $form->field($model, 'phMin') ?>

    <?= $form->field($model, 'phMax') ?>

    <?php // echo $form->field($model, 'suhuMin') ?>

    <?php // echo $form->field($model, 'suhuMax') ?>

    <?php // echo $form->field($model, 'kelembabanUdaraMin') ?>

    <?php // echo $form->field($model, 'kelembabanUdaraMax') ?>

    <?php // echo $form->field($model, 'kelembabanTanahMin') ?>

    <?php // echo $form->field($model, 'kelembabanTanahMax') ?>

    <?php // echo $form->field($model, 'kondisiDaun') ?>

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
