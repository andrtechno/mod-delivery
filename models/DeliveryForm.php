<?php
namespace panix\mod\delivery\models;
class DeliveryForm extends \panix\engine\base\Model {

    protected $module = 'delivery';

    public $text;
    public $from;
    public $themename;

    public function rules() {
        return [
            [['text', 'from', 'themename'], 'required'],
            [['text'], 'string'],
        ];
    }

}
