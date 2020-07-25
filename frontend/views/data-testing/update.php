<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\DataTesting */

$this->title = 'Update Data Testing: ' . $model->idTesting;
$this->params['breadcrumbs'][] = ['label' => 'Data Testings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idTesting, 'url' => ['view', 'id' => $model->idTesting]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="data-testing-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
