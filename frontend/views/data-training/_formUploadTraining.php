<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\DataTraining */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="data-training-form">

    <?php $form = ActiveForm::begin([
          'action' => ['index'],
          'method' => 'get',
          'layout' => 'horizontal',
          'options' => [
            'enctype' => 'multipart/form-data',
          ],
          'fieldConfig' => [
              'template' => "{label}\n{beginWrapper}\n{input}\n{error}\n{endWrapper}\n{hint}",
              'horizontalCssClasses' => [
                 'label' => 'col-sm-3',
                 'wrapper' => 'col-sm-5',
                 'error' => '',
                 'hint' => '',
              ],
           ],
       ]) 
    ?>

    <?= $form->field($modelImport,'fileImport')->fileInput() ?>


    <div class="form-group">
    <div class="col-md-1 col-md-offset-3">
            <?= Html::submitButton('Import Data', ['class' => 'btn btn-success']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
