<div class="row">
    <div class="col-lg-7">
        <div class="card">
            <div class="card-header">
            </div>
            <div class="card-body">
                <div id="response-box">
                    <?php echo $this->render('_form', [
                        'users' => $users,
                        'delivery' => $delivery,
                        'model' => $model,
                        'mails' => $mails
                    ]); ?>
                </div>
            </div>
        </div>
    </div>


    <div class="col-lg-5">
        <div class="card">
            <div class="card-header">
                <div class="card-title" style="padding-right: 15px;">
                    <div class="row">
                        <div class="col-sm-5">
                            <div id="progress-send"></div>
                        </div>
                        <div class="col-sm-7">
                            <div class="progress">
                                <div class="progress-bar progress-bar-success progress-bar-striped progress-bar-animated"
                                     style="width:0;"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="card-body panel-container clearfix" id="sended-result">

            </div>
        </div>
    </div>
</div>


