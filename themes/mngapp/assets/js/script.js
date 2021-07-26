$(document).ready(function () {
    let loading = new Loading();

    // AUTH

    if ($('.app-auth').length > 0) {

        // INIT

        (new Message('.flash-message', undefined, {
            closeAuto: true,
            closeDelay: 6
        }));

        // RESOURCES

        let authForm = new Request('.app-auth form', loading);

        // EVENTS

        return;
    }

    // APP

    if ($('.app-body').length > 0) {

        // INIT

        // RESOURCES

        let message = new Message('.message', undefined, {
            openEffect: false,
            closeAuto: true,
            closeDelay: 6
        });

        let profileDropdown = new Dropdown('app-dropdown-profile', {
            buttonDataName: 'app-dropdown'
        });
        let notificationDropdown = new Dropdown('app-dropdown-notifications', {
            buttonDataName: 'app-dropdown'
        });

        if ($('.app-profile') > 0) {
            let profileForm = new Request('.app-profile form', { message, loading });
        }

        // EVENTS

        $('[data-menu-toggle]').click(toggleMenu);

        $('input[type="file"]').change(imageChange);

        return;
    }
});
