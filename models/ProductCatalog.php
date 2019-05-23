<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product_catalog".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 */
class ProductCatalog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_catalog';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description'], 'required'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 255],
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
        ];
    }
}
