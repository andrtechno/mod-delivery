<?php
namespace panix\mod\delivery\widgets\subscribe;


use Yii;
use panix\engine\data\Widget;
use panix\mod\delivery\models\Subscribers;

/**
 * Class SubscribeWidget
 * @package panix\mod\delivery\widgets\subscribe
 */
class SubscribeWidget extends Widget
{

    public function run()
    {
        $model = new Subscribers();
        if (Yii::$app->hasModule('delivery')) {
            return $this->render($this->skin, ['model' => $model]);
        }
    }

}

?>
