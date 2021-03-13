$(window).on('load', function() {


    $('html').find('#js_form').on('submit', function (e) {
        form = $('html').find('#js_form');
        var $form = $(this);
        e.preventDefault();
        let data = {
            action: 'add_hh_comment',
            name: form.find('input#inputName').val(),
            email: form.find('input#inputEmail').val(),
            comment: form.find('textarea#inputComment').val(),
        };
        console.log(!$form.valid);
        if ($form.valid) return true;
        $.ajax({
            url: myajax['url'],
            type: 'POST',
            data: data,
            success: function (response) {
                $form.trigger('reset');
                $('html').find('.js-no-content').remove();
                $('html').find('.js-card-box').html(response);
            }
        });
    })
});