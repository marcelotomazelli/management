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

        let notificationsDropdown = new Dropdown('admin-dropdown-notifications');

        // EVENTS

        $('[data-menu-toggle]').click(toggleMenu);

        return;
    }
});
