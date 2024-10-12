<?php

namespace dashboard\jobs;

use common\models\CarListing;
use yii\queue\JobInterface;
use yii\queue\Queue;
use Yii;

class CarListingExportJob implements JobInterface
{
    public $filterParams;
    public $filePath;

    public function __construct($filterParams, $filePath)
    {
        $this->filterParams = $filterParams;
        $this->filePath = $filePath;
    }

    public function execute($queue)
    {
        // Query the car listings with optional filters
        $query = CarListing::find();
        if (!empty($this->filterParams)) {
            foreach ($this->filterParams as $key => $value) {
                if (!empty($value)) {
                    if ($key == 'price' || $key == 'mileage' || $key == 'year') {
                        $query->andFilterWhere([$key => $value]);
                        continue;
                    } else {
                        $query->andFilterWhere(['like', $key, $value]);
                    }
                }
            }
        }

        try{
            $file = fopen($this->filePath, 'w');
            fputcsv($file, ['ID', 'Title', 'Make', 'Model', 'Year', 'Price', 'Mileage']);
            foreach ($query->all() as $car) {
                fputcsv($file, [
                    $car->id,
                    $car->title,
                    $car->make,
                    $car->model,
                    $car->year,
                    $car->price,
                    $car->mileage,
                ]);
            }
    
            // Close the file
            fclose($file);
            Yii::info('Car listings exported successfully');
        } catch (\Exception $e) {
            Yii::error($e->getMessage());
        }
    }
}