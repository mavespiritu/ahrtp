<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model app\models\Intervention */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="intervention-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($annualModel, 'year')->textInput(['maxlength' => true, 'type' => 'number']) ?>

    <?= $form->field($annualModel, 'priority')->widget(Select2::classname(), [
        'data' => [1 => 'Yes', 0 => 'No'],
        'options' => ['placeholder' => 'Select One'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
