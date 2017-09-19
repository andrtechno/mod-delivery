<?php

namespace panix\mod\delivery\controllers\admin;

use Yii;
use panix\mod\delivery\models\Delivery;
use panix\mod\delivery\models\DeliverySearch;
use panix\mod\delivery\models\DeliveryForm;
use panix\mod\user\models\User;

class DefaultController extends \panix\engine\controllers\AdminController {

    public function actionIndex() {
        $this->pageName = Yii::t('delivery/default', 'DELIVERYS');

        $this->buttons = array(
            array(
                'label' => Yii::t('delivery/default', 'CREATE_DELIVERY'),
                'url' => ['create-delivery'],
                'options' => array('class' => 'btn btn-success')
            ),
            array(
                'label' => Yii::t('delivery/default', 'CREATE_DELIVERY_MAIL'),
                'url' => ['create'],
                'options' => array('class' => 'btn btn-success')
            )
        );


        $searchModel = new DeliverySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'searchModel' => $searchModel,
        ]);


        if (Yii::$app->request->getPost('Delivery')) {
            $deliveryRecord->attributes = Yii::$app->request->getPost('Delivery');
        }
        $this->render('index', array('deliveryRecord' => $deliveryRecord));
    }

    public function actionUpdate($new = false) {
        $this->buttons = false;
        if ($new === true) {
            $model = new Delivery;
            $this->pageName = Yii::t('delivery/default', 'Создание подписчика');
        } else {
            $model = $this->loadModel($_GET['id']);
            $this->pageName = Yii::t('delivery/default', 'Редактирование подписчика');
        }
        $this->breadcrumbs = array(
            Yii::t('delivery/default', 'MODULE_NAME') => array('index'),
            $this->pageName
        );
        if (Yii::$app->request->getPost('Delivery')) {
            $model->attributes = Yii::$app->request->getPost('Delivery');
            //$this->performAjaxValidation($model);
            if ($model->validate()) {
                $model->save();
                $this->redirect(array('index'));
            }
        }
        $this->render('update', array('model' => $model));
    }

    public function actionCreateDelivery() {
        $this->pageName = Yii::t('delivery/default', 'MODULE_NAME');
        $this->buttons = false;
        $model = new DeliveryForm;
        $delivery = Delivery::find()->all();
        $mails = [];
        $users = User::find()->where(['subscribe' => 1])->all();
        $render = 'create';

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            if ($model->from == 'all') {
                foreach ($users as $user) {
                    $mails[] = $user->email;
                }
                foreach ($delivery as $subscriber) {
                    $mails[] = $subscriber->email;
                }
            } elseif ($model->from == 'users') {
                foreach ($users as $user) {
                    $mails[] = $user->email;
                }
            } else {
                foreach ($delivery as $subscriber) {
                    $mails[] = $subscriber->email;
                }
            }


            if (Yii::$app->request->isAjax) {

                $render = 'send';
            } else {
                $render = 'create';
            }
        } else {
            if (Yii::$app->request->isAjax) {

                $render = 'form';
            } else {
                $render = 'create';
            }
            //Stops the request from being sent.
            //throw new CHttpException(404, 'Model has not been saved');
        }



        $this->breadcrumbs[] = [
            'label' => Yii::t('delivery/default', 'MODULE_NAME'),
            'url' => ['index']
        ];
        $this->breadcrumbs[] = Yii::t('delivery/default', 'CREATE_DELIVERY');
        if (Yii::$app->request->isAjax) {
            return $this->renderAjax($render, [
                        'users' => $users,
                        'delivery' => $delivery,
                        'model' => $model,
                        'mails' => $mails
            ]);
        } else {
            return $this->render($render, [
                        'users' => $users,
                        'delivery' => $delivery,
                        'model' => $model,
                        'mails' => $mails
            ]);
        }
    }

    public function actionSendmail() {
        if (Yii::$app->request->isAjax && Yii::$app->request->isPost) {
            Yii::$app->mailer
                    ->compose()//'@cart/mail/admin', ['order' => $order]
                    ->setFrom('noreply@' . Yii::$app->request->serverName)
                    ->setTo($_POST['email'])
                    ->setSubject($_POST['themename'])
                    ->setHtmlBody($_POST['text'])
                    ->send();
        }
    }

    public function actionSendNewProduct() {
        $products = Product::model()->newToDay()->findAll();
        if (count($products)) {
            foreach ($products as $product) {
                print_r($product->name);
                echo '<br>';
            }
            $this->setFlashMessage(Yii::t('app', 'Сообщение оправлено подписчикам.'));
        } else {
            $this->setFlashMessage(Yii::t('app', 'Новых товаров за сегодня небыло добавлено!'));
        }
        $this->redirect(array('index'));
    }

    public function loadModel($id) {
        $model = Delivery::findOne($id);
        if ($model === null)
            $this->error404();
        return $model;
    }

    /**
     * Дополнительное меню Контроллера.
     * @return array
     */
    public function getAddonsMenu() {
        return array(
            array(
                'label' => Yii::t('app', 'Отправить новые товары'),
                'url' => array('/admin/delivery/default/sendNewProduct'),
                'icon' => 'shopcart',
                'visible' => false
            ),
        );
    }

}