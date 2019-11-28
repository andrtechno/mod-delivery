<?php

namespace panix\mod\delivery\controllers;

use panix\mod\delivery\widgets\subscribe\SubscribeForm;
use Yii;
use panix\engine\controllers\WebController;

class DefaultController extends WebController
{


    public function actionIndex()
    {

        $this->render('index');
    }

    public function actionSubscribe()
    {


        $model = new SubscribeForm();
        if(Yii::$app->request->isAjax){
            return 'Запрос принят!';
        }
        if($model->load(Yii::$app->request->post())){
            var_dump($model);
        }

       /* $model = new Delivery();
        if (isset($_POST['Delivery'])) {
            $model->attributes = $_POST['Delivery'];
            if ($model->validate()) {
                $model->save();
                Yii::$app->session->setFlash('success', 'Вы успешно подписались');
            } else {
                Yii::$app->session->setFlash('error', 'Email введен неверно');
            }
        }*/
        //$this->render('mod.delivery.widgets.delivery.views._delivery', array('model' => $model));
    }

}
