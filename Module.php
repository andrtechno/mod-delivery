<?php

namespace panix\mod\delivery;

use Yii;
use yii\base\BootstrapInterface;
use panix\engine\WebModule;
use panix\mod\user\models\User;
use panix\mod\delivery\models\Subscribers;

/**
 * Class Module
 * @package panix\mod\delivery
 */
class Module extends WebModule implements BootstrapInterface
{

    public $icon = 'envelope';

    public function bootstrap($app)
    {
        $app->urlManager->addRules(
            [
                'delivery' => 'delivery/default/index',
                'delivery/<action:[0-9a-zA-Z_\-]+>' => 'delivery/default/<action>',

            ],
            true
        );
    }

    public function getAdminMenu()
    {
        return [
            'modules' => [
                'items' => [
                    [
                        'label' => Yii::t('delivery/default', 'MODULE_NAME'),
                        'url' => ['/admin/delivery'],
                        'icon' => $this->icon,
                    ],
                ],
            ],
        ];
    }

    public function getInfo()
    {
        return [
            'label' => Yii::t('delivery/default', 'MODULE_NAME'),
            'author' => 'andrew.panix@gmail.com',
            'version' => '1.0',
            'icon' => $this->icon,
            'description' => Yii::t('delivery/default', 'MODULE_DESC'),
            'url' => ['/admin/delivery'],
        ];
    }

    public static function getAllDelivery()
    {
        $delivery = Subscribers::find()->all();
        $mails = array();
        $users = User::find()->where(['subscribe' => 1])->all();
        if (count($users)) {
            foreach ($users as $user) {
                $mails[] = $user->email;
            }
        }
        if (count($delivery)) {
            foreach ($delivery as $subscriber) {
                $mails[] = $subscriber->email;
            }
        }
        return $mails;
    }

}
