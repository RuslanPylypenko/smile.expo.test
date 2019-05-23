<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "products".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $photo
 * @property int $price
 */
class Products extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description', 'photo', 'price'], 'required'],
            [['description'], 'string'],
            [['price'], 'integer'],
            [['name', 'photo'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('products', 'ID'),
            'name' => Yii::t('products', 'Name'),
            'description' => Yii::t('products', 'Description'),
            'photo' => Yii::t('products', 'Photo'),
            'price' => Yii::t('products', 'Price'),
        ];
    }
}
