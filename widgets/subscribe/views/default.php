<?php
/** @var \yii\web\View $this */
$result['success'] = false;
$this->registerJs("
/*
var xhr;

      
$(document).submit('#subscribe-form', function(){
    if (typeof xhr !== 'undefined')
      xhr.abort();
    xhr = $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        data: $(this).serialize(),
        success: function(response){
            console.log($('#container-subscribe'));
            $('#container-subscribe').html(response);
             $('#container-subscribe').html('dsadsa');
             
             
             document.getElementById(\"container-subscribe\").innerHTML = \"Hello World!\";

        },
        error: function(){
            alert('Error!');
        }
    });
    return false;
});
 */
");
?>
<div class="newsletter">
    <h3 class="section-title"><?= Yii::t('wgt_SubscribeWidget/default', 'WGT_NAME') ?></h3>
    <div class="sidebar-widget-body" id="container-subscribe">
        <?= $this->render('_subscribe', ['model' => $model, 'result' => $result]); ?>

    </div>
</div>





