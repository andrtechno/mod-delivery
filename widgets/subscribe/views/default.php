<?php
/** @var \yii\web\View $this */
$result['success'] = false;

?>
<div class="newsletter">
    <div class="sidebar-widget-body" id="container-subscribe">
        <?= $this->render('_subscribe', ['model' => $model, 'result' => $result]); ?>
    </div>
</div>





