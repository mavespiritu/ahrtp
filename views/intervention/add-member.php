<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Intervention */

$this->title = $model->intervention_title;
$this->params['breadcrumbs'][] = ['label' => 'Interventions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="intervention-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'intervention_id' => $model->intervention_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'intervention_id' => $model->intervention_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'competency.competency',
        ],
    ]) ?>

    <div class="float-right"><?= Html::a('View Members', ['view', 'intervention_id' => $model->intervention_id], ['class' => 'btn btn-success']) ?></div>
    <br>
    <br>
    <div class="card">
    	<div class="card-body">
            <h3>Year: <?= $year ?></h3>
	    	<?= $this->render('_add-member', [
	            'model' => $model,
                'memberModel' => $memberModel,
                'employees' => $employees,
	        ]); ?>
    	</div>
    </div>
</div>
