<!DOCTYPE html>
<html lang="pt-br" class="app-html">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= $head->desc ?>">
    <title><?= $head->title ?></title>
    <link rel="shortcut icon" href="<?= shared('/imgs/favicon.ico') ?>">
    <!-- SHARED Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <link rel="stylesheet" href="<?= shared('/styles/bootstrap.css') ?>">

    <!-- APP Styles -->
    <link rel="stylesheet" href="<?= theme('/assets/css/theme.css', CONF_VIEW_APP) ?>">
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
                                        <img class="app-navbar-buttons-profile-img" src="<?= shared('/imgs/user.png') ?>" alt="<?= 'User' ?>" title="<?= 'User' ?>">
                                    </button>
                                    <div id="app-dropdown-profile-menu" class="app-dd-menu
                                                app-dd-pts app-dd-lg-pbe
                                                app-dd-lg-rb">
                                        <div class="app-navbar-dropdown-content">
                                            <div class="app-drop-profile-info">
                                                <div class="app-drop-profile-img-container">
                                                    <a href="<?= url('/app/perfil') ?>" class="app-drop-profile-img-link">
                                                        <img src="<?= shared('/imgs/user.png') ?>" alt="Marcelo" title="Marcelo"
                                                             class="app-drop-profile-img">
                                                    </a>
                                                </div>
                                                <div class="app-drop-profile-name-container">
                                                    <span href="<?= url('/app/perfil') ?>" class="app-drop-profile-name" title="Marcelo Tomazelli">Marcelo</span>
                                                    <span class="app-drop-profile-email" title="marctomazelli@gmail.com">marctomazelli@gmail.com</span>
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
                                            <?php require __DIR__ . '/views/notifications.php'; ?>
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

    <main class="app-main <?= "app-{$content}-main" ?>">
        <?= $this->section('content') ?>
    </main>

    <script src="<?= shared('/scripts/jquery.min.js') ?>"></script>
    <script src="<?= shared('/scripts/jquery-mask.min.js') ?>"></script>
    <script src="<?= shared('/scripts/jquery-ui.min.js') ?>"></script>
    <script src="<?= shared('/scripts/dropdown.min.js') ?>"></script>
    <script src="<?= shared('/scripts/script.js') ?>"></script>
    <script src="<?= theme('/assets/js/script.js', CONF_VIEW_APP) ?>"></script>
</body>
</html>
