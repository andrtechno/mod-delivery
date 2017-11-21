<?php
namespace panix\mod\delivery\models;
class Form extends \yii\base\Model {

    public $text;
    public $from;
    public $themename;

    public function rules() {
        return array(
            array('text,from,themename', 'required'),
        );
    }

    public function attributeLabels() {
        return array(
            'themename' => 'Заголовок письма',
            'text' => 'Содержание письма',
            'from' => 'Кому отправить',
        );
    }

}

?>