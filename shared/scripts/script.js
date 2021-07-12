// CONST

const bsMediaXs = 0;
const bsMediaSm = 576;
const bsMediaMd = 768;
const bsMediaLg = 992;
const bsMediaXl = 1200;
const bsMediaXxl = 1400;

// CLASS

function Alert(containerSelector = '.form-message', parent = undefined) {
    let that = this;
    let container = (parent ? parent.find(containerSelector) : $(containerSelector));
    let buildTimeout, closeTimeout;

    let options = {
        openEffect: 'bounce',
        closeEffect: 'fade',
        closeDelay: 0
    };

    let types = Array();
    types['success'] = 'alert-success';
    types['info'] = 'alert-primary';
    types['warning'] = 'alert-warning';
    types['error'] = 'alert-danger';

    let effects = Array();
    effects['bounce'] = ['effect', { duration: 700 }];
    effects['fade'] = ['toggle', { duration: 200 }];
    effects['drop-right'] = ['toggle', {
        duration: 120,
        direction: 'right'
    }];

    if (alert().length != 0) {
        alertConfig();
    }

    function alert() {
        return container.find('.alert');
    }

    function alertConfig() {
        alert().click(() => { that.close(0) });
    }

    this.options = function (conf = {}) {
        if (conf.openEffect) {
            options.openEffect = (effects[conf.openEffect] ? conf.openEffect : options.openEffect);
        }

        if (conf.closeEffect) {
            options.closeEffect = (effects[conf.closeEffect] ? conf.closeEffect : options.closeEffect);
        }

        options.closeDelay = (conf.closeDelay ? conf.closeDelay : options.closeDelay);

        return that;
    }

    this.build = function (message) {
        type = (types[message.type] ? types[message.type] : types['info']);

        let before = (message.before ? `<strong>${message.before}</strong>` : '');
        let after = (message.after ? `<strong>${message.after}</strong>` : '');

        container.html(`
            <div class="alert ${type}" role="alert">
                ${before + message.text + after}
            </div>
        `);

        alertConfig();

        return that;
    };

    this.open = function () {
        let effectName = options.openEffect;
        let effectType = effects[effectName][0];
        let effectOptions = effects[effectName][1];
        effectOptions.complete = undefined;

        if (effectName.includes('-')) {
            effectName = effectName.substring(0, effectName.indexOf('-'));
        }

        if (effectType == 'effect') {
            alert().effect(effectName, effectOptions);
        } else if (effectType == 'toggle') {
            alert().hide(0, function () {
                $(this).show(effectName, effectOptions);
            });
        }

        return that;
    }

    this.close = function (delay = undefined) {
        clearTimeout(closeTimeout);

        let effectName = options.closeEffect;
        let effectOptions = effects[effectName][1];
        effectOptions.complete = function () {
            $(this).remove()
        };

        if (effectName.includes('-')) {
            effectName = effectName.substring(0, effectName.indexOf('-'));
        }

        delay = (delay == undefined ? options.closeDelay : delay);

        closeTimeout = setTimeout(() => {
            alert().hide(effectName, effectOptions);
        }, delay * 1000);

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

function formAjaxRequest(e, options = {}) {
    e.preventDefault();
    let form = $(e.currentTarget);
    let loading = new Loading('.app-loading');

    let alertFuncs = (new Alert('.form-message', form)).options(options.alert);


    options.alertOpen = (options.alertOpen != undefined ? options.alertOpen : true);
    options.alertClose = (options.alertClose != undefined ? options.alertClose : false);

    let alert = function (message) {
        alertFuncs.build(message).open();

        if (options.alertOpen) {
            alertFuncs;
        }

        if (options.alertClose) {
            alertFuncs.close();
        }
    }

    $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: form.serialize(),
        beforeSend: () => {
            alertFuncs.close(0);
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
                alert(response.message);
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
            alert({
                type: 'error',
                before: 'Erro inesperado ocorreu. ',
                text: 'Verifique os dados ou tente novamente mais tarde'
            });
        },
        dataType: 'json'
    });
}

// ASSETS

$('.mask-day').mask('00/00/0000');
$('.mask-month').mask('00/0000');
$('.mask-cpf').mask('000.000.000-00');
