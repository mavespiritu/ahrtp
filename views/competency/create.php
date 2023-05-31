<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Competency */

$this->title = 'Create Competency';
$this->params['breadcrumbs'][] = ['label' => 'Competencies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="competency-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'competencyTypes' => $competencyTypes,
    ]) ?>

</div>
