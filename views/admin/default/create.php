<div class="row">
    <div class="col-lg-7">

        <div id="response-box">
            <?php echo $this->context->renderPartial('form', array('users' => $users, 'delivery' => $delivery, 'model' => $model, 'mails' => $mails)); ?>
        </div>

    </div>


    <div class="col-lg-5">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title" style="padding-right: 15px;">
                    <div class="row">
                        <div class="col-sm-5">
                            <div id="progress-send"></div>
                        </div>
                        <div class="col-sm-7">
                            <div class="progress hidden">
                                <div class="progress-bar progress-bar-success progress-bar-striped progress-bar-animated" style="width:0;"></div>
                            </div>
                        </div>
                    </div>
                </div>
               
            </div>

            <div class="panel-container clearfix" id="sended-result">
   
            </div>
        </div>
    </div>
</div>


