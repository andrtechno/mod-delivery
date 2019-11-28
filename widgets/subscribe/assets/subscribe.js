$(document).on('submit', '#subscribe-form', function () {
    //if (typeof xhr !== 'undefined')
   //     xhr.abort();
    var xhr = $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        data: $(this).serialize(),
        success: function (response) {
           // console.log($('#container-subscribe'));
            $('#container-subscribe').html(response);
           // $('#container-subscribe').html('dsadsa');


           // document.getElementById("container-subscribe").innerHTML = "Hello World!";

        },
        error: function () {
            alert('Error!');
        }
    });
    return false;
});