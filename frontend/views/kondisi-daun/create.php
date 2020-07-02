<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\KondisiDaun */

$this->title = 'Create Kondisi Daun';
$this->params['breadcrumbs'][] = ['label' => 'Kondisi Dauns', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kondisi-daun-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
