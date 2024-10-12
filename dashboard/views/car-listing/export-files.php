<?php
use yii\helpers\Html;

$this->title = 'Export Files';
$this->params['breadcrumbs'][] = ['label' => 'Car Listings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="export-files-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <table class="table">
        <thead>
            <tr>
                <th>File</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($files as $file): ?>
                <tr>
                    <td><?= Html::encode($file) ?></td>
                    <td>
                        <?= Html::a('Download', ['download', 'file' => $file], ['class' => 'btn btn-primary']) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
