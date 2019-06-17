<script>


    var tasks = jQuery.unique(<?php echo json_encode($mails) ?>);

    function doTask(taskNum, next, i, num) {
        var time = Math.floor(Math.random() * 3000);
        $('.progress').removeClass('hidden');
        $("#sended-result").prepend('<div id="send-' + i + '" class="col">Подготовка...</div>');
        setTimeout(function () {
            //    console.log(taskNum);

            $.ajax({
                type: "POST",
                url: "/admin/delivery/default/send-mail",
                data: {
                    email: taskNum,
                    text: "<?php echo $model->text ?>",
                    themename: "<?php echo $model->themename ?>"
                },
                success: function () {
                    var result = Math.round((num / tasks.length * 100), 2);
                    $('.progress .progress-bar').css({'width': result + '%'});
                    $("#sended").text(i + 1);
                    $("#send-" + i).html('<i class="icon-check text-success"></i> ' + taskNum);

                    next();
                },
                beforeSend: function () {
                    $("#send-" + i).text("Идет отправка...");
                },
                complate: function () {

                },
                error: function (XHR, textStatus, errorThrown) {
                    $("#send-" + i).text("Error: " + XHR.status + " " + XHR.statusText);
                    //$.jGrowl("Error: " + XHR.status + " " + XHR.statusText, {position: 'top-right', sticky: true});
                }
            });



        }, time)
    }

    function createTask(taskNum, i, num) {
        return function (next) {
            doTask(taskNum, next, i, num);
        }
    }


    $("#progress-send").html("Отправлено: <span id='sended'>0</span> из <span id='total'>" + tasks.length + "</span>");
    for (var i = 0; i < tasks.length; i++) {
        var num = i + 1;
        $(document).queue('tasks', createTask(tasks[i], i, num));
    }

    $(document).queue('tasks', function () {
        console.log("all done");
        // $("#sended-result").prepend("<div><b>Готово!</b></div>");
        $('.progress .progress-bar').removeClass('progress-bar-animated').html('Готово');
    });

    $(document).dequeue('tasks');







</script>
<div>
    <div class="form-group row">
        <div class="col-sm-4"><strong>Тема письма:</strong></div>
        <div class="col-sm-8"><?= $model->themename ?></div>
    </div>
    <div class="form-group row">
        <div class="col-sm-4"><strong>Содержание письма:</strong></div>
        <div class="col-sm-8"><?= $model->text ?></div>
    </div>
    <div class="form-group row">
        <div class="col-sm-4"><strong>Кому отправлять:</strong></div>
        <div class="col-sm-8"><?= $model->from ?></div>
    </div>
</div>


