<?php

namespace frontend\controllers;

use Yii;
use frontend\models\DataTesting;
use frontend\models\search\DataTestingSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DataTestingController implements the CRUD actions for DataTesting model.
 */
class DataTestingController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all DataTesting models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DataTestingSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DataTesting model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new DataTesting model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DataTesting();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idTesting]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing DataTesting model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idTesting]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing DataTesting model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionImport()
    {
        ini_set('max_execution_time', 4000);
        $modelImport = new \yii\base\DynamicModel([
            'fileImport' => 'File Import',
        ]);
        $modelImport->addRule(['fileImport'], 'required');
        $modelImport->addRule(['fileImport'], 'file', ['extensions' => 'ods,xls,xlsx'], ['maxSize' => 1024 * 1024]);

        if (Yii::$app->request->post()) {
            $modelImport->fileImport = \yii\web\UploadedFile::getInstance($modelImport, 'fileImport');
            if ($modelImport->fileImport && $modelImport->validate()) {
                $inputFileType = \PHPExcel_IOFactory::identify($modelImport->fileImport->tempName);
                $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($modelImport->fileImport->tempName);
                $sheetData = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
                $baseRow = 2;
                while (!empty($sheetData[$baseRow]['A'])) {
                    $model = new \frontend\models\DataTraining();

                    $model->suhu_min = (string) $sheetData[$baseRow]['A'];
                    $model->kelembabanUdara_maximum = (string) $sheetData[$baseRow]['B'];
                    $model->kelembabanUdara_minimum = (string) $sheetData[$baseRow]['C'];
                    $model->kelembabanUdara_avg = (string) $sheetData[$baseRow]['D'];
                    $model->kondisi_actual = (string) $sheetData[$baseRow]['E'];
                    if (!$model->save()) {
                        \Yii::$app->getSession()->setFlash('danger', 'Import Data Testing Gagal Disimpan.');
                        return $this->redirect(['import']);
                        print_r($model->errors);
                        die();
                    }

                    $baseRow++;
                }
                \Yii::$app->getSession()->setFlash('success', 'Data Testing Berhasil Disimpan.');            
                return $this->redirect(['index']);
            } else {
                \Yii::$app->getSession()->setFlash('danger', 'Import Data Testing Gagal Disimpan.');
                return $this->redirect(['import']);
            }
        }

        return $this->renderAjax('import', [
            'modelImport' => $modelImport,
        ]);
    }

    /**
     * Finds the DataTesting model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return DataTesting the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DataTesting::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
