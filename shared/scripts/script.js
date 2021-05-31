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

// CLASS

function Dropdown(id) {
    // CONTRUCTOR

    if (typeof id != 'string') {
        id = '';
    }

    let dropdown = $(`#${id}`);
    let button = $(`[data-app-dropdown="${id}"]`);

    let showClass = 'show';
    let inside = false;

    let onshow = undefined;
    let onhide = undefined;

    // CONTROL FUNCTIONS

    function show() {
        dropdown.addClass(showClass);

        if (onshow != undefined) {
            onshow();
        }
    }

    function hide() {
        dropdown.removeClass(showClass);

        if (onhide != undefined) {
            onhide();
        }
    }

    // PUBLIC METHODS

    this.setOnshow = (f) => {
        if (onshow == undefined) {
            onshow = f;
        }
    };

    this.setOnhide = (f) => {
        if (onhide == undefined) {
            onhide = f;
        }
    };

    // EVENTS

    button.focus(function () {
        if (!dropdown.hasClass(showClass)) {
            show();
        } else if (!inside && dropdown.hasClass(showClass)) {
            hide();
        }
    });

    button.blur(function () {
        if (!inside) {
            hide();
        }
    });

    dropdown.mouseover(function () {
        inside = true;
    });

    dropdown.mouseleave(function () {
        if (button.is(':focus')) {
            inside = false;
        } else {
            setTimeout(() => {
                hide();
            }, 200);
        }
    });

    $(window).resize(function () {
        hide();
    });
}

// ASSETS

$('.mask-day').mask('00/00/0000');
$('.mask-month').mask('00/0000');
$('.mask-cpf').mask('000.000.000-00');
