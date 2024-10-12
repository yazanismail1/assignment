<?php

use common\models\CarListing;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var common\models\CarListingSearch $searchModel */

$this->title = 'Car Listings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="car-listing-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Car Listing', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Export to CSV', array_merge(['export'], Yii::$app->request->queryParams), ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Reports', ['export-files'], ['class' => 'btn btn-secondary']) ?>
        <?= Html::a('Pending reports', ['job-management'], ['class' => 'btn btn-outline-secondary']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'make',
            'model',
            'year',
            'price',
            'mileage',
            //'description:ntext',
            'status',
            //'created_at',
            //'updated_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, CarListing $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
