<?php

namespace storefront\controllers;

use Yii;
use common\models\CarListing;
use common\models\CarListingSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class CarListingController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['my-purchases'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new CarListingSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    protected function findModel($id)
    {
        if (($model = CarListing::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionPurchase($id)
    {
        $model = $this->findModel($id);

        if ($model->status !== 'sold') {
            $model->status = 'sold';

            $model->bought_by_user_id = Yii::$app->user->id; 

            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'The car has been successfully purchased!');
            } else {
                Yii::$app->session->setFlash('error', 'Failed to purchase the car. Please try again.');
            }
        } else {
            Yii::$app->session->setFlash('error', 'This car has already been sold.');
        }

        return $this->redirect(['view', 'id' => $id]);
    }

    public function actionMyPurchases()
    {
        // Get the current user ID
        $userId = Yii::$app->user->id;

        // Fetch the car listings purchased by this user
        $purchasedCars = CarListing::findByUser($userId);

        return $this->render('my-purchases', [
            'purchasedCars' => $purchasedCars,
        ]);
    }
}
