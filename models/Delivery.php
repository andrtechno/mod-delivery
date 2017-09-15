<?php
namespace panix\mod\delivery\models;
class Delivery extends \panix\engine\db\ActiveRecord {

    const MODULE_ID = 'delivery';

    public function getForm() {
        return new CMSForm(array(
            'attributes' => array(
                'id' => __CLASS__,
                'class' => 'form-horizontal',
            ),
            'elements' => array(
                'email' => array(
                    'type' => 'text',
                ),
            ),
            'buttons' => array(
                'submit' => array(
                    'type' => 'submit',
                    'class' => 'btn btn-success',
                    'label' => ($this->isNewRecord) ? Yii::t('app', 'CREATE', 0) : Yii::t('app', 'SAVE')
                )
            ),
                ), $this);
    }


    /**
     * @return string the associated database table name
     */
    public static function tableName() {
        return '{{%delivery}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
            array('email', 'required'),
            array('email', 'validateUserEmail'),
            array('email', 'email'),
            array('email', 'match', 'pattern' => '/^[\da-z][-_\d\.a-z]*@(?:[\da-z][-_\da-z]*\.)+[a-z]{2,5}$/iu'),
            array('id, email, date_create', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array
     */
    public function behaviors222() {
        $a = array();
        $a['timezone'] = array(
            'class' => 'app.behaviors.TimezoneBehavior',
            'attributes' => array('date_create'),
        );
        return $a;
    }

//inter@dsa.ds
    public function validateUserEmail($attr) {
        $labels = $this->attributeLabels();
        $checkUser = User::model()->countByAttributes(array(
            'email' => $this->$attr,
                ), 't.id != :id AND subscribe=:subscribe', array(':id' => (int) Yii::app()->user->id, ':subscribe' => 1));

        $checkEmail = Delivery::model()->countByAttributes(array(
            'email' => $this->$attr,
        ));

        if ($checkUser > 0)
            $this->addError($attr, Yii::t('delivery/default', 'SUBSCRIBE_USER_ALREADY', array('{attr}' => $labels[$attr])));
        if ($checkEmail > 0)
            $this->addError($attr, Yii::t('delivery/default', 'SUBSCRIBE_USER_ALREADY', array('{attr}' => $this->$attr)));
    }


}
