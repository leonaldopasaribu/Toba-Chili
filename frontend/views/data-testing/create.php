<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\DataTesting */

$this->title = 'Create Data Testing';
$this->params['breadcrumbs'][] = ['label' => 'Data Testings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-testing-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
