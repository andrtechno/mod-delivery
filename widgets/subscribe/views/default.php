<?php
/** @var \yii\web\View $this */
$result['success'] = false;

?>
<div class="newsletter">
    <h3 class="section-title"><?= Yii::t('wgt_SubscribeWidget/default', 'WGT_NAME') ?></h3>
    <div class="sidebar-widget-body" id="container-subscribe">
        <?= $this->render('_subscribe', ['model' => $model, 'result' => $result]); ?>
    </div>
</div>





