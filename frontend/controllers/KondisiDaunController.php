<?php

namespace frontend\controllers;

use Yii;
use frontend\models\KondisiDaun;
use frontend\models\Tanaman;
use frontend\models\search\KondisiDaunSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * KondisiDaunController implements the CRUD actions for KondisiDaun model.
 */
class KondisiDaunController extends Controller
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
     * Lists all KondisiDaun models.
     * @return mixed
     */
    public function actionIndex($idTanaman)
    {
        $tanaman = Tanaman::find()->where(['idTanaman' => $idTanaman])->one();
        $searchModel = new KondisiDaunSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['kondisidaun.idTanaman' => $idTanaman])->all();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'tanaman' => $tanaman,
        ]);
    }

    /**
     * Displays a single KondisiDaun model.
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
     * Creates a new KondisiDaun model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new KondisiDaun();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idKondisi]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing KondisiDaun model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'idTanaman' => $model->idTanaman]);
        }

        return $this->renderAjax('_formUpdate', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing KondisiDaun model.
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
                    $modelKondisiDaun = new \frontend\models\KondisiDaun();

                    $modelKondisiDaun->idTanaman = (string) $sheetData[$baseRow]['C'];
                    $modelKondisiDaun->idZonaWaktu = (string) $sheetData[$baseRow]['E'];
                    $modelKondisiDaun->kondisiDaun = (string) $sheetData[$baseRow]['J'];
                    $modelKondisiDaun->waktuPencatatan = (string) $sheetData[$baseRow]['N'];

                    if (!$modelKondisiDaun->save()) {
                        \Yii::$app->getSession()->setFlash('danger', 'Import Data Kondisi Daun Gagal Disimpan.');
                        echo "</pre>";
                        print_r($modelKondisiDaun->errors);
                        die();
                        return $this->redirect(['import']);
                        
                    }
                    $baseRow++;
                }
                \Yii::$app->getSession()->setFlash('success', 'Data Kondisi Daun Berhasil Disimpan.');    
                return $this->redirect(['/tanaman/index']);
            } else {
                \Yii::$app->getSession()->setFlash('danger', 'Import Data Kondisi Daun Gagal Disimpan.');
                return $this->redirect(['import']);
            }
        }

        return $this->render('import', [
            'modelImport' => $modelImport,
        ]);
    }

    /**
     * Finds the KondisiDaun model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return KondisiDaun the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = KondisiDaun::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
