$(document).ready(function () {

    // INIT

    let flashAlert = (new Alert('.flash-message'))
        .options({
            closeEffect: 'drop-right',
            closeDelay: 6
        })
        .open()
        .close();

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

    $('.app-auth form').submit(formAjaxRequest);

    $('.app-body form').submit(function (e) {
        formAjaxRequest(e, {
            alertOpen: true,
            alertClose: true,
            alert: {
                openEffect: 'drop-right',
                closeEffect: 'drop-right',
                closeDelay: 6
            }
        });
    });
});
