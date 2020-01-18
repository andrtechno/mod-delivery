<?php
use panix\engine\bootstrap\ActiveForm;
use panix\ext\tinymce\TinyMce;
use panix\engine\Html;
/**
 * @var \yii\web\View $this
 * @var \panix\mod\delivery\models\DeliveryForm $model
 */


$this->registerJs("



$(document).on('submit', '#delivery-form', function () {

    var xhr = $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        data: $(this).serialize(),
        success: function (response) {
            $('#response-box').html(response);


        },
        error: function () {
            alert('Error!');
        }
    });
    return false;
});



");

$form = ActiveForm::begin([
    'id' => 'delivery-form',
]);


?>
<?php
$countUsers = count($users);
$countDelivery = count($delivery);
$countAll = count(yii\helpers\ArrayHelper::merge($users, $delivery));
//$countAll = count(array_unique(CMap::mergeArray($users, $delivery)));
?>
<?php echo $form->field($model, 'subject'); ?>



<?php
/*echo $form->field($model, 'text')->widget(TinyMce::class, [
    'options' => ['rows' => 6],
]);*/
echo $form->field($model, 'text')->widget(TinyMce::class);
?>
<?= $form->field($model, 'from')->dropDownList([
        'all' => 'Всем (' . $countAll . ')',
    'users' => 'Пользователям (' . $countUsers . ')',
    'delivery' => 'Подписчикам (' . $countDelivery . ')'
], ['class' => 'select form-control']); ?>

<div class="form-group text-center">
    <?= Html::submitButton(Yii::t('app/default', 'Начать отправку'),['class'=>'btn btn-success']) ?>
</div>


<?php ActiveForm::end(); ?>


