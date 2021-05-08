$('.mask-day').mask('00/00/0000');
$('.mask-month').mask('00/0000');
$('.mask-cpf').mask('000.000.000-00');

function alertBounce() {
    $('.alert').effect('bounce', {
        duration: 700
    });
}

function toggleMenu(e, el = undefined) {
    let type = $((!el ? this : el)).data('navbarToggle');
    let body = $('body');
    let show = 'navbarmenu-show';

    if (type === 'open' && !body.hasClass(show)) {
        body.addClass(show);
    } else if (type === 'close' && body.hasClass(show)) {
        body.removeClass(show);
    } else if (type === 'toggle') {
        if (!body.hasClass(show)) {
            body.addClass(show);
        } else {
            body.removeClass(show);
        }
    }
}
