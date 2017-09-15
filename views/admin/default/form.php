<?php
use panix\engine\bootstrap\ActiveForm;
use panix\ext\tinymce\TinyMce;
?>

<script>

    function send(formid, reload) {
        var str = $(formid).serialize();
        $.ajax({
            url: $(formid).attr('action'),
            type: 'POST',
            data: str,
            success: function (data) {
                $(reload).html(data);
            },
            complete: function () {

            }
        });



    }

</script>
<?php
$form = ActiveForm::begin([
            'id' => 'div-form',
    'enableClientValidation'=>true,

            'options' => [
                'class' => 'form-horizontal',
            ]
        ]);


/* $form = $this->beginWidget('CActiveForm', array(
  'enableAjaxValidation' => true,
  'id' => 'div-form',
  'clientOptions' => array(
  'validateOnSubmit' => true,
  'validateOnChange' => false,
  ),
  'htmlOptions' => array('action' => '/delivery/admin', 'name' => 'div-form','class'=>'form-horizontal')
  )); */
?> 
<?php
$countUsers = count($users);
$countDelivery = count($delivery);
$countAll = count(yii\helpers\ArrayHelper::merge($users, $delivery));
//$countAll = count(array_unique(CMap::mergeArray($users, $delivery)));
?>
<?php echo $form->field($model, 'themename'); ?>



<?= $form->field($model, 'text')->widget(TinyMce::className(), [
    'options' => ['rows' => 6],
]);
?>
<?php echo $form->field($model, 'from')->dropDownList(array('all' => 'Всем (' . $countAll . ')', 'users' => 'Пользователям (' . $countUsers . ')', 'delivery' => 'Подписчикам (' . $countDelivery . ')'), array('class' => 'select form-control')); ?>

<div class="form-group">
    <div class="text-center"><a href="javascript:void(0)" class="btn btn-success" onclick="send('#div-form', '#response-box')">Начать отправку!</a></div>
</div>


<?php ActiveForm::end(); ?>


