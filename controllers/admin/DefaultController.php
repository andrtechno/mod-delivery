<?php

namespace panix\mod\delivery\controllers\admin;

use Yii;
use panix\mod\delivery\models\Subscribers;
use panix\mod\delivery\models\SubscribersSearch;
use panix\mod\delivery\models\DeliveryForm;
use panix\mod\user\models\User;
use yii\base\Exception;
use panix\engine\controllers\AdminController;

class DefaultController extends AdminController
{
    public function actions()
    {
        return [
            'switch' => [
                'class' => \panix\engine\actions\SwitchAction::class,
                'modelClass' => Subscribers::class,
            ],
            'delete' => [
                'class' => \panix\engine\actions\DeleteAction::class,
                'modelClass' => Subscribers::class,
            ],
        ];
    }

    public function actionIndex()
    {
        $this->pageName = Yii::t('delivery/default', 'FOLLOWERS');
        $this->buttons = [
            [
                'label' => Yii::t('delivery/default', 'CREATE_DELIVERY'),
                'url' => ['create-delivery'],
                'options' => ['class' => 'btn btn-success']
            ],
            [
                'label' => Yii::t('delivery/default', 'CREATE_SUBSCRIBER'),
                'url' => ['create'],
                'options' => ['class' => 'btn btn-success']
            ]
        ];

        $this->breadcrumbs[] = Yii::t('delivery/default', 'MODULE_NAME');
        $searchModel = new SubscribersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);

    }

    public function actionUpdate($id = false)
    {
        $model = Subscribers::findModel($id);

        $this->buttons = false;

        $this->pageName = Yii::t('delivery/default', ($model->isNewRecord) ? 'CREATE_SUBSCRIBER' : 'UPDATE_SUBSCRIBER');

        $this->breadcrumbs[] = [
            'label' => Yii::t('delivery/default', 'MODULE_NAME'),
            'url' => ['index']
        ];
        $this->breadcrumbs[] = $this->pageName;
        $isNew = $model->isNewRecord;
        $post = Yii::$app->request->post();
        if ($model->load($post) && $model->validate()) {
            $model->save();
            return $this->redirectPage($isNew, $post);

        }
        return $this->render('update', ['model' => $model]);
    }

    public function actionCreateDelivery()
    {
        $this->pageName = Yii::t('delivery/default', 'CREATE_DELIVERY');
        $this->buttons = false;
        $model = new DeliveryForm;
        $delivery = Subscribers::find()->all();
        $mails = [];
        $users = User::find()->where(['subscribe' => 1])->all();
        $render = 'create-send';


        $this->breadcrumbs[] = [
            'label' => Yii::t('delivery/default', 'MODULE_NAME'),
            'url' => ['index']
        ];
        $this->breadcrumbs[] = $this->pageName;

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {

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
                    $render = 'create-send';
                }
            } else {
                print_r($model->getErrors());
                die;
                if (Yii::$app->request->isAjax) {

                    $render = '_form';
                } else {
                    $render = 'create-send';
                }
                //Stops the request from being sent.
                //throw new CHttpException(404, 'Model has not been saved');
            }
        }

        if (Yii::$app->request->isAjax) {
            return $this->renderAjax($render, [
                'users' => $users,
                'delivery' => $delivery,
                'model' => $model,
                'mails' => json_encode($mails)
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

    public function actionSendMail()
    {
        $this->enableCsrfValidation=false;
        $request = Yii::$app->request;
        if ($request->isAjax && $request->isPost) {
            try {
                Yii::$app->mailer->compose()//'@cart/mail/admin', ['order' => $order]
                ->setFrom('noreply@' . $request->serverName)
                    ->setTo($request->post('email'))
                    //->setTo(['dev@pixelion.com.ua','andrew.panix@gmail.com'])
                    ->setSubject($request->post('subject'))
                    ->setHtmlBody($request->post('text'))
                    ->send();
            } catch (Exception $exception) {
                throw new Exception($exception->getMessage());
            }
        }
    }

    public function actionSendNewProduct()
    {
        $products = Product::model()->newToDay()->findAll();
        if (count($products)) {
            foreach ($products as $product) {
                print_r($product->name);
                echo '<br>';
            }
            $this->setFlashMessage(Yii::t('app/default', 'Сообщение оправлено подписчикам.'));
        } else {
            $this->setFlashMessage(Yii::t('app/default', 'Новых товаров за сегодня небыло добавлено!'));
        }
        $this->redirect(['index']);
    }


    /**
     * Дополнительное меню Контроллера.
     * @return array
     */
    public function getAddonsMenu()
    {
        return [
            [
                'label' => Yii::t('app/default', 'Отправить новые товары'),
                'url' => ['/admin/delivery/default/send-new-product'],
                'icon' => 'shopcart',
                'visible' => false
            ],
        ];
    }

}
