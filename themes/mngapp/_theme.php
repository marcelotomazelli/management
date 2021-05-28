<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Esta é a melhor ferramento para gerenciamentos de suas atividades diárias">
    <title>Management - Seu perfil</title>
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
                    <div class="app-navbar-menu-container">
                        <div class="app-navbar-buttons">
                            <div id="app-dropdown-profile" class="app-navbar-buttons-item app-dropdown">
                                <button class="app-navbar-buttons-item-button" data-mng-dropdown="app-dropdown-profile">
                                    <img class="app-navbar-buttons-profile-img" src="<?= shared('/imgs/user.png') ?>" alt="<?= 'User' ?>" title="<?= 'User' ?>">
                                    <!-- <span class="app-navbar-buttons-profile-name">Marcelo</span> -->
                                </button>
                                <div class="app-dropdown-window">
                                    <div class="app-navbar-dropdown-content">
                                        <div>
                                            <div>
                                                <img src="<?= shared('/imgs/user.png') ?>" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="app-dropdown-notifications" class="app-navbar-buttons-item app-dropdown">
                                <button class="app-navbar-buttons-item-button" data-mng-dropdown="app-dropdown-notifications">
                                    <i class="fas fa-bell"></i>
                                </button>
                                <div class="app-dropdown-window">
                                    <div class="app-navbar-dropdown-content">
                                        <?php for ($i = 0; $i < 30; $i++): ?>
                                            <p>Lorem</p>
                                        <?php endfor; ?>
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
                            <div class="app-navbar-menu-back"></div>
                            <div class="app-navbar-menu-content">
                                <div class="app-navbar-menu-toggle">
                                    <button class="app-menu-toggle" data-menu-toggle="toggle">
                                        <i class="app-menu-toggle-ico up"></i>
                                        <i class="app-menu-toggle-ico"></i>
                                        <i class="app-menu-toggle-ico down"></i>
                                    </button>
                                </div>
                                <ul class="app-navbar-menu-list">
                                    <?php
                                    $appPages = [
                                        'fas fa-calendar-alt',
                                        'fas fa-stream',
                                        'fab fa-buffer',
                                        'fas fa-hourglass-half'
                                    ];
                                    foreach($appPages as $icon):
                                    ?>
                                        <li class="app-navbar-menu-item">
                                            <a class="app-navbar-menu-link" href="<?= url('/ops') ?>">
                                                <i class="<?= $icon ?>"></i>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </header>

    <main class="app-main <?= "app-{$content}-main" ?>">
        <?php require __DIR__ . "/{$content}.php" ?>
    </main>

    <script src="<?= shared('/scripts/jquery.min.js') ?>"></script>
    <script src="<?= shared('/scripts/jquery-mask.min.js') ?>"></script>
    <script src="<?= shared('/scripts/jquery-ui.min.js') ?>"></script>
    <script src="<?= shared('/scripts/script.js') ?>"></script>
    <script src="<?= theme('/assets/js/script.js', CONF_VIEW_APP) ?>"></script>
</body>
</html>
