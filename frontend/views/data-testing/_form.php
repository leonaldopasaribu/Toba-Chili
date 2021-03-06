<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\DataTesting */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="data-testing-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'suhu_min')->textInput() ?>

    <?= $form->field($model, 'kelembabanUdara_maximum')->textInput() ?>

    <?= $form->field($model, 'kelembabanUdara_minimum')->textInput() ?>

    <?= $form->field($model, 'kelembabanUdara_avg')->textInput() ?>

    <?= $form->field($model, 'kondisi_actual')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kondisi_predict')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
