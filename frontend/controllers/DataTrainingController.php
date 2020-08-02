<?php

namespace frontend\controllers;

use Exception;
use Yii;
use frontend\models\DataTraining;
use frontend\models\DataTesting;
use frontend\models\search\DataTrainingSearch;
use frontend\models\search\DataTestingSearch;
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
        $searchModel = new DataTrainingSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $searchModel2 = new DataTestingSearch();
        $dataProvider2 = $searchModel2->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'searchModel2' => $searchModel2,
            'dataProvider2' => $dataProvider2,
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

    public function actionTesting()
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
                    $model = new \frontend\models\DataTesting();

                    $model->ph_maximum = (string) $sheetData[$baseRow]['A'];
                    $model->ph_minimum = (string) $sheetData[$baseRow]['B'];
                    $model->ph_avg = (string) $sheetData[$baseRow]['C'];
                    $model->kelembabanTanah_maximum = (string) $sheetData[$baseRow]['D'];
                    $model->kelembabanTanah_minimum = (string) $sheetData[$baseRow]['E'];
                    $model->kelembabanTanah_avg = (string) $sheetData[$baseRow]['F'];
                    $model->suhu_max = (string) $sheetData[$baseRow]['G'];
                    $model->suhu_min = (string) $sheetData[$baseRow]['H'];
                    $model->suhu_avg = (string) $sheetData[$baseRow]['I'];
                    $model->kelembabanUdara_maximum = (string) $sheetData[$baseRow]['J'];
                    $model->kelembabanUdara_minimum = (string) $sheetData[$baseRow]['K'];
                    $model->kelembabanUdara_avg = (string) $sheetData[$baseRow]['L'];
                    $model->kondisi_actual = (string) $sheetData[$baseRow]['M'];
                    if (!$model->save()) {
                        \Yii::$app->getSession()->setFlash('danger', 'Import Data Testing Gagal Disimpan.');
                        return $this->redirect(['testing']);
                        print_r($model->errors);
                        die();
                    }

                    $baseRow++;
                }
                \Yii::$app->getSession()->setFlash('success', 'Data Testing Berhasil Disimpan.');
                return $this->redirect(['index']);
            } else {
                \Yii::$app->getSession()->setFlash('danger', 'Import Data Testing Gagal Disimpan.');
                return $this->redirect(['testing']);
            }
        }

        return $this->renderAjax('testing', [
            'modelImport' => $modelImport,
        ]);
    }

    public function actionTraining()
    {
        ini_set('max_execution_time', 5000);
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

                    $model->ph_maximum = (string) $sheetData[$baseRow]['A'];
                    $model->ph_minimum = (string) $sheetData[$baseRow]['B'];
                    $model->ph_avg = (string) $sheetData[$baseRow]['C'];
                    $model->kelembabanTanah_maximum = (string) $sheetData[$baseRow]['D'];
                    $model->kelembabanTanah_minimum = (string) $sheetData[$baseRow]['E'];
                    $model->kelembabanTanah_avg = (string) $sheetData[$baseRow]['F'];
                    $model->suhu_max = (string) $sheetData[$baseRow]['G'];
                    $model->suhu_min = (string) $sheetData[$baseRow]['H'];
                    $model->suhu_avg = (string) $sheetData[$baseRow]['I'];
                    $model->kelembabanUdara_maximum = (string) $sheetData[$baseRow]['J'];
                    $model->kelembabanUdara_minimum = (string) $sheetData[$baseRow]['K'];
                    $model->kelembabanUdara_avg = (string) $sheetData[$baseRow]['L'];
                    $model->kondisi_actual = (string) $sheetData[$baseRow]['M'];
                    if (!$model->save()) {
                        \Yii::$app->getSession()->setFlash('danger', 'Import Data Training Gagal Disimpan.');
                        return $this->redirect(['training']);
                        print_r($model->errors);
                        die();
                    }

                    $baseRow++;
                }
                \Yii::$app->getSession()->setFlash('success', 'Data Training Berhasil Disimpan.');
                return $this->redirect(['index']);
            } else {
                \Yii::$app->getSession()->setFlash('danger', 'Import Data Training Gagal Disimpan.');
                return $this->redirect(['training']);
            }
        }

        return $this->renderAjax('training', [
            'modelImport' => $modelImport,
        ]);
    }

    public function actionKlasifikasi()
    {
        function classify($X, $n, $table, $id_data)
        {
            $class = array(); //different classes 
            $allclass = array(); //total individual classes
            $temp = array();


            //Finding differentclass attributes
            //$result = $mysqli->query("select distinct(" . $n . ") from " . $table);
            $result = Yii::$app->db->createCommand("select distinct(" . $n . ") from " . $table)->queryAll();
            foreach($result as $j){
                $temp[] = $j;
            }
            foreach ($temp as $t)
                $class[] = $t[$n];

            //Finding total number of training classes
            //$nc = $mysqli->query("select count(" . $n . ") as num from " . $table);
            $nc = Yii::$app->db->createCommand("select count(" . $n . ") as num from " . $table)->queryAll();
            foreach($nc as $p){
                $C = $p["num"];
            }
            //$p = mysqli_fetch_array($nc, MYSQLI_ASSOC);
            
            //Finding total number of individual classes
            foreach ($class as $c) {
                //$nc = $mysqli->query("select count(*) as num from " . $table . " where " . $n . "= '" . $c . "'");
                $nc = Yii::$app->db->createCommand("select count(*) as num from " . $table . " where " . $n . "= '" . $c . "'")->queryAll();
                //$m = mysqli_fetch_array($nc, MYSQLI_ASSOC);
                foreach($nc as $m){
                    $allclass[$c] = $m["num"];
                }
            }


            //Finding Prob of each class
            foreach ($allclass as $c => $p) {
                $Pc[$c] = round($p / $C, 4);
                $argmax[$c] = 1;
            }


            // var_dump($allclass);
            foreach ($allclass as $c => $p) {
                foreach ($X as $x => $y) {
                    //$i = $mysqli->query("select count(*) as num from " . $table . " where " . $n . "='" . $c . "' AND " . $x . "='" . $y . "'");
                    $i = Yii::$app->db->createCommand("select count(*) as num from " . $table . " where " . $n . "='" . $c . "' AND " . $x . "='" . $y . "'")->queryAll();
                    //$j = mysqli_fetch_array($i, MYSQLI_ASSOC);
                    foreach($i as $j){
                        $P[$c][$x] = round($j["num"] / $allclass[$c], 2);
                    }
                    

                    //Exception: P(data/class) might be 0 in some cases, ignore 0 for now
                    if ($P[$c][$x] != 0)
                        $argmax[$c] *= $P[$c][$x];
                }
                $argmax[$c] *= $Pc[$c];
            }

            $result = array_keys($argmax, max($argmax));
            //print_r($result[0]);

            //$updateQuery = "UPDATE data_testf SET kondisi_predict = '$result[0]' WHERE id = '$id_data'";
            $updateQuery = Yii::$app->db->createCommand("UPDATE data_testing SET kondisi_predict = '$result[0]' WHERE idTesting = '$id_data'");

            try {
                $updateQuery->execute();
                print_r("Sukses");
            } catch (Exception $e) {
                var_dump($e->getMessage());
            }
        }
        //Test case
        $result = Yii::$app->db->createCommand('select * from data_testing')->queryAll();

        foreach ($result as $row) {

            //Classification factor
            $n = 'kondisi_actual';
            //table name
            $table = 'data_training';
            $X = array(
                'ph_maximum' => $row['ph_maximum'],
                'ph_minimum' => $row['ph_minimum'],
                'ph_avg' => $row['ph_avg'],
                'kelembabanTanah_maximum' => $row['kelembabanTanah_maximum'],
                'kelembabanTanah_minimum' => $row['kelembabanTanah_minimum'],
                'kelembabanTanah_avg' => $row['kelembabanTanah_avg'],
                'suhu_max' => $row['suhu_max'],
                'suhu_min' => $row['suhu_min'],
                'suhu_avg' => $row['suhu_avg'],
                'kelembabanUdara_minimum' => $row['kelembabanUdara_minimum'],
                'kelembabanUdara_maximum' => $row['kelembabanUdara_maximum'],
                'kelembabanUdara_avg' => $row['kelembabanUdara_avg']
            );
            classify($X, $n, $table, $row['idTesting']);
        }
        return $this->redirect(['predict']);
    }

    public function actionPredict()
    {
        $searchModel = new DataTestingSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $countSehat = DataTesting::find()->count();
        $countTidakSehat = DataTesting::find()->count();

        return $this->render('predict', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            '$countSehat' => $countSehat,
            '$countTidakSehat' => $countTidakSehat,
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
