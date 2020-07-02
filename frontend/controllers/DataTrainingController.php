<?php

namespace frontend\controllers;

use Yii;
use frontend\models\DataTraining;
use frontend\models\search\DataTrainingSearch;
use frontend\models\search\KondisiDaunSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DataTrainingController implements the CRUD actions for DataTraining model.
 */
class DataTrainingController extends Controller
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
     * Lists all DataTraining models.
     * @return mixed
     */
    public function actionIndex()
    {
        //$searchModel = new KondisiDaunSearch();
        $searchModel = new DataTrainingSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DataTraining model.
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
     * Creates a new DataTraining model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DataTraining();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idTraining]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing DataTraining model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idTraining]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing DataTraining model.
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
        $searchModel = new DataTrainingSearch();
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

                    $model->waktuPencatatan = (string) $sheetData[$baseRow]['B'];
                    $model->idTanaman = (string) $sheetData[$baseRow]['C'];
                    $model->idZonaWaktu = (string) $sheetData[$baseRow]['D'];
                    $model->phMin = (string) $sheetData[$baseRow]['E'];
                    $model->phMax = (string) $sheetData[$baseRow]['F'];
                    $model->suhuMin = (string) $sheetData[$baseRow]['G'];
                    $model->suhuMax = (string) $sheetData[$baseRow]['H'];
                    $model->suhuRata = (string) $sheetData[$baseRow]['I'];
                    $model->kelembabanUdaraMin = (string) $sheetData[$baseRow]['J'];
                    $model->kelembabanUdaraMax = (string) $sheetData[$baseRow]['K'];
                    $model->kelembabanUdaraRata = (string) $sheetData[$baseRow]['L'];
                    $model->kelembabanTanahMin = (string) $sheetData[$baseRow]['M'];
                    $model->kelembabanTanahMax = (string) $sheetData[$baseRow]['N'];
                    $model->kelembabanTanahRata = (string) $sheetData[$baseRow]['O'];
                    $model->kondisiDaun = (string) $sheetData[$baseRow]['P'];
                    if (!$model->save()) {
                        \Yii::$app->getSession()->setFlash('danger', 'Import Data Training Gagal Disimpan.');
                        return $this->redirect(['import']);
                        print_r($model->errors);
                        die();
                    }

                    $baseRow++;
                }
                \Yii::$app->getSession()->setFlash('success', 'Data Training Berhasil Disimpan.');            
                return $this->redirect(['index']);
            } else {
                \Yii::$app->getSession()->setFlash('danger', 'Import Data Training Gagal Disimpan.');
                return $this->redirect(['import']);
            }
        }

        return $this->renderAjax('import', [
            'modelImport' => $modelImport,
        ]);
    }

    /**
     * Finds the DataTraining model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return DataTraining the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DataTraining::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
