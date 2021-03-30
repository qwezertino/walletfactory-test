$( document ).ready(function() {
    console.log('test');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#form').on('submit', function (event) {
        event.preventDefault();
        var email = $('#email').val();
        var date = $('#date').val();
        var text = $('#text').val();

        $.ajax({
            type: "POST",
            url: 'api/test/form',
            data: {email: email, date: date, text: text},
            dataType: 'json',
            success: function (response) {
                console.log(response.message);
               $('div.response').text(response.message);

            },
            error: function (response) {
                console.log('ERROR' + response);
                $('div.response').text('Validation failed!');
            }
        });
    });
});

