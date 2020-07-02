<?php

namespace frontend\controllers;

use Yii;
use frontend\models\DataLingkungan;
use frontend\models\Tanaman;
use frontend\models\search\DataLingkunganSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DataLingkunganController implements the CRUD actions for DataLingkungan model.
 */
class DataLingkunganController extends Controller
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
     * Lists all DataLingkungan models.
     * @return mixed
     */
    public function actionIndex($idTanaman)
    {
        $searchModel = new DataLingkunganSearch();
        $tanaman = Tanaman::find()->where(['idTanaman' => $idTanaman])->one();
        $kondisi = DataLingkungan::find()->joinWith(['kondisiDaun'])->andWhere(['idTanaman' => $idTanaman])->all();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['in', 'idDataLingkungan', $kondisi])->all();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'tanaman' => $tanaman,
        ]);
    }

    /**
     * Displays a single DataLingkungan model.
     * @param integer $id
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
     * Creates a new DataLingkungan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DataLingkungan();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idDataLingkungan]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing DataLingkungan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idDataLingkungan]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing DataLingkungan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
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
        ini_set('max_execution_time', 1500);
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
                    $modelDataLingkungan = new \frontend\models\DataLingkungan();

                    $modelDataLingkungan->idKondisi = (string) $sheetData[$baseRow]['A'];
                    $modelDataLingkungan->waktuPencatatan = (string) $sheetData[$baseRow]['N'];
                    $modelDataLingkungan->pH = (string) $sheetData[$baseRow]['F'];
                    $modelDataLingkungan->suhu = (string) $sheetData[$baseRow]['G'];
                    $modelDataLingkungan->kelembabanUdara = (string) $sheetData[$baseRow]['H'];
                    $modelDataLingkungan->kelembabanTanah = (string) $sheetData[$baseRow]['I'];

                    if (!$modelDataLingkungan->save()) {
                        \Yii::$app->getSession()->setFlash('danger', 'Import Data Lingkungan Gagal Disimpan.');
                        echo "</pre>";
                        print_r($modelDataLingkungan->errors);
                        die();
                        return $this->redirect(['import']);
                    }
                    $baseRow++;
                }
                \Yii::$app->getSession()->setFlash('success', 'Data Lingkungan Berhasil Disimpan.');    
                return $this->redirect(['/tanaman/index']);
            } else {
                \Yii::$app->getSession()->setFlash('danger', 'Import Data Lingkungan Gagal Disimpan.');
                return $this->redirect(['import']);
            }
        }

        return $this->render('import', [
            'modelImport' => $modelImport,
        ]);
    }

    /**
     * Finds the DataLingkungan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DataLingkungan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DataLingkungan::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
