$(document).ready(function () {
    let loading = new Loading();

    if ($('.admin-auth-body').length > 0) {

        // INIT

        (new Message('.flash-message', undefined, {
            closeAuto: true,
            closeDelay: 6
        }));

        // RESOURCES

        let authForm = new Request('form', { message: '.form-message', loading });

        // EVENTS

        return;
    }

    if ($('.admin-body').length > 0) {

        // INIT

        if (window.innerWidth > bsMediaLg) {
            $('body').addClass('menu-show');
        }

        // RESOURCES

        let modal = new Modal();
        let message = new Message('.message', undefined, {
            openEffect: false,
            closeAuto: true
        });

        let notificationsDropdown = new Dropdown('admin-dropdown-notifications', {
            buttonDataName: 'app-dropdown'
        });

        let searchForm = new Request('form.admin-form-search', { message, loading });

        // ADMIN USERS

        if ($('.admin-users').length > 0) {
            let userRemove = new Request('[data-request-action]', { loading, message, modal });

            userRemove.onModalBuild(function (modal, current, confirmAction) {
                modal.build(function (title, body, footer, modal) {
                    title.content(`Confirmar remoção`);

                    body.p(`Essa ação <strong>removerá</strong> o usuário <strong>${current.parents('.admin-users-card').find('.admin-users-card-name').html()}</strong> e tudo o que está vinculado à ele de nossos registros.`);
                    body.br();
                    body.p('Por favor confirme está ação para prosseguir:');

                    footer.button({
                        text: 'Confirmar',
                        class: 'primary',
                        action: () => confirmAction()
                    });
                });
            });
        }

        return;
    }
});
