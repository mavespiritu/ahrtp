<?php

namespace app\controllers;

use app\models\EmployeeInterventionYear;
use app\models\EmployeeInterventionYearSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

class AttendeeController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $searchModel = new EmployeeInterventionYearSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

}
