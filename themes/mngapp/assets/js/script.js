$(document).ready(function () {
    let loading = new Loading('.app-loading');

    // AUTH

    if ($('.app-auth').length > 0) {
        // INIT

        (new Alert('.app-auth .flash-message', undefined, { closeAuto: true, closeDelay: 6 }));

        // EVENTS

        let authForm = new Form('form', loading);

        return;
    }

    // APP

    if ($('.app-body').length > 0) {
        // INIT

        let message = (new Alert('.app-body .message', undefined, {
            openEffect: false,
            closeAuto: true,
            closeDelay: 6
        }));

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

        let appForm = new Form('form', loading, { message });

        return;
    }
});
