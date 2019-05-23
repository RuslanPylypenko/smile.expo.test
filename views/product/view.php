<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;

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
                        $result .= Html::img(Yii::$app->storage->getFile($photo->src), ['width' => 80]);
                    }
                    return $result;
                }
            ],
        ],
    ]) ?>

    <?php if ($comments = $model->feedbacks) : ?>
        <div class="row">
            <div class="col-sm-12">
                <h2><?php echo Yii::t('main', 'Feedbacks') ?></h2>
                <?php foreach ($comments as $comment): ?>
                    <div class="row">
                        <div class="col-sm-10">
                            <p><b><?= $comment->user_name . " | " . $comment->user_email ?> : </b><?= HtmlPurifier::process($comment->text); ?>
                            </p>
                        </div>
                        <div class="col-sm-2">

                            <a href="<?= Url::to(['/feedback/edit', 'id' => $comment->id, 'product_id' => $model->id]) ?>"
                               class="btn btn-sm btn-info"><?php echo Yii::t('main', 'Update') ?></a>

                            <a href="<?= Url::to(['/feedback/delete', 'id' => $comment->id, 'product_id' => $model->id]) ?>"
                               class="btn btn-sm btn-danger"><?php echo Yii::t('main', 'Delete') ?></a>

                        </div>

                    </div>


                    <hr>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>


    <div class="row">
        <div class="col-sm-12">
            <?php $form = ActiveForm::begin(); ?>
            <?= $form->field($commentModel, 'user_name')->label(Yii::t('main', 'Your Name')) ?>
            <?= $form->field($commentModel, 'user_email')->label(Yii::t('main', 'Your Email')) ?>
            <?= $form->field($commentModel, 'text')->textarea(['rows' => 3])->label(Yii::t('main', 'Feedback')) ?>
            <?= Html::button(Yii::t('main', 'Add'), ['class' => 'btn btn-primary', 'type' => 'submit']) ?>
            <?php $form::end(); ?>
        </div>
    </div>

</div>
