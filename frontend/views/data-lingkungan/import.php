<?php 
	use yii\widgets\ActiveForm;
	use yii\helpers\Html;

$this->title = 'Import Excel';
$this->params['breadcrumbs'][] = ['label' => 'Daftar Tanaman', 'url' => ['/tanaman/index']];
$this->params['breadcrumbs'][] = 'Import Excel';
?>

<h1> Import Excel Data Lingkungan</h1>

<?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]);?>
 
<?= $form->field($modelImport,'fileImport')->fileInput(['class' => 'btn btn-info']) ?>
 
 <div class="form-group">
	<?= Html::submitButton('Import <i class="fa fa-upload"></i>',['class'=>'btn btn-success']);?>
 </div>
<?php ActiveForm::end();?>
