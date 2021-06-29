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

function responseMessage(response, parent) {
    if (response.message != undefined) {
        let message = response.message;

        let alertType = Array();
        alertType['success'] = 'alert-success';
        alertType['info'] = 'alert-primary';
        alertType['warning'] = 'alert-warning';
        alertType['error'] = 'alert-danger';

        let before = '';
        let after = '';

        if (message.before != undefined) {
            before = `<strong>${message.before}</strong>`
        }

        if (message.after != undefined) {
            after = `<strong>${message.after}</strong>`
        }

        parent.find('.request-message').html(`
            <div class="alert ${alertType[message.type]} mt-3" role="alert">
                ${before + message.text + after}
            </div>
        `);

        alertBounce();
    } else if (parent.find('.request-message').html() != '') {
        parent.find('.request-message .alert').hide('fade', {
            duration: 300,
            complete: function () {
                $(this).remove();
            }
        });
    }
}

function responseInvalid(response, parent) {
    if (response.invalid) {
        response.invalid.forEach(function (inputName) {
            let input = parent.find(`[name="${inputName}"]`);
            input.addClass('is-invalid');
            input.focus(() => { input.removeClass('is-invalid') });
        });
    }
}

function formAjaxRequest(selector) {
    let form = $(selector);

    form.submit(function (e) {
        e.preventDefault();
        let loading = new Loading('.app-loading');


        $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            data: form.serialize(),
            beforeSend: () => loading.show(),
            success: function (response) {
                if (response.reload) {
                    location.reload();
                    return;
                }

                if (response.redirect) {
                    window.location.href = response.redirect;
                    return;
                }

                loading.hide();

                responseMessage(response, form);
                responseInvalid(response, form);
            },
            dataType: 'json'
        });
    });
}

function Loading(selector) {
    let loading = $(selector);

    console.log(loading)

    function show() {
        loading.addClass('show');
    }

    function hide() {
        loading.removeClass('show');
    }

    this.show = () => show();
    this.hide = () => hide();
}

// ASSETS

$('.mask-day').mask('00/00/0000');
$('.mask-month').mask('00/0000');
$('.mask-cpf').mask('000.000.000-00');
