<?php

namespace panix\mod\delivery\widgets\subscribe;

use panix\engine\base\Model;

class SubscribeForm extends Model
{
    public static $category = 'delivery';
    public $module = 'delivery';

    public $email;

    public function rules()
    {
        return [
            [['email'], 'required'],
            ['email', 'email'],
        ];
    }
}