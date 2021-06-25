// CONST

const bsMediaXs = 0;
const bsMediaSm = 576;
const bsMediaMd = 768;
const bsMediaLg = 992;
const bsMediaXl = 1200;
const bsMediaXxl = 1400;

// FINCTION

function alertBounce() {
    $('.alert').effect('bounce', {
        duration: 700
    });
}

function toggleMenu(e, el = undefined) {
    let type = $((el ? el : this)).data('menuToggle');
    let body = $('body');
    let show = 'menu-show';

    if (type === 'show' && !body.hasClass(show)) {
        body.addClass(show);
    } else if (type === 'hide' && body.hasClass(show)) {
        body.removeClass(show);
    } else if (type === 'toggle') {
        if (!body.hasClass(show)) {
            body.addClass(show);
        } else {
            body.removeClass(show);
        }
    }
}

function imageChange() {
    let input = $(this);

    if (input.data('imgDemo')) {
        let file = input[0].files.item(0);

        let reader = new FileReader();
        reader.onload = function (e) {
            let img = $(`#${input.data('imgDemo')}`);
            img.attr('src', e.target.result);
        };

        reader.readAsDataURL(file);
    }
}

function requestMessage(message) {
    // console.log(message);
    let alertType = Array();
    alertType['success'] = 'alert-danger';
    alertType['info'] = 'alert-primary';
    alertType['warning'] = 'alert-warning';
    alertType['error'] = 'alert-error';

    let before = '';
    let after = '';

    if (message.before != undefined) {
        before = `<strong>${message.before}</strong>`
    }

    if (message.after != undefined) {
        after = `<strong>${message.after}</strong>`
    }

    $('.request-message').html(`
        <div class="alert ${alertType[message.type]} mt-3" role="alert">
            ${before + message.text + after}
        </div>
    `);

    alertBounce();
}

function formRequest(e) {
    e.preventDefault();
    let form = $(this);

    $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: form.serialize(),
        success: function (data) {
            // console.log(data);
        },
        complete: function (jqXHR, textStatus) {
            let data = jqXHR.responseJSON;

            if (data.message) {
                requestMessage(data.message);
            } else if (form.find('.request-message').html() != '') {
                form.find('.request-message .alert').hide('fade', {
                    duration: 300,
                    complete: function () {
                        $(this).remove();
                    }
                });
            }
        },
        dataType: 'json'
    });

}

// ASSETS

$('.mask-day').mask('00/00/0000');
$('.mask-month').mask('00/0000');
$('.mask-cpf').mask('000.000.000-00');
