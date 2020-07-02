<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Tanaman */

$this->title = 'Update Tanaman: ' . $model->tanaman_id;
$this->params['breadcrumbs'][] = ['label' => 'Tanamen', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->tanaman_id, 'url' => ['view', 'id' => $model->tanaman_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tanaman-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
