<?php

namespace panix\mod\delivery\models;

use Yii;
use panix\engine\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use panix\mod\user\models\User;

class Delivery extends ActiveRecord
{
    const MODULE_ID = 'delivery';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%delivery}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['email', 'unique'],
            [['email'], 'required'],
            [['name'], 'string'],
            ['email', 'validateUserEmail', 'on' => 'insert'],
            ['email', 'email'],
            ['email', 'match', 'pattern' => '/^[\da-z][-_\d\.a-z]*@(?:[\da-z][-_\da-z]*\.)+[a-z]{2,5}$/iu'],

        ];
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    static::EVENT_BEFORE_INSERT => ['created_at'],
                    //  static::EVENT_BEFORE_UPDATE => ['created_at']
                ],
            ]
        ];
    }


    public function validateUserEmail($attr)
    {
        $labels = $this->attributeLabels();
        // $checkUser = User::find()->countByAttributes(array(
        //     'email' => $this->$attr,
        // ), 't.id != :id AND subscribe=:subscribe', array(':id' => (int)Yii::$app->user->id, ':subscribe' => 1));

        $checkUser = User::find()->where([
            'email' => $this->{$attr},
            'subscribe' => 1
        ])->count();


        $checkEmail = Delivery::find()->where([
            'email' => $this->{$attr},
        ])->count();

        if ($checkUser > 0)
            $this->addError($attr, Yii::t('delivery/default', 'SUBSCRIBE_USER_ALREADY', ['attr' => $labels[$attr]]));
        if ($checkEmail > 0)
            $this->addError($attr, Yii::t('delivery/default', 'SUBSCRIBE_USER_ALREADY', ['attr' => $this->$attr]));
    }


}
