$(document).on('submit', '#subscribe-form', function () {
    //if (typeof xhr !== 'undefined')
    //     xhr.abort();
    var xhr = $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        data: $(this).serialize(),
        success: function (response) {
            var resp = jQuery.parseJSON(response);
            if (typeof resp === 'object') {
                // It is JSON
            } else {
                $('#container-subscribe').html(response);
            }

        },
        error: function () {
            alert('Error!');
        }
    });
    return false;
});