<?php
use panix\engine\bootstrap\ActiveForm;

$form = ActiveForm::begin([
    'id' => 'div-form',
    'enableClientValidation' => true,

    'options' => [
        'class' => 'form-horizontal',
    ]
]);
?>
<div class="card">
    <div class="card-header">
        <h5><?= $this->context->pageName; ?></h5>
    </div>
    <div class="card-body">
        <?php
        echo $form->field($model, 'name');
        echo $form->field($model, 'email');

        ?>
    </div>
    <div class="card-footer text-center">
        <?= $model->submitButton(); ?>
    </div>
</div>


<?php ActiveForm::end(); ?>