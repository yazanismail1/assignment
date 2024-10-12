<?php

namespace dashboard\controllers;

use common\models\CarListing;
use common\models\CarListingSearch;
use dashboard\jobs\CarListingExportJob;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * CarListingController implements the CRUD actions for CarListing model.
 */
class CarListingController extends Controller
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
                'access' => [
                    'class' => \yii\filters\AccessControl::className(),
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['@'],
                        ],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all CarListing models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new CarListingSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CarListing model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new CarListing model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new CarListing();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {

                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing CarListing model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $data = $this->request->post();
        // $data['CarListing']['updated_at'] = date('Y-m-d H:i:s');
        // // dd($data);
        if ($this->request->isPost && $model->load($data) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing CarListing model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CarListing model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return CarListing the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CarListing::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionExport()
    {
        $fileName = 'car_listings_' . date('Y-m-d_His') . '.csv';
        $filePath = Yii::getAlias('@dashboard/web/exports/') . $fileName;
        // dd($filePath);
        // Push job to the queue
        try{
            $queryParams = Yii::$app->request->queryParams["CarListingSearch"];
        } catch (\Exception $e) {
            $queryParams = [];
        }
        // dd($queryParams);
        $job = new CarListingExportJob($queryParams, $filePath);
        Yii::$app->queue->push($job);
                
        Yii::$app->session->setFlash('success', 'The export job has been queued.');
        return $this->redirect(['index']);
    }

    public function actionExportFiles()
    {
        $exportDir = Yii::getAlias('@dashboard/web/exports/');
        $files = array_diff(scandir($exportDir), ['.', '..']); // Get list of CSV files

        return $this->render('export-files', [
            'files' => $files,
        ]);
    }

    public function actionDownload($file)
    {
        $filePath = Yii::getAlias('@dashboard/web/exports/') . $file;
        if (file_exists($filePath)) {
            return Yii::$app->response->sendFile($filePath);
        }

        throw new \yii\web\NotFoundHttpException('The requested file does not exist.');
    }

    public function actionJobManagement()
    {
        $jobs = (new \yii\db\Query())
        ->select('*')
        ->from('queue') // Adjust this table name if your queue table is named differently
        ->all();
        return $this->render('job-management', [
            'jobs' => $jobs,
        ]);
    }

    public function actionRunJob($id)
    {
        $queue = Yii::$app->queue;
        // dd($id);
        $queue->run($id); 
        return $this->redirect(['job-management']);
    }
}
