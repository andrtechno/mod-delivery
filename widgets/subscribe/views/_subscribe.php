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
        <?= Html::submitButton(Yii::t('wgt_SubscribeWidget/default', 'BUTTON'), ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>

<?php } ?>