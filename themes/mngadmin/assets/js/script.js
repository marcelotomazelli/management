$(document).ready(function () {
    alertBounce();

    if (window.innerWidth > bsMediaLg) {
        $('body').addClass('menu-show');
    }

    $('[data-menu-toggle]').click(toggleMenu);
    $('input[type="file"]').change(imageChange);

    let notificationsDropdown = new Dropdown('admin-dropdown-notifications');
});
