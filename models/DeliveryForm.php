<?php

namespace panix\mod\delivery\models;

use panix\engine\base\Model;

class DeliveryForm extends Model
{

    protected $module = 'delivery';

    public $text;
    public $from;
    public $themename;

    public function rules()
    {
        return [
            [['text', 'from', 'themename'], 'required'],
            [['text'], 'string'],
        ];
    }

}
