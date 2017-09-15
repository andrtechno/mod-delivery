<?php

class Module extends WebModule {

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
                        'label' => $this->name,
                        'url' => $this->adminHomeUrl,
                        'icon' => Html::icon($this->icon),
                    ),
                ),
            ),
        );
    }

    public static function getAllDelivery() {
        $delivery = Delivery::find()->all();
        $mails = array();
        $users = User::model()->subscribe()->findAll();
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
