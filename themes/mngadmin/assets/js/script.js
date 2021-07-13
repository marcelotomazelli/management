$(document).ready(function () {

    // INIT

    if (window.innerWidth > bsMediaLg) {
        $('body').addClass('menu-show');
    }

    // RESOURCES

    let notificationsDropdown = new Dropdown('admin-dropdown-notifications');

    // EVENTS

    $('[data-menu-toggle]').click(toggleMenu);
    $('input[type="file"]').change(imageChange);
});
