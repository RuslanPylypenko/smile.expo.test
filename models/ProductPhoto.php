<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product_photo".
 *
 * @property int $id
 * @property int $product_id
 * @property string $src
 */
class ProductPhoto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_photo';
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('main', 'ID'),
            'product_id' => Yii::t('main', 'Product ID'),
            'src' => Yii::t('main', 'Src'),
        ];
    }


    public function beforeDelete()
    {
        Yii::$app->storage->deleteFile($this->src);

        return parent::beforeDelete();
    }
}
