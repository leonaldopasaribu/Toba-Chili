<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\KondisiDaun */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kondisi-daun-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kondisiDaun')->dropDownList(['1' => 'Sehat', '0' => 'Tidak Sehat'],['prompt'=>'--Pilih Kondisi--']);?>

    <div class="form-group">
        <?= Html::submitButton('Simpan Perubahan', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
