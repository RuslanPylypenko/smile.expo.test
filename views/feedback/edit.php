<?php
/** @var $feedback \app\models\FeedbackProduct; * */

use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>
<h1>Edit feedbacks</h1>

<?php $form = ActiveForm::begin(); ?>
<?= $form->field($feedback, 'text')->textarea(['row' => 2]); ?>
<?= Html::button('save', ['class' => 'btn btn-primary', 'type' => 'submit']) ?>
<?php $form::end(); ?>
