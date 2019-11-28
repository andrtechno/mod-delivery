<?php
/** @var \yii\web\View $this */

$this->registerJs("
    /*function send(formid, reload){
        var str = $(formid).serialize();
        $.ajax({
            url: $(formid).attr('action'),
            type: 'POST',
            data: str,
            success: function(data){
                $(reload).html(data);
            },
            complete: function(){

            } 
        });
    }*/
    
    
$('form#subscribe-form').on('beforeSubmit', function(){
    var data = $(this).serialize();
    $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        data: data,
        success: function(res){
            console.log(res);
        },
        error: function(){
            alert('Error!');
        }
    });
    return false;
});
 
")
?>
<div class="newsletter">
    <h3 class="section-title"><?= Yii::t('delivery/default', 'WGT_NAME') ?></h3>
    <div class="sidebar-widget-body" id="side-subscribe">
        <?php echo $this->render('_subscribe', ['model' => $model]); ?>

    </div>
</div>





