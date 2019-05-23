<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Product;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'catalog_id')->dropDownList(Product::getCatalogDropdown()) ?>

    <?php if ($model->photos) : ?>
    <div class="row">
        <?php foreach ($model->photos as $photo): ?>
            <div style="width: 100px; height: 100px; display: inline-block; margin: 0 10px">
                <?php echo Html::img(Yii::$app->storage->getFile($photo->src), ['width' => 80]); ?>
                <br>
                <a href="<?php echo Url::to(['product/delete-photo', 'id' => $photo->id])?>" class="btn btn-danger"><?php echo  Yii::t('main', 'delete image')?></a>
            </div>
        <?php endforeach; ?>
    </div>

    <?php endif; ?>


    <?= $form->field($model, 'photos[]')->fileInput(['multiple' => true, 'accept' => 'image/*'])->hint(Yii::t('main', 'Upload photo')); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('main', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
