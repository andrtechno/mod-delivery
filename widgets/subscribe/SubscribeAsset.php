<?php

namespace panix\mod\delivery\widgets\subscribe;

use panix\engine\web\AssetBundle;

/**
 * Class SubscribeAsset
 * @package panix\mod\delivery\widgets\subscribe
 */
class SubscribeAsset extends AssetBundle
{
    public $sourcePath = __DIR__ . '/assets';

    public $js = [
        'subscribe.js',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
