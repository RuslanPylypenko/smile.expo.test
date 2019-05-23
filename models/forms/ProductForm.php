<?php
namespace app\models\forms;

use app\models\Product;
use app\models\ProductPhoto;
use yii\base\Model;
use Yii;

class ProductForm extends Model
{
    const MAX_DESCRIPTION_LENGHT = 1000;

    public $pictures;
    public $name;
    public $price;
    public $catalog_id;
    public $photos;
    public $description;


    public function rules()
    {
        return [
            [['name', 'description', 'price', 'catalog_id'], 'required'],
            [['price', 'catalog_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['photos'], 'file',
                'skipOnEmpty' => false,
                'extensions' => ['jpg', 'png', 'jpeg'],
                'checkExtensionByMimeType' => true,
                'maxFiles' => 5,
                'maxSize' => $this->getMaxFileSize()],
            [['description'], 'string', 'max' => self::MAX_DESCRIPTION_LENGHT],
        ];
    }

    public function save()
    {
        $product = new Product();
        $product->name = $this->name;
        $product->price = $this->price;
        $product->description = $this->description;
        $product->catalog_id = $this->catalog_id;

        if ($product->save(false)) {
            $product->uploadPhotos($this->photos);
            return true;
        }
        return false;
    }


    private function getMaxFileSize()
    {
        return Yii::$app->params['maxFileSize'];
    }


}