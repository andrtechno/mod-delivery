<?php

namespace panix\mod\delivery\controllers;


use panix\mod\delivery\widgets\subscribe\SubscribeAsset;
use Yii;
use panix\engine\controllers\WebController;
use panix\mod\delivery\models\Subscribers;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * Class DefaultController
 * @package panix\mod\delivery\controllers
 */
class DefaultController extends WebController
{


    public function actionIndex()
    {

        $this->render('index');
    }

    public function actionSubscribe()
    {

        $result['success'] = false;
        $model = new Subscribers();
        // if(Yii::$app->request->isAjax){
        //    return 'Запрос принят!';
        //}

        $load = $model->load(Yii::$app->request->post());
         if (Yii::$app->request->isAjax) {
             if (Yii::$app->request->isPost && $load) {
               //  Yii::$app->response->format = Response::FORMAT_JSON;
                 $errors = ActiveForm::validate($model);
                 if ($errors) {
                     $result['success'] = false;
                     $result['errors']=$errors;

                 } else {
                     $model->save();
                     $result['success'] = true;
                     $result['message'] = Yii::t('delivery/default','SUBSCRIBE_SUCCESS',$model->email);

                    // return $this->renderAjax('@delivery/widgets/subscribe/views/_subscribe', ['model' => $model, 'result' => $result]);

                 }

             }
             return $this->asJson($result);
         }
        /*if ($load) {
            if ($model->validate()) {
                $model->save();
                $result['success'] = true;
                Yii::$app->session->setFlash('success', 'Вы успешно подписались');
            } else {
                Yii::$app->session->setFlash('error', 'Email введен неверно');
            }
        }
        Yii::$app->response->format = Response::FORMAT_RAW;
        return $this->render('@delivery/widgets/subscribe/views/_subscribe', ['model' => $model, 'result' => $result]);*/
    }

}
