<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('main', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('main', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('main', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('main', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'description:ntext',
            'price',
            [
                'attribute' =>  Yii::t('main', 'Catalog'),
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
                        $result .=  Html::img(Yii::$app->storage->getFile($photo->src), ['width' => 80]);
                    }
                    return $result;
                }
            ],
        ],
    ]) ?>

</div>
