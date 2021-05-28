$(document).ready(function () {
    alertBounce();

    $('input[type="file"]').change(imageChange);
    let profileDropdown = new Dropdown('app-dropdown-profile');
    let notificationDropdown = new Dropdown('app-dropdown-notifications');

    $('[data-menu-toggle]').click(toggleMenu);
});
