<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\ZonaWaktu */

$this->title = 'Create Zona Waktu';
$this->params['breadcrumbs'][] = ['label' => 'Zona Waktus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="zona-waktu-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
