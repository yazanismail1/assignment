<?php

use yii\helpers\Html;

$this->title = 'Job Management';
$this->params['breadcrumbs'][] = ['label' => 'Car Listings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="job-management-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Job Name</th>
                <th>Channel</th>
                <th>Created At</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($jobs as $job): ?>
                <tr>
                    <td><?= Html::encode($job['id']) ?></td>
                    <td style="max-width: 800px; overflow-wrap: break-word;"><?= Html::encode($job['job']) ?></td>
                    <td><?= Html::encode($job['channel']) ?></td>
                    <td><?= Html::encode(date('Y-m-d H:i:s', $job['pushed_at'])) ?></td>
                    <td><?= Html::encode($job['status']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>