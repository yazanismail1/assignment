<?php
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\CarListing[] $purchasedCars */

$this->title = 'My Purchases';
// $this->params['breadcrumbs'][] = $this->title;
?>

<div class="my-purchases">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (!empty($purchasedCars)): ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Make</th>
                    <th>Model</th>
                    <th>Year</th>
                    <th>Price</th>
                    <th>Mileage</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($purchasedCars as $car): ?>
                    <tr>
                        <td><?= Html::encode($car->title) ?></td>
                        <td><?= Html::encode($car->make) ?></td>
                        <td><?= Html::encode($car->model) ?></td>
                        <td><?= Html::encode($car->year) ?></td>
                        <td><?= Html::encode($car->price) ?></td>
                        <td><?= Html::encode($car->mileage) ?></td>
                        <td><?= Html::encode($car->status) ?></td>
                        <td><?= Html::a('View', ['view', 'id' => $car->id]) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>You have not purchased any cars yet.</p>
    <?php endif; ?>
</div>
