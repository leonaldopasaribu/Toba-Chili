<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model frontend\models\KondisiDaun */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kondisi-daun-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idKondisi')->textInput() ?>

    <?= $form->field($model, 'idTanaman')->textInput() ?>

    <?= $form->field($model, 'idZonaWaktu')->textInput() ?>

    <?= $form->field($model, 'tanggalPencatatan')->textInput() ?>

    <?= $form->field($model, 'gambar')->textInput() ?>

    <?= $form->field($model, 'kondisiDaun')->dropDownList(['1' => 'Sehat', '0' => 'Tidak Sehat'],['prompt'=>'--Pilih Kondisi--']);?>

    <div class="form-group">
        <?= Html::submitButton('Simpan Perubahan', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
