// CONSTS

const bsMediaXs = 0;
const bsMediaSm = 576;
const bsMediaMd = 768;
const bsMediaLg = 992;
const bsMediaXl = 1200;
const bsMediaXxl = 1400;

// CLASSES

function Form(formSelector, loading, options = {}) {

    // CONSTRUCTOR

    let form = $(formSelector);
    let alert;

    if (typeof options.message == 'object') {
        alert = options.message;
    } else {
        alert = new Alert('.form-message', form, options.alert);
    }

    // FUNCTIONS

    function beforeSend() {
        loading.show();
        alert.close(0);
        form.find('.is-invalid').removeClass('is-invalid');
    }

    function success(response) {
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
            alert.open(response.message);
        }

        if (response.invalid) {
            response.invalid.forEach(function (inputName) {
                let input = form.find(`[name="${inputName}"]`);
                input.addClass('is-invalid');
                input.focus(() => { input.removeClass('is-invalid') });
            });
        }
    }

    function error() {
        loading.hide();
        alert.open({
            type: 'error',
            before: 'Erro inesperado ocorreu. ',
            text: 'Verifique os dados ou tente novamente mais tarde'
        });
    }

    // EVENTS

    form.submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            data: form.serialize(),
            beforeSend,
            success,
            error,
            dataType: 'json'
        });
    });
}

function Loading(selector) {
    let loading = $(selector);

    this.show = () => loading.addClass('show');
    this.hide = () => loading.removeClass('show');
}

function Alert(containerSelector, parent = undefined, options = {}) {
    let that = this;
    let container = (parent ? parent.find(containerSelector) : $(containerSelector));
    let openDelayTimeout, closeClearTimeout, closeDelayTimeout;

    options = config(options);

    let types = Array();
    types['success'] = 'alert-success';
    types['info'] = 'alert-primary';
    types['warning'] = 'alert-warning';
    types['error'] = 'alert-danger';

    function alert() {
        return container.find('.alert');
    }

    function config(conf) {
        if (typeof conf != 'object') {
            conf = {};
        }

        return {
            openEffect: typeof conf.openEffect == 'boolean' ? conf.openEffect : true,
            closeAuto: typeof conf.closeAuto == 'boolean' ? conf.closeAuto : false,
            closeDelay: typeof conf.closeDelay == 'number' ? conf.closeDelay : 0,
        };
    }

    function build(message) {
        type = (types[message.type] ? types[message.type] : types['info']);

        let before = (message.before ? `<strong>${message.before}</strong>` : '');
        let after = (message.after ? `<strong>${message.after}</strong>` : '');

        container.html(`
            <div class="alert ${type}" role="alert">
                ${before + message.text + after}
            </div>
        `);
    }

    function open(message = undefined) {
        if (typeof message == 'object') {
            build(message);
        }

        container.addClass('show');

        if (options.openEffect) {
            alert().effect('bounce', {
                duration: 700
            });
        }

        alert().click(() => { close(0) });
    }

    function close() {
        if (container.hasClass('show')) {
            container.removeClass('show');

            clearTimeout(closeClearTimeout);
            closeClearTimeout = setTimeout(() => {
                container.html('');
            }, 300);
        }
    }

    this.open = function (message) {
        if (alert().length <= 0) {
            open(message);
        } else {
            clearTimeout(openDelayTimeout);
            openDelayTimeout = setTimeout(() => {
                open(message);
            }, 400);
        }

        if (options.closeAuto) {
            that.close();
        }

        return that;
    };

    this.close = function (delay = undefined) {
        delay = (typeof delay == 'number' ? delay : options.closeDelay);

        clearTimeout(closeDelayTimeout);

        if (delay <= 0) {
            close();
        } else {
            closeDelayTimeout = setTimeout(() => {
                close();
            }, delay * 1000);
        }

        return that;
    };

    if (alert().length != 0) {
        this.open();
    }
}

// FUNCTIONS

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

// ASSETS

$('.mask-day').mask('00/00/0000');
$('.mask-month').mask('00/0000');
$('.mask-cpf').mask('000.000.000-00');
