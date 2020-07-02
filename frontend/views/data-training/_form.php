<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\DataTraining */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="data-training-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idTanaman')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idZonaWaktu')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phMin')->textInput() ?>

    <?= $form->field($model, 'phMax')->textInput() ?>

    <?= $form->field($model, 'suhuMin')->textInput() ?>

    <?= $form->field($model, 'suhuMax')->textInput() ?>

    <?= $form->field($model, 'kelembabanUdaraMin')->textInput() ?>

    <?= $form->field($model, 'kelembabanUdaraMax')->textInput() ?>

    <?= $form->field($model, 'kelembabanTanahMin')->textInput() ?>

    <?= $form->field($model, 'kelembabanTanahMax')->textInput() ?>

    <?= $form->field($model, 'kondisiDaun')->textInput() ?>

    <?= $form->field($model, 'deleted')->textInput() ?>

    <?= $form->field($model, 'deleted_at')->textInput() ?>

    <?= $form->field($model, 'deleted_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
