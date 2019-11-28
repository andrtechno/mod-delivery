<?php
/**
 * @var
 */

use yii\widgets\ActiveForm;
use panix\engine\Html;

$model = new \panix\mod\delivery\widgets\subscribe\SubscribeForm();
?>

    <p><?= Yii::t('delivery/default', 'WGT_TEXT') ?></p>
<?php
if (Yii::$app->session->hasFlash('success')) {
    echo Yii::$app->session->getFlash('success');
} else {

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

    <?php $form = ActiveForm::begin([
        'action' => ['/delivery/subscribe'],
        'id' => 'subscribe-form'
    ]); ?>
    <?= $form->field($model, 'email')
        ->textInput([
            'class' => 'form-control',
            'placeholder' => $model->getAttributeLabel('email')
        ]); ?>
    <div class="form-group">
        <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
    <a href="javascript:void(0)" class="btn btn-default"
       onclick="send('#delivery-form','#side-subscribe')"><?= Yii::t('delivery/default', 'BUTTON') ?></a>


<?php } ?>