$(document).ready(function () {
    alertBounce();

    if (window.innerWidth >= 992) {
        $('body').addClass('navbarmenu-show');
    }

    $('[data-navbar-toggle]').click(toggleMenu);

    $('input[type="file"]').change(function (e) {
        let input = $(this);
        let file = input[0].files.item(0);

        let reader = new FileReader();
        reader.onload = (e) => {
            let img = $(`#${input.data('imgDemo')}`);
            img.attr('src', e.target.result);
        };

        reader.readAsDataURL(file);
    });

});
