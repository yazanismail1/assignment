<?php


namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class CarListingSearch extends CarListing
{
    public function rules()
    {
        // Define the attributes you want to allow for filtering
        return [
            [['price', 'year', 'mileage'], 'integer'],
            [['title', 'make', 'model', 'status'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = CarListing::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                    'title' => SORT_ASC,
                    'make' => SORT_ASC,
                    'model' => SORT_ASC,
                    'year' => SORT_DESC,
                    'price' => SORT_DESC,
                    'mileage' => SORT_DESC,
                    'status' => SORT_ASC,
                ],
            ],
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // If validation fails, do not return any results
            $query->where('0=1');
            return $dataProvider;
        }

        // Adjust the query by adding filters/
        $query->andFilterWhere([
            'price' => $this->price,
            'mileage' => $this->mileage,
            'year' => $this->year,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
              ->andFilterWhere(['like', 'make', $this->make])
              ->andFilterWhere(['like', 'status', $this->status])
              ->andFilterWhere(['like', 'model', $this->model]);

        return $dataProvider;
    }
}
