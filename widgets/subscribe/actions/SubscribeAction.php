<?php

class SubscribeAction extends CAction {

    public $defaultSkin = 'mod.delivery.widgets.subscribe._subscribe';

    /**
     * Subscribe action
     * @throws CHttpException
     */
    public function run() {
        if (Yii::app()->request->isAjaxRequest) {
            $model = new Delivery();
            if (isset($_POST['Delivery'])) {
                $model->attributes = $_POST['Delivery'];
                if ($model->validate()) {
                    $model->save();
                    Yii::app()->user->setFlash('success', Yii::t('SubscribeWidget.default', 'SUBSCRIBE_SUCCESS',array('{email}'=>$model->email)));
                }
            }
            // $this->controller->render('mod.delivery.widgets.subscribe.views._subscribe', array('model' => $model));
           // $this->controller->render('current_theme.views.layouts.inc.main.subscribe._subscribe', array('model' => $model));
            $this->controller->render($this->skin, array('model' => $model));
        } else {
            throw new CHttpException(403);
        }
    }

    public function getSkin() {
        if (file_exists(Yii::getPathOfAlias("current_theme.views.layouts.skins.subscribe"))) {
            return 'current_theme.views.layouts.skins.subscribe._subscribe';
        }else{
            return $this->defaultSkin;
        }
    }

}
