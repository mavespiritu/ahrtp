<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\Intervention;
/* @var $this yii\web\View */
/* @var $searchModel app\models\InterventionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Interventions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="intervention-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Intervention', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'header' => 'Competency',
                'attribute' => 'competency.competency',
            ],
            'intervention_title',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Intervention $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'intervention_id' => $model->intervention_id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
