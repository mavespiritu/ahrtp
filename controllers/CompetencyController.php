<?php

namespace app\controllers;

use app\models\Competency;
use app\models\CompetencyType;
use app\models\CompetencySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * CompetencyController implements the CRUD actions for Competency model.
 */
class CompetencyController extends Controller
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
     * Lists all Competency models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new CompetencySearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Competency model.
     * @param string $comp_id Comp ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($comp_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($comp_id),
        ]);
    }

    /**
     * Creates a new Competency model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Competency();

        $competencyTypes = CompetencyType::find()->all();
        $competencyTypes = ArrayHelper::map($competencyTypes, 'comp_type', 'competency_type_description');

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['index']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'competencyTypes' => $competencyTypes,
        ]);
    }

    /**
     * Updates an existing Competency model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $comp_id Comp ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($comp_id)
    {
        $model = $this->findModel($comp_id);

        $competencyTypes = CompetencyType::find()->all();
        $competencyTypes = ArrayHelper::map($competencyTypes, 'comp_type', 'competency_type_description');

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
            'competencyTypes' => $competencyTypes,
        ]);
    }

    /**
     * Deletes an existing Competency model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $comp_id Comp ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($comp_id)
    {
        $this->findModel($comp_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Competency model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $comp_id Comp ID
     * @return Competency the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($comp_id)
    {
        if (($model = Competency::findOne(['comp_id' => $comp_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
