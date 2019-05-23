<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('main', 'Products');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('main', 'Create Product'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'description:ntext',
            'price',
            [
                'attribute' => Yii::t('main', 'Catalog'),
                'format' => 'raw',
                'value' => function ($product) {
                    /* @var $product \app\models\Product */
                    return $product->getCatalog()->name;
                },
            ],
            [
                'attribute' => Yii::t('main', 'Photos'),
                'format' => 'raw',
                'value' => function ($product) {
                    /* @var $product \app\models\Product */
                    $result = '';
                    foreach ($product->photos as $photo) {
                        /* @var $photo \app\models\ProductPhoto */
                        $result .=  Html::img(Yii::$app->storage->getFile($photo->src), ['width' => 40]);
                    }
                    return $result;
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
