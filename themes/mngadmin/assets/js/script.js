$(document).ready(function () {
    let loading = new Loading('.app-loading');

    if ($('.admin-auth-body').length > 0) {

        // INIT

        (new Alert('.flash-message', undefined, { closeAuto: true, closeDelay: 6 }));

        // RESOURCES

        let form = new Form('form', loading);

        // EVENTS

        return;
    }

    if ($('.admin-body').length > 0) {

        // INIT

        let alert = new Alert('.message', undefined, {
            openEffect: false,
            closeAuto: true,
            closeDelay: 6
        });

        if (window.innerWidth > bsMediaLg) {
            $('body').addClass('menu-show');
        }

        // RESOURCES

        let notificationsDropdown = new Dropdown('admin-dropdown-notifications', {
            buttonDataName: 'app-dropdown'
        });

        let action = new Action('[data-action-request]', alert, loading);
        let form = new Form('form', loading, {
            message: alert
        });

        // EVENTS

        $('[data-menu-toggle]').click(toggleMenu);

        return;
    }
});
