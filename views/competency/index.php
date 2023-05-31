<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\Competency;
/* @var $this yii\web\View */
/* @var $searchModel app\models\CompetencySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Competencies';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="competency-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Competency', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'competency',
            [
                'header' => 'Competency Type',
                'attribute' => 'competencyType.competency_type_description',
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Competency $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'comp_id' => $model->comp_id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
