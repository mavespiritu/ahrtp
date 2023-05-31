<?php

namespace app\controllers;

use app\models\AnnualPriorityIntervention;
use app\models\EmployeeInterventionYear;
use app\models\Competency;
use app\models\Intervention;
use app\models\Employee;
use app\models\InterventionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
/**
 * InterventionController implements the CRUD actions for Intervention model.
 */
class InterventionController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Intervention models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new InterventionSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Intervention model.
     * @param string $intervention_id Intervention ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($intervention_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($intervention_id),
        ]);
    }

    /**
     * Creates a new Intervention model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Intervention();

        $competencies = Competency::find()->all();
        $competencies = ArrayHelper::map($competencies, 'comp_id', 'competency');

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'intervention_id' => $model->intervention_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'competencies' => $competencies,
        ]);
    }

    /**
     * Updates an existing Intervention model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $intervention_id Intervention ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($intervention_id)
    {
        $model = $this->findModel($intervention_id);

        $competencies = Competency::find()->all();
        $competencies = ArrayHelper::map($competencies, 'comp_id', 'competency');

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'intervention_id' => $model->intervention_id]);
        }

        return $this->render('update', [
            'model' => $model,
            'competencies' => $competencies,
        ]);
    }

    public function actionAddYear($intervention_id)
    {
        $model = $this->findModel($intervention_id);

        $annualModel = new AnnualPriorityIntervention;
        $annualModel->intervention_id = $model->intervention_id;

        if ($this->request->isPost && $annualModel->load($this->request->post()) && $annualModel->save())
        {
            return $this->redirect(['view', 'intervention_id' => $model->intervention_id]);
        }

        return $this->render('add-year', [
            'model' => $model,
            'annualModel' => $annualModel,
        ]);
    }

    public function actionAddMember($intervention_id, $year)
    {
        $model = $this->findModel($intervention_id);

        $memberModel = new EmployeeInterventionYear;
        $memberModel->intervention_id = $model->intervention_id;
        $memberModel->year = $year;

        $existingEmployees = EmployeeInterventionYear::find()->where(['intervention_id' => $intervention_id, 'year' => $year])->all();
        $existingEmployees = ArrayHelper::map($existingEmployees, 'emp_id', 'emp_id');

        $employees = Employee::find()->select(['emp_id', 'concat(fname," ",lname) as name'])->where(['not in', 'emp_id', $existingEmployees])->asArray()->all();
        $employees = ArrayHelper::map($employees, 'emp_id', 'name');

        if ($this->request->isPost && $memberModel->load($this->request->post()) && $memberModel->save())
        {
            return $this->redirect(['view', 'intervention_id' => $model->intervention_id]);
        }

        return $this->render('add-member', [
            'model' => $model,
            'memberModel' => $memberModel,
            'employees' => $employees,
            'year' => $year,
        ]);
    }

    public function actionRemoveYear($intervention_id, $year)
    {
        $model = $this->findModel($intervention_id);

        $annualIntervention = AnnualPriorityIntervention::findOne([
            'intervention_id' => $intervention_id,
            'year' => $year,
        ]);

        if($annualIntervention->delete())
        {
            return $this->redirect(['view', 'intervention_id' => $model->intervention_id]);
        }
    }

    public function actionRemoveMember($intervention_id, $year, $emp_id)
    {
        $model = $this->findModel($intervention_id);

        $empIntervention = EmployeeInterventionYear::findOne([
            'intervention_id' => $intervention_id,
            'year' => $year,
            'emp_id' => $emp_id,
        ]);

        if($empIntervention->delete())
        {
            return $this->redirect(['view', 'intervention_id' => $model->intervention_id]);
        }
    }

    /**
     * Deletes an existing Intervention model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $intervention_id Intervention ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($intervention_id)
    {
        $this->findModel($intervention_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Intervention model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $intervention_id Intervention ID
     * @return Intervention the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($intervention_id)
    {
        if (($model = Intervention::findOne(['intervention_id' => $intervention_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
