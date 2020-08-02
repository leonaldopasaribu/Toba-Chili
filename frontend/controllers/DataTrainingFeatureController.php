<?php

namespace frontend\controllers;

use Exception;
use Yii;
use frontend\models\DataTrainingFeature;
use frontend\models\DataTestingFeature;
use frontend\models\search\DataTrainingFeatureSearch;
use frontend\models\search\DataTestingFeatureSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DataTrainingFeatureController implements the CRUD actions for DataTrainingFeature model.
 */
class DataTrainingFeatureController extends Controller
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
     * Lists all DataTrainingFeature models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DataTrainingFeatureSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $searchModel2 = new DataTestingFeatureSearch();
        $dataProvider2 = $searchModel2->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'searchModel2' => $searchModel2,
            'dataProvider2' => $dataProvider2,
        ]);
    }

    /**
     * Displays a single DataTrainingFeature model.
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
     * Creates a new DataTrainingFeature model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DataTrainingFeature();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idTraining]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing DataTrainingFeature model.
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
     * Deletes an existing DataTrainingFeature model.
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
                    $model = new \frontend\models\DataTestingFeature();

                    $model->suhu_min = (string) $sheetData[$baseRow]['A'];
                    $model->kelembabanUdara_maximum = (string) $sheetData[$baseRow]['B'];
                    $model->kelembabanUdara_minimum = (string) $sheetData[$baseRow]['C'];
                    $model->kelembabanUdara_avg = (string) $sheetData[$baseRow]['D'];
                    $model->kondisi_actual = (string) $sheetData[$baseRow]['E'];
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
                    $model = new \frontend\models\DataTrainingFeature();

                    $model->suhu_min = (string) $sheetData[$baseRow]['A'];
                    $model->kelembabanUdara_maximum = (string) $sheetData[$baseRow]['B'];
                    $model->kelembabanUdara_minimum = (string) $sheetData[$baseRow]['C'];
                    $model->kelembabanUdara_avg = (string) $sheetData[$baseRow]['D'];
                    $model->kondisi_actual = (string) $sheetData[$baseRow]['E'];
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
            $updateQuery = Yii::$app->db->createCommand("UPDATE data_testing_feature SET kondisi_predict = '$result[0]' WHERE idTesting = '$id_data'");

            try {
                $updateQuery->execute();
                print_r("Sukses");
            } catch (Exception $e) {
                var_dump($e->getMessage());
            }
        }
        //Test case
        $result = Yii::$app->db->createCommand('select * from data_testing_feature')->queryAll();

        foreach($result as $row) {

            //Classification factor
            $n = 'kondisi_actual';
            //table name
            $table = 'data_training_feature';
            $X = array(
                'suhu_min' => $row['suhu_min'],
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
        $searchModel = new DataTestingFeatureSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $countSehat = DataTestingFeature::find()->count();
        $countTidakSehat = DataTestingFeature::find()->count();

        return $this->render('predict', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            '$countSehat' => $countSehat,
            '$countTidakSehat' => $countTidakSehat,
        ]);
    }

    /**
     * Finds the DataTrainingFeature model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return DataTrainingFeature the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DataTrainingFeature::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
