// CONST

const bsMediaXs = 0;
const bsMediaSm = 576;
const bsMediaMd = 768;
const bsMediaLg = 992;
const bsMediaXl = 1200;
const bsMediaXxl = 1400;

// CLASS

function Alert(containerSelector = '.request-message', parent = undefined) {
    let that = this;

    function container() {
        let cont = $(containerSelector);

        if (parent != undefined) {
            cont = parent.find(containerSelector);
        }

        return cont;
    }

    function alert() {
        return container().find('.alert');
    }

    this.build = function (message) {
        let alertType = Array();
        alertType['success'] = 'alert-success';
        alertType['info'] = 'alert-primary';
        alertType['warning'] = 'alert-warning';
        alertType['error'] = 'alert-danger';

        let before = '';
        let after = '';

        if (message.before != undefined) {
            before = `<strong>${message.before}</strong>`;
        }

        if (message.after != undefined) {
            after = `<strong>${message.after}</strong>`;
        }

        container().html(`
            <div class="alert ${alertType[message.type]} mt-3" role="alert">
                ${before + message.text + after}
            </div>
        `);

        return that;
    };

    this.bounce = function () {
        alert().effect('bounce', {
            duration: 700
        });

        return that;
    };

    this.close = function (delay) {
        alert().hide('fade', {
            duration: 300,
            complete: function () {
                $(this).remove();
            }
        });

        return that;
    }

}

function Loading(selector) {
    let loading = $(selector);

    function show() {
        loading.addClass('show');
    }

    function hide() {
        loading.removeClass('show');
    }

    this.show = () => show();
    this.hide = () => hide();
}

// FUNCTION

function toggleMenu(e, el = undefined) {
    let type = $((el ? el : this)).data('menuToggle');
    let body = $('body');
    let show = 'menu-show';

    if (type === 'show' && !body.hasClass(show)) {
        body.addClass(show);
        return;
    }
    if (type === 'hide' && body.hasClass(show)) {
        body.removeClass(show);
        return;
    }

    if (type === 'toggle') {
        if (!body.hasClass(show)) {
            body.addClass(show);
        } else {
            body.removeClass(show);
        }
        return;
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

function formAjaxRequest(e) {
    e.preventDefault();
    let form = $(this);
    let loading = new Loading('.app-loading');
    let alert = new Alert('.form-message', form);

    $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: form.serialize(),
        beforeSend: () => {
            alert.close();
            loading.show();

            form.find('.is-invalid').removeClass('is-invalid');
        },
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

            if (response.message) {
                alert.build(response.message).bounce();
            }

            if (response.invalid) {
                response.invalid.forEach(function (inputName) {
                    let input = form.find(`[name="${inputName}"]`);
                    input.addClass('is-invalid');
                    input.focus(() => { input.removeClass('is-invalid') });
                });
            }
        },
        error: () => {
            loading.hide();
            alert.build({
                type: 'error',
                before: 'Erro inesperado ocorreu. ',
                text: 'Verifique os dados ou tente novamente mais tarde'
            }).bounce();
        },
        dataType: 'json'
    });
}

// ASSETS

$('.mask-day').mask('00/00/0000');
$('.mask-month').mask('00/0000');
$('.mask-cpf').mask('000.000.000-00');
