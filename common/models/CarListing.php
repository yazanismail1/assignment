<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "car_listing".
 *
 * @property int $id
 * @property string $title
 * @property string $make
 * @property string $model
 * @property int $year
 * @property float $price
 * @property float $mileage
 * @property string $description
 * @property string $status
 * @property int $created_at
 * @property int $updated_at
 */
class CarListing extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'car_listing';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'make', 'model', 'year', 'price', 'mileage', 'description', 'status'], 'required'],
            [['year', 'created_at', 'updated_at'], 'integer'],
            [['price', 'mileage'], 'number'],
            [['description'], 'string'],
            [['title', 'make', 'model', 'status'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'make' => 'Make',
            'model' => 'Model',
            'year' => 'Year',
            'price' => 'Price',
            'mileage' => 'Mileage',
            'description' => 'Description',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    public static function findByUser($userId)
    {
        return static::find()->where(['bought_by_user_id' => $userId])->all();
    }

}
