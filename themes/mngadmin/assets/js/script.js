$(document).ready(function () {

    // INIT

    let flashAlert = (new Alert('.flash-message')).bounce();

    setTimeout(() => {
        flashAlert.close();
    }, 4200);

    if (window.innerWidth > bsMediaLg) {
        $('body').addClass('menu-show');
    }

    // RESOURCES

    let notificationsDropdown = new Dropdown('admin-dropdown-notifications');

    // EVENTS

    $('[data-menu-toggle]').click(toggleMenu);
    $('input[type="file"]').change(imageChange);
});
