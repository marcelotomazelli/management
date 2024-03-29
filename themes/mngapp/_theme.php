<!DOCTYPE html>
<html lang="pt-br" class="app-html">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= $head->desc ?>">
    <title><?= $head->title ?></title>
    <link rel="shortcut icon" href="<?= shared('/imgs/favicon.ico') ?>">
    <!-- APP Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <link rel="stylesheet" href="<?= theme('/assets/css/' . CONF_VIEW_APP_VERSION_CSS . '/styles.min.css', CONF_VIEW_APP) ?>">
    <?= $this->section('styles') ?>

</head>
<body class="app-body <?= "app-{$content}" ?>" data-bs-no-jquery="">
    <header class="app-header">
        <div class="app-header-content">
            <div class="container">
                <nav class="app-navbar-container">
                    <a class="app-navbar-brand" href="<?= url('/app') ?>">
                        <img src="<?= shared('/imgs/brand.png') ?>"
                             alt="Management"
                             title="Management"
                             class="app-navbar-brand-img d-block" height="26">
                    </a>
                    <button class="app-menu-toggle app-navbar-menu-show" data-menu-toggle="show">
                        <i class="app-menu-toggle-ico"></i>
                        <i class="app-menu-toggle-ico"></i>
                        <i class="app-menu-toggle-ico"></i>
                    </button>
                    <div class="app-navbar-menu-container">
                        <div class="app-navbar-menu-back" data-menu-toggle="hide"></div>
                        <div class="app-navbar-menu-field">
                            <div class="app-navbar-buttons">
                                <div id="app-dropdown-profile" class="app-navbar-buttons-item app-dd">
                                    <button class="app-navbar-buttons-item-button" data-app-dropdown="app-dropdown-profile">
                                        <img src="<?= shared('/imgs/user.png') ?>" alt="<?= $user->cutFirstName() ?>" title="<?= $user->cutFirstName() ?>" class="app-navbar-buttons-profile-img">
                                    </button>
                                    <div id="app-dropdown-profile-menu" class="app-dd-menu
                                                app-dd-pts app-dd-lg-pbe
                                                app-dd-lg-rb">
                                        <div class="app-navbar-dropdown-content">
                                            <div class="app-drop-profile-info">
                                                <div class="app-drop-profile-img-container">
                                                    <a href="<?= url('/app/perfil') ?>" class="app-drop-profile-img-link">
                                                        <img src="<?= shared('/imgs/user.png') ?>" alt="<?= $user->cutFirstName() ?>" title="<?= $user->cutFirstName() ?>"
                                                             class="app-drop-profile-img">
                                                    </a>
                                                </div>
                                                <div class="app-drop-profile-name-container">
                                                    <span href="<?= url('/app/perfil') ?>" class="app-drop-profile-name" title="<?= $user->fullName() ?>"><?= $user->cutFirstName() ?></span>
                                                    <span class="app-drop-profile-email" title="<?= $user->email ?>"><?= $user->email ?></span>
                                                </div>
                                            </div>
                                            <ul class="app-drop-profile-actions">
                                                <li class="app-drop-profile-actions-item">
                                                    <a class="app-drop-profile-action app-drop-profile-conf" href="<?= url('/app/perfil') ?>">
                                                        <i class="fas fa-user-cog"></i>
                                                        Perfil
                                                    </a>
                                                </li>
                                                <li class="app-drop-profile-actions-item">
                                                    <a class="app-drop-profile-action app-drop-profile-signout" href="<?= url('/app/sair') ?>">
                                                        <i class="fas fa-sign-out-alt"></i>
                                                        Sair
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div id="app-dropdown-notifications" class="app-navbar-buttons-item app-dd">
                                    <button class="app-navbar-buttons-item-button" data-app-dropdown="app-dropdown-notifications">
                                        <span>
                                            <i class="fas fa-bell"></i>
                                        </span>
                                    </button>
                                    <div id="app-dropdown-notifications-menu" class="app-dd-menu
                                                app-dd-pts app-dd-lg-pbe app-dd-lg-rb">
                                        <div class="app-navbar-dropdown-content">
                                            <?= $this->insert('views/notifications') ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="app-navbar-buttons-item">
                                    <a href="<?= url('/app') ?>" class="app-navbar-buttons-item-button">
                                        <i class="fas fa-question-circle"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="app-navbar-menu">
                                <div class="app-navbar-menu-toggle">
                                    <div class="app-navbar-menu-toggle-content">
                                        <button class="app-menu-toggle" data-menu-toggle="toggle">
                                            <i class="app-menu-toggle-ico up"></i>
                                            <i class="app-menu-toggle-ico"></i>
                                            <i class="app-menu-toggle-ico down"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="app-navbar-list-content">
                                    <ul class="app-navbar-list">
                                        <li class="app-navbar-item">
                                            <a class="app-navbar-link" href="<?= url('/ops') ?>">
                                                <i class="app-navbar-link-icon fas fa-calendar-alt"></i>
                                                <span class="app-navbar-link-name">Cronograma</span>
                                            </a>
                                        </li>
                                        <li class="app-navbar-item">
                                            <a class="app-navbar-link" href="<?= url('/ops') ?>">
                                                <i class="app-navbar-link-icon fas fa-stream"></i>
                                                <span class="app-navbar-link-name">Atividades</span>
                                            </a>
                                        </li>
                                        <li class="app-navbar-item">
                                            <a class="app-navbar-link" href="<?= url('/ops') ?>">
                                                <i class="app-navbar-link-icon fab fa-buffer"></i>
                                                <span class="app-navbar-link-name">Projetos</span>
                                            </a>
                                        </li>
                                        <li class="app-navbar-item">
                                            <a class="app-navbar-link" href="<?= url('/ops') ?>">
                                                <i class="app-navbar-link-icon fas fa-hourglass-half"></i>
                                                <span class="app-navbar-link-name">Urgentes</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </header>

    <main class="app-main <?= "app-{$content}-main" ?> py-5 py-lg-4">
        <?= $this->insert('widgets::message', flash_message()) ?>

        <?= $this->section('content') ?>
    </main>

    <footer class="app-footer-rights">
        <div class="container">
            <p class="app-footer-rights-p">Todos os direitos reservados à Management. Por <a href="https://linkedin.com/in/marcelotomazelli" target="_blank">Marcelo Tomazelli</a> <i class="fas fa-heart text-primary"></i></p>
        </div>
    </footer>

    <?= $this->insert('widgets::loading') ?>

    <script src="<?= theme('/assets/js/' . CONF_VIEW_APP_VERSION_JS . '/scripts.min.js', CONF_VIEW_APP) ?>"></script>
    <?= $this->section('scripts') ?>
</body>
</html>
