$(document).ready(function () {
    alertBounce();

    let profileDropdown = new Dropdown('app-dropdown-profile', {
        buttonDataName: 'app-dropdown'
    });
    let notificationDropdown = new Dropdown('app-dropdown-notifications', {
        buttonDataName: 'app-dropdown'
    });

    $('[data-menu-toggle]').click(toggleMenu);

    $('input[type="file"]').change(imageChange);

    $('.app-auth form').submit(formRequest);
});
