$(document).ready(function () {

    // INIT

    let flashAlert = (new Alert('.flash-message'))
        .bounce()
        .close(6);

    // RESOURCES

    let profileDropdown = new Dropdown('app-dropdown-profile', {
        buttonDataName: 'app-dropdown'
    });
    let notificationDropdown = new Dropdown('app-dropdown-notifications', {
        buttonDataName: 'app-dropdown'
    });

    // EVENTS

    $('[data-menu-toggle]').click(toggleMenu);

    $('input[type="file"]').change(imageChange);

    $('form').submit(formAjaxRequest);
});
