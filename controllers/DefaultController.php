<?php

namespace panix\mod\delivery\controllers;

class DefaultController extends \panix\engine\controllers\WebController {

    //public $layout = '//layouts/main';

    public function actions() {
        return array(
            'subscribe.' => 'mod.delivery.widgets.subscribe.SubscribeWidget',
        );
    }

    public function actionIndex() {

        $this->render('index');
    }

    public function actionSend() {
        $model = new Delivery();
        if (isset($_POST['Delivery'])) {
            $model->attributes = $_POST['Delivery'];
            if ($model->validate()) {
                $model->save();
                Yii::app()->user->setFlash('success', 'Вы успешно подписались');
            } else {
                Yii::app()->user->setFlash('error', 'Email введен неверно');
            }
        }
        $this->render('mod.delivery.widgets.delivery.views._delivery', array('model' => $model));
    }

}
