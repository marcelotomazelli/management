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
    <link rel="stylesheet" href="<?= theme('/assets/css/theme.css', CONF_VIEW_ADMIN) ?>">
</head>
<body class="admin-body <?= "admin-{$content}" ?>" data-bs-no-jquery="">
    <header class="admin-header">
        <div class="container">
            <nav class="admin-navbar-container">
                <a class="admin-navbar-brand" href="<?= url() ?>">
                    <img src="<?= shared('/imgs/brand-dark.png') ?>" 
                         alt="Management" 
                         title="Management"
                         class="admin-navbar-brand-img">
                </a>
                <button class="app-menu-toggle app-menu-toggle-dark" data-menu-toggle="toggle">
                    <i class="app-menu-toggle-ico up"></i>
                    <i class="app-menu-toggle-ico"></i>
                    <i class="app-menu-toggle-ico down"></i>
                </button>
                <div class="admin-navbar-menu">
                    <div class="admin-navbar-toggle-close">
                        <button class="app-menu-toggle" data-menu-toggle="hide">
                            <i class="app-menu-toggle-ico up"></i>
                            <i class="app-menu-toggle-ico down"></i>
                        </button>
                    </div>
                    <div class="admin-navbar-user">
                        <div class="admin-navbar-user-img">
                            <img src="<?= shared('/imgs/user.png') ?>">
                        </div>
                        <div class="admin-navbar-user-desc">
                            <p class="admin-navbar-user-name">Marcelo</p>
                            <p class="admin-navbar-user-tasks">Nada pendente</p>
                        </div>
                    </div>
                    <div class="admin-navbar-list-content">
                        <ul class="admin-navbar-list">
                            <?php $selected = function ($item) use ($content) {
                                return ($item == $content ? 'active' : '');
                            } ?>

                            <li class="admin-navbar-item">
                                <a class="admin-navbar-link <?= $selected('dash') ?>" href="<?= url('/admin/dash') ?>"><i class="fas fa-chart-pie"></i>Dashboard</a>
                            </li>
                            <li class="admin-navbar-item">
                                <a class="admin-navbar-link <?= $selected('signatures') ?>" href="<?= url('/admin/assinaturas') ?>"><i class="fas fa-credit-card"></i>Assinaturas</a>
                            </li>
                            <li class="admin-navbar-item">
                                <a class="admin-navbar-link <?= $selected('users') ?>" href="<?= url('/admin/usuarios') ?>"><i class="fas fa-users"></i>Usuários</a>
                            </li>
                            <li class="admin-navbar-item">
                                <a class="admin-navbar-link admin-navbar-signout" href="<?= url('/admin/sair') ?>"><i class="fas fa-sign-out-alt"></i>Sair</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <main class="<?= "admin-main admin-{$content}-main" ?>">
        <?php require __DIR__ . "/{$content}.php" ?>
    </main>

    <script src="<?= shared('/scripts/jquery.min.js') ?>"></script>
    <script src="<?= shared('/scripts/jquery-mask.min.js') ?>"></script>
    <script src="<?= shared('/scripts/jquery-ui.min.js') ?>"></script>
    <script src="<?= shared('/scripts/script.js') ?>"></script>
    <script src="<?= theme('/assets/js/script.js', CONF_VIEW_ADMIN) ?>"></script>
</body>
</html>
