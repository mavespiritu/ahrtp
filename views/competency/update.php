<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Competency */

$this->title = 'Update Competency: ' . $model->comp_id;
$this->params['breadcrumbs'][] = ['label' => 'Competencies', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->comp_id, 'url' => ['view', 'comp_id' => $model->comp_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="competency-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'competencyTypes' => $competencyTypes,
    ]) ?>

</div>
