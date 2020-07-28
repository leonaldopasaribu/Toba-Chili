<?php 
	use yii\widgets\ActiveForm;
	use yii\helpers\Html;

$this->title = '';
$this->params['breadcrumbs'][] = ['label' => 'List Alat', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Import File';
?>

<h1><?= Html::encode($this->title) ?></h1>

<?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]);?>
 
<?= $form->field($modelImport,'fileImport')->fileInput() ?>
 
 <div class="form-group">
	<?= Html::submitButton('Import',['class'=>'btn btn-success']);?>
 </div>
<?php ActiveForm::end();?>
