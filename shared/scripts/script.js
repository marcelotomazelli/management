// CONSTS

const bsMediaXs = 0;
const bsMediaSm = 576;
const bsMediaMd = 768;
const bsMediaLg = 992;
const bsMediaXl = 1200;
const bsMediaXxl = 1400;

let bodyScroll = function () {

    // CONSTRUCTOR

    let that = this;
    let showTimeout, hideTimeout;
    let body = $('body');

    // FUNCTIONS

    let showMethod = () => {
        body.removeAttr('style');
    };

    let hideMethod = () => {
        if (body[0].style.overflow != '' && body[0].style.paddingRight != '') {
            return;
        }

        let scrollWidth = window.innerWidth - body[0].scrollWidth;
        scrollWidth = (scrollWidth > 0 ? scrollWidth : 0);

        body.css({
            overflow: 'hidden',
            paddingRight: `${scrollWidth}px`
        });
    };

    // INIT

    return {
        show: (delay = 0) => {
            clearTimeout(hideTimeout);

            if (delay <= 0) {
                showMethod();
                return;
            }

            clearTimeout(showTimeout);
            showTimeout = setTimeout(() => {
                showMethod();
            }, 1000 * delay);
        },
        hide: (delay = 0) => {
            clearTimeout(showTimeout);

            if (delay <= 0) {
                hideMethod();
                return;
            }

            clearTimeout(hideTimeout);
            hideTimeout = setTimeout(() => {
                hideMethod();
            }, 1000 * delay);
        }
    };
}();

// CLASSES

function Request(triggerSelector, resources = {}, options = {}) {

    // CONSTRUCTOR

    let that = this;
    let trigger = $(triggerSelector);
    let enabled = true;

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

    this.enable = () => { enabled = true };

    this.disable = () => { enabled = false };

    this.enabled = () => { return enabled };

    this.onModalBuild = (execute) => {
        modalBuild = (typeof execute == 'function' ? execute : undefined);
        return that;
    }

    // EVENTS

    trigger.on(options.triggerEvent, function (e) {
        e.preventDefault();

        if (!enabled) {
            return;
        }

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
                modal.hide(false);
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

    let title = {
        el: modal.find('.modal-title'),
        content: html => {
            title.el.html(title.el.html() + html);
        },
        clear: () => {
            title.el.html('');
        }
    };

    let body = {
        el: modal.find('.modal-body'),
        content: html => {
            body.el.html(body.el.html() + html);
        },
        p: params => {
            let p = document.createElement('p');

            if (typeof params == 'string') {
                p.innerHTML = params;
            } else {
                p.innerHTML = (params.html ? params.html : '');
                p.className = (params.class ? params.class : '');
            }

            body.el.append(p);
            return p;
        },
        br: () => {
            let br = document.createElement('br');
            body.el.append(br);
            return br;
        },
        clear: () => {
            body.el.html('');
        }
    };

    let footer = {
        el: modal.find('.modal-footer'),
        button: (params, form = undefined) => {
            let button = document.createElement('button');
            button.className = `btn btn-${(params.class ? params.class : 'secondary')}`;
            button.innerText = params.text;

            if (!form) {
                footer.el.append(button);
            } else {
                button.type = 'submit';
                form.appendChild(button);
            }

            if (typeof params.action == 'function') {
                $(button).click(() => params.action());
            }

            return button;
        },
        form: params => {
            let form = document.createElement('form');
            form.action = params.action;
            form.method = (params.method ? params.method : 'POST');
            form.className = (params.class ? params.class : '');
            footer.el.append(form);
            return form;
        },
        checked: (params, form) => {
            let div = document.createElement('div');
            div.className = 'form-check' + (params.divClass ? ` ${params.divClass}` : '');

            let input = document.createElement('input');
            input.id = params.id;
            input.type = 'checkbox';
            input.name = params.name;
            input.className = 'form-check-input' + (params.inputClass ? ` ${params.inputClass}` : '');
            div.appendChild(input);

            let label = document.createElement('label');
            label.htmlFor = params.id;
            label.innerText = (params.text ? params.text : '');
            label.className = 'form-check-label' + (params.labelClass ? ` ${params.labelClass}` : '');
            div.appendChild(label);

            form.appendChild(div);

            return input;
        },
        clear: () => {
            footer.el.html('');
        }
    };

    // FUNCTIONS

    // METHODS

    this.build = function (build) {
        if (typeof build == 'function') {
            title.clear();
            body.clear();
            footer.clear();

            build(title, body, footer, that);
        }

        return that;
    };

    this.show = function (hideBodyScroll = true) {
        modal.addClass('show');
        if (hideBodyScroll) {
            bodyScroll.hide();
        }
        return that;
    };

    this.hide = function (showBodyScroll = true) {
        modal.removeClass('show');
        if (showBodyScroll) {
            bodyScroll.show(0.3);
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

    this.show = (hideBodyScroll = true) => {
        loading.addClass('show');
        if (hideBodyScroll) {
            bodyScroll.hide();
        }
    };
    this.hide = (showBodyScroll = true) => {
        loading.removeClass('show');
        if (showBodyScroll) {
            bodyScroll.show(0.3);
        }
    };
}

// FUNCTIONS

function toggleMenu(e, el = undefined) {
    el = $((el ? el : this));
    let type = el.data('menuToggle');
    let body = $('body');
    let show = 'menu-show';

    let windowWidth = window.innerWidth;

    if ((type === 'show' || type === 'toggle') && !body.hasClass(show)) {
        if (windowWidth < bsMediaLg) {
            bodyScroll.hide();
        }

        body.addClass(show);
        return;
    }

    if ((type === 'hide' || type === 'toggle') && body.hasClass(show)) {
        if (windowWidth < bsMediaLg) {
            bodyScroll.show(0.3);
        }

        body.removeClass(show);
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
