<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\DataLingkungan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="data-lingkungan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idKondisi')->textInput() ?>

    <?= $form->field($model, 'waktuPencatatan')->textInput() ?>

    <?= $form->field($model, 'pH')->textInput() ?>

    <?= $form->field($model, 'kelembabanTanah')->textInput() ?>

    <?= $form->field($model, 'kelembabanUdara')->textInput() ?>

    <?= $form->field($model, 'suhu')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
