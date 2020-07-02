<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Tanaman */

$this->title = 'Create Tanaman';
$this->params['breadcrumbs'][] = ['label' => 'Tanamen', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tanaman-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
