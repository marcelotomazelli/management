// CONSTS

const bsMediaXs = 0;
const bsMediaSm = 576;
const bsMediaMd = 768;
const bsMediaLg = 992;
const bsMediaXl = 1200;
const bsMediaXxl = 1400;

// CLASSES

function Request(triggerSelector, resources = {}, options = {}) {

    // CONSTRUCTOR

    let that = this;
    let trigger = $(triggerSelector);

    let message, loading, modal;

    resources = resourcesCorrect(resources);
    options = optionsCorrect(options);

    let modalBuild;

    // FUNCTIONS

    function resourcesCorrect(gross) {
        if (typeof gross != 'object') {
            return {};
        }

        let correct = {};

        // message

        if (typeof gross.message == 'string') {
            let messageParent = (typeof gross.messageParent == 'object' ? gross.messageParent : (trigger.is('form') ? trigger : undefined));

            correct.message = new Message(gross.message, messageParent, gross.messageOptions);
        } else if (typeof gross.message == 'object') {
            correct.message = gross.message;
        }

        if (typeof correct.message == 'object') {
            message = correct.message;
        }

        // loading

        if (typeof gross.loading == 'object') {
            loading = correct.loading = gross.loading;
        }

        // modal

        if (typeof gross.modal == 'string') {
            let modalParent = (typeof gross.modalParent == 'object' ? gross.modalParent : undefined);

            correct.modal = new Modal(gross.modal, modalParent, gross.modalOptions);
        } else if (typeof gross.modal == 'object') {
            correct.modal = gross.modal;
        }

        if (typeof correct.modal == 'object') {
            modal = correct.modal;
        }

        return correct;
    }

    function optionsCorrect(gross) {
        if (typeof gross != 'object') {
            return {};
        }

        let correct = {}

        correct.triggerEvent = (typeof gross.triggerEvent == 'string' ? gross.triggerEvent : (trigger.is('form') ? 'submit' : 'click'))

        return correct;
    }

    function submit(current, params) {
        $.ajax({
            url: params.url,
            type: params.type,
            data: params.data,
            beforeSend: function () {
                if (loading) {
                    loading.show();
                }

                if (message) {
                    message.close(0);
                }

                if (current.is('form')) {
                    current.find('.is-invalid').removeClass('is-invalid');
                }
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

                if (loading) {
                    loading.hide();
                }

                if (message && response.message) {
                    message.open(response.message);
                }

                if (response.invalid) {
                    if (current.is('form')) {
                        response.invalid.forEach(function (inputName) {
                            current.find(`[name="${inputName}"]`)
                                .addClass('is-invalid')
                                .focus(() => { input.removeClass('is-invalid') });
                        });
                    }
                }
            },
            error: function () {
                if (loading) {
                    loading.hide();
                }

                if (message) {
                    message.open({
                        type: 'error',
                        before: 'Erro inesperado ocorreu. ',
                        text: 'Verifique os dados ou tente novamente mais tarde'
                    });
                }
            },
            dataType: 'json'
        });
    }

    // METHODS

    this.onModalBuild = (execute) => {
        modalBuild = (typeof execute == 'function' ? execute : undefined);
        return that;
    }

    // EVENTS

    trigger.on(options.triggerEvent, function (e) {
        e.preventDefault();
        let current = $(e.currentTarget);
        let params = {};

        if (current.is('form')) {
            params.url = current.attr('action');
            params.type = current.attr('method');
            params.data = current.serialize();
        } else {
            params.url = current.data('requestAction');
            params.type = (current.data('requestMethod') ? current.data('requestMethod') : 'POST');
            params.data = current.data('requestData');
        }

        if (modal) {
            modalBuild(modal, current, () => {
                submit(current, params);
                modal.hide();
            });
            modal.show();
        } else {
            submit(current, params);
        }
    });

    // INIT
}

function Message(messageSelector = '.message', parent = undefined, options = {}) {

    // CONSTRUCTOR

    let that = this;
    let message = (typeof parent == 'object' ? parent.find(messageSelector) : $(messageSelector));

    options = optionsCorrect(options);

    let types = Array();
    types['success'] = 'alert-success';
    types['info'] = 'alert-primary';
    types['warning'] = 'alert-warning';
    types['error'] = 'alert-danger';

    let openDelayTimeout, closeClearTimeout, closeDelayTimeout;

    // FUNCTIONS

    function alert() {
        return message.find('.alert');
    }

    function optionsCorrect(gross) {
        if (typeof gross != 'object') {
            gross = {};
        }

        return {
            openEffect: typeof gross.openEffect == 'boolean' ? gross.openEffect : true,
            closeAuto: typeof gross.closeAuto == 'boolean' ? gross.closeAuto : false,
            closeDelay: typeof gross.closeDelay == 'number' ? gross.closeDelay : 6,
        };
    }

    function build(params) {
        type = (types[params.type] ? types[params.type] : types['info']);

        let before = (params.before ? `<strong>${params.before}</strong>` : '');
        let after = (params.after ? `<strong>${params.after}</strong>` : '');

        message.html(`
            <div class="alert ${type}" role="alert">
                ${before + params.text + after}
            </div>
        `);
    }

    function open(params = undefined) {
        if (typeof params == 'object') {
            build(params);
        }

        message.addClass('show');

        if (options.openEffect) {
            alert().effect('bounce', {
                duration: 700
            });
        }

        alert().click(() => { close(0) });
    }

    function close() {
        if (message.hasClass('show')) {
            message.removeClass('show');

            clearTimeout(closeClearTimeout);
            closeClearTimeout = setTimeout(() => {
                message.html('');
            }, 300);
        }
    }

    // METHODS

    this.open = function (params) {
        if (alert().length <= 0) {
            open(params);
        } else {
            clearTimeout(openDelayTimeout);
            openDelayTimeout = setTimeout(() => {
                open(params);
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

    // INIT

    if (alert().length > 0) {
        this.open();
    }
}

function Modal(modalSelector = '.modal', parent = undefined, options = {}) {

    // CONSTRUCTOR

    let that = this;
    let modal = (typeof parent == 'object' ? parent.find(modalSelector) : $(modalSelector));
    let hideExecTimeout;

    let header = {
        el: modal.find('.modal-title'),
        title: html => {
            header.el.html(html);
        },
        clear: () => {
            header.el.html('');
        }
    };

    let body = {
        el: modal.find('.modal-body'),
        content: html => {
            body.el.html(html);
        },
        clear: () => {
            body.el.html('');
        }
    };

    let footer = {
        el: modal.find('.modal-footer'),
        button: params => {
            let button = document.createElement('button');
            button.className = `btn btn-${params.class}`;
            button.innerText = params.text;
            footer.el.append(button);
            button.onclick = () => params.make();
        },
        clear: () => {
            footer.el.html('');
        }
    };

    // FUNCTIONS

    // METHODS

    this.build = function (build) {
        if (typeof build == 'function') {
            header.clear();
            body.clear();
            footer.clear();

            build(header, body, footer, that);
        }

        return that;
    };

    this.show = function () {
        modal.addClass('show');
        return that;
    };

    this.hide = function (execute = undefined) {
        modal.removeClass('show');

        if (typeof execute == 'function') {
            clearTimeout(hideExecTimeout);
            hideExecTimeout = setTimeout(() => {
                execute();
            }, 1000 * 0.3);
        }

        return that;
    };

    // EVENTS

    $('[data-modal-click="close"]').click(function () {
        that.hide();
    });

    // INIT

}

function Loading(loadingSelector = '.app-loading', parent = undefined, options = {}) {

    // CONSTRUCTOR

    let that = this;
    let loading = (typeof parent == 'object' ? parent.find(loadingSelector) : $(loadingSelector));

    // METHODS

    this.show = () => loading.addClass('show');
    this.hide = () => loading.removeClass('show');
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
