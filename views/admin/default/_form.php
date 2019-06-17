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
]);


?>
<?php
$countUsers = count($users);
$countDelivery = count($delivery);
$countAll = count(yii\helpers\ArrayHelper::merge($users, $delivery));
//$countAll = count(array_unique(CMap::mergeArray($users, $delivery)));
?>
<?php echo $form->field($model, 'themename'); ?>



<?php
/*echo $form->field($model, 'text')->widget(TinyMce::class, [
    'options' => ['rows' => 6],
]);*/
echo $form->field($model, 'text')->textarea(['rows' => 6]);
?>
<?php echo $form->field($model, 'from')->dropDownList(['all' => 'Всем (' . $countAll . ')', 'users' => 'Пользователям (' . $countUsers . ')', 'delivery' => 'Подписчикам (' . $countDelivery . ')'], ['class' => 'select form-control']); ?>

<div class="form-group text-center">
        <a href="javascript:void(0)" class="btn btn-success" onclick="send('#div-form', '#response-box')">Начать отправку!</a>
</div>


<?php ActiveForm::end(); ?>


