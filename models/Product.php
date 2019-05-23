<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $price
 * @property int $catalog_id
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description', 'price', 'catalog_id'], 'required'],
            [['description'], 'string'],
            [['price', 'catalog_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('main', 'ID'),
            'name' => Yii::t('main', 'Name'),
            'description' => Yii::t('main', 'Description'),
            'price' => Yii::t('main', 'Price'),
            'catalog_id' => Yii::t('main', 'Catalog_id'),
        ];
    }


    public function getPhotos(){
        return $this->hasMany(ProductPhoto::className(), ['product_id' => 'id']);
    }

    public static function getCatalogDropdown()
    {
        $catalogs = Catalog::find()->asArray()->all();
        return ArrayHelper::map($catalogs, 'id', 'name');
    }

    public function uploadPhotos($photos){
        foreach ($photos as $file) {
            $ProductPhoto = new ProductPhoto();
            $ProductPhoto->src = Yii::$app->storage->saveUploadedFile($file);
            $ProductPhoto->product_id = $this->id;
            $ProductPhoto->save(false);
        }
    }


    public function getCatalog()
    {
        return Catalog::findOne($this->catalog_id);
    }
}
