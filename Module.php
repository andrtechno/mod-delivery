<?php
namespace panix\mod\delivery;
use Yii;
class Module extends \panix\engine\WebModule {

    public $icon = 'sentmail';
    public $routes = array(
        'delivery/' => 'delivery/default/index',
        'delivery/send/' => 'delivery/default/send',
        'delivery/<action:[.\w]+>' => 'delivery/default/<action>',
        'delivery/<action:[.\w]>/*' => 'delivery/default/<action>',
    );

    public function getAdminMenu() {
        return array(
            'modules' => array(
                'items' => array(
                    array(
                        'label' => 'Delivery',
                        'url' => ['/admin/delivery'],
                        'icon' => $this->icon,
                    ),
                ),
            ),
        );
    }
    public function getInfo() {
        return [
            'label' => Yii::t('delivery/default', 'MODULE_NAME'),
            'author' => 'andrew.panix@gmail.com',
            'version' => '1.0',
            'icon' => $this->icon,
            'description' => Yii::t('delivery/default', 'MODULE_DESC'),
            'url' => ['/admin/delivery'],
        ];
    }
    public static function getAllDelivery() {
        $delivery = Delivery::find()->all();
        $mails = array();
        $users = User::find()->subscribe()->all();
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
