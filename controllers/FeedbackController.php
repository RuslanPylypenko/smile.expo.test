<?php


namespace app\controllers;


use app\models\FeedbackProduct;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class FeedbackController extends Controller
{
    public function actionEdit($id, $product_id)
    {
        $feedback = $this->findModel($id);

        if($feedback->load(Yii::$app->request->post())){
            $feedback->save(true, ['text']);
            return $this->redirect(['/product/view', 'id' => $product_id]);
        }

        return $this->render('edit', [
            'feedback' => $feedback
        ]);
    }

    public function actionDelete($id, $product_id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['/product/view', 'id' => $product_id]);
    }

    protected function findModel($id)
    {
        if (($model = FeedbackProduct::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('main', 'The requested page does not exist.'));
    }

}