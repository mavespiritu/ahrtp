<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Intervention */

$this->title = 'Update Intervention: ' . $model->intervention_id;
$this->params['breadcrumbs'][] = ['label' => 'Interventions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->intervention_id, 'url' => ['view', 'intervention_id' => $model->intervention_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="intervention-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'competencies' => $competencies,
    ]) ?>

</div>
