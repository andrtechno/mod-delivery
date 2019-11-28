<?php

namespace panix\mod\delivery\models;

use panix\engine\base\Model;

/**
 * Class DeliveryForm
 * @package panix\mod\delivery\models
 */
class DeliveryForm extends Model
{

    protected $module = 'delivery';

    public $text;
    public $from;
    public $subject;

    public function rules()
    {
        return [
            [['text', 'from', 'subject'], 'required'],
            [['text'], 'string'],
        ];
    }

}
