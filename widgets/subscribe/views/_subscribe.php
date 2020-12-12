<?php

use yii\widgets\ActiveForm;
use panix\engine\Html;

/** @var \yii\web\View $this */

\panix\mod\delivery\widgets\subscribe\SubscribeAsset::register($this);

$this->registerJs("

$(document).on('beforeSubmit', '#subscribe-form', function (e) {
    var form = $(this);
    var formData = form.serialize();
        $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: formData,
        success: function (response) {
            if(response.success){
                $('#subscribers-email').val('');
                common.notify(response.message,'success');
            }else{
                form.yiiActiveForm('updateMessages', response.errors, true);
            }
        },
        error: function () {
            common.notify('error','error');
        }
    });
    
    return false; // Cancel form submitting.
});
")
?>
<div class="subscribe_form">
    <?php
    $form = ActiveForm::begin([
        'action' => ['/delivery/subscribe'],
        'id' => 'subscribe-form',
        'enableClientValidation' => true,
        //'enableAjaxValidation' => true,
        'options' => [
            // 'class' => ''
        ]

    ]);
    ?>
    <?= $form->field($model, 'email')
        ->textInput([
            'class' => 'form-control2',
            'placeholder' => $model->getAttributeLabel('email')
        ])->label(false); ?>

    <?php //echo Html::submitButton(Yii::t('wgt_SubscribeWidget/default', 'BUTTON'), ['class' => 'btn btn-primary']) ?>

    <?php ActiveForm::end(); ?>
</div>




