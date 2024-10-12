<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\CarListing $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Car Listings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="car-listing-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <strong>Make:</strong> <?= Html::encode($model->make) ?><br>
        <strong>Model:</strong> <?= Html::encode($model->model) ?><br>
        <strong>Year:</strong> <?= Html::encode($model->year) ?><br>
        <strong>Price:</strong> <?= Html::encode($model->price) ?><br>
        <strong>Mileage:</strong> <?= Html::encode($model->mileage) ?><br>
        <strong>Status:</strong> <?= Html::encode($model->status) ?><br>
    </p>

    <p>
       <?php if ($model->status === 'sold' ): ?>
            <?= Html::button('Sold', ['class' => 'btn btn-secondary', 'disabled' => true]) ?>
        <?php elseif (Yii::$app->user->isGuest): ?>
            <?= Html::button('login', ['class' => 'btn btn-secondary', 'disabled' => true]) ?>
        <?php else: ?>
            <?= Html::a('Purchase', ['purchase', 'id' => $model->id], ['class' => 'btn btn-primary', 'data-method' => 'post']) ?>
        <?php endif; ?>
        <?= Html::a('Back to Listings', ['index'], ['class' => 'btn btn-outline-secondary']) ?>
    </p>

</div>
