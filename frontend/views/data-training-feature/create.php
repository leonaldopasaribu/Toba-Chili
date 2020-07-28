<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\DataTrainingFeature */

$this->title = 'Create Data Training Feature';
$this->params['breadcrumbs'][] = ['label' => 'Data Training Features', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-training-feature-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
