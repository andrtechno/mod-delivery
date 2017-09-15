<?php

class Delivery extends ActiveRecord {

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

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{delivery}}';
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
    public function behaviors() {
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
            $this->addError($attr, Yii::t('DeliveryModule.default', 'SUBSCRIBE_USER_ALREADY', array('{attr}' => $labels[$attr])));
        if ($checkEmail > 0)
            $this->addError($attr, Yii::t('DeliveryModule.default', 'SUBSCRIBE_USER_ALREADY', array('{attr}' => $this->$attr)));
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return ActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        $criteria = new CDbCriteria;
        $criteria->compare('id', $this->id);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('date_create', $this->date_create, true);
        $criteria->compare('switch', $this->switch);

        return new ActiveDataProvider($this, array('criteria' => $criteria));
    }

}
