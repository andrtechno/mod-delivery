<?php

use yii\widgets\ActiveForm;
use panix\engine\Html;

/** @var \yii\web\View $this */

?>
    <p><?= Yii::t('wgt_SubscribeWidget/default', 'WGT_TEXT') ?></p>
<?php
if ($result['success']) {
    echo 'ok';
} else {
    \panix\mod\delivery\widgets\subscribe\SubscribeAsset::register($this);
    /*$form = $this->beginWidget('CActiveForm', array(
        'enableAjaxValidation' => true,
        'id' => 'delivery-form',
        'action' => Yii::$app->createUrl('/delivery/subscribe.action'),
        'clientOptions' => array(
            'validateOnSubmit' => true,
            'validateOnChange' => false,
        ),
        'htmlOptions' => array(
            'name' => 'delivery-form',
            'onsubmit' => "return false;",
            'onkeypress' => 'if(event.keyCode==13){send("#delivery-form", "#side-subscribe")}'
        )
            ));

    if ($model->hasErrors())
        $form->error($model, 'email');*/
    ?>
<div class="subscribe_form">
    <?php $form = ActiveForm::begin([
        'action' => ['/delivery/subscribe'],
        'id' => 'subscribe-form',
        'options'=>[
                'class'=>'mc-form footer-newsletter'
        ]
        //'enableAjaxValidation' => true,
    ]); ?>
    <?= $form->field($model, 'email')
        ->textInput([
            'class' => 'form-control',
            'placeholder' => $model->getAttributeLabel('email')
        ])->label(false); ?>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('delivery/default', 'BUTTON'), ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>

<?php } ?>