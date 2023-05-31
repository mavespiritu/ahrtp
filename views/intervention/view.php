<?php

use yii\helpers\Html;
use yii\helpers\Url;
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

    <div class="float-right"><?= Html::a('Add Year', ['add-year', 'intervention_id' => $model->intervention_id], ['class' => 'btn btn-success']) ?></div>
    <br>
    <br>
    <table class="table table-condensed table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>Year</th>
                <th>Priority</th>
                <th>Members</th>
                <th style="width: 30%;">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            <?php if($model->annualPriorityInterventions){ ?>
                <?php foreach($model->getAnnualPriorityInterventions()->orderBy(['year' => SORT_DESC])->all() as $priority){ ?>
                    <tr>
                        <th rowspan="<?= count($priority->employees) + 1 ?>"><?= $priority->year ?></th>
                        <th rowspan="<?= count($priority->employees) + 1 ?>"><?= $priority->priority == 1 ? 'Yes' : 'No' ?></th>
                        <td><?= Html::a('Add Member', ['add-member', 'intervention_id' => $model->intervention_id, 'year' => $priority->year], ['class' => 'btn btn-sm btn-block btn-success']) ?></td>
                        <td><?= Html::a('Remove Year', ['remove-year', 'intervention_id' => $model->intervention_id, 'year' => $priority->year], [
                                'class' => 'btn btn-danger btn-sm btn-block',
                                'data' => [
                                    'confirm' => 'Are you sure you want to remove this member?',
                                    'method' => 'post',
                                ],
                            ]) ?></td>
                    </tr>
                    <?php if($priority->employees){ ?>
                        <?php foreach($priority->employees as $employee){ ?>
                        <tr>
                            <td><?= $employee->fullName ?></td>
                            <td><?= Html::a('Remove Member', ['remove-member', 'intervention_id' => $model->intervention_id, 'year' => $priority->year, 'emp_id' => $employee->emp_id], [
                                'class' => 'btn btn-danger btn-sm btn-block',
                                'data' => [
                                    'confirm' => 'Are you sure you want to remove this member?',
                                    'method' => 'post',
                                ],
                            ]) ?></td>
                        </tr>
                        <?php } ?>
                    <?php } ?>
                <?php } ?>
            <?php }else{ ?>
                <td colspan=4>No year added.</td>
            <?php } ?>
        </tbody>
    </table>
</div>
