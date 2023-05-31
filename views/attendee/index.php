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

$this->title = 'Attendees';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attendee-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'competencyName',
            'interventionName',
            'year',
            'employeeName',
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
