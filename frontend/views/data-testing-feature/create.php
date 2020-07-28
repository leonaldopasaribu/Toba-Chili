<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\DataTestingFeature */

$this->title = 'Create Data Testing Feature';
$this->params['breadcrumbs'][] = ['label' => 'Data Testing Features', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-testing-feature-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
