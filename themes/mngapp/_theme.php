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
        <div class="container">
            <nav class="app-navbar-container">
                <a class="app-navbar-brand" href="<?= url() ?>">
                    <img src="<?= shared('/imgs/brand-dark.png') ?>" 
                         alt="Management" 
                         title="Management"
                         class="app-navbar-brand-img">
                </a>
                <button class="app-navbar-toggle" type="button" 
                        data-navbar-toggle="toggle">
                    <i class="app-navbar-toggle-ico up"></i>
                    <i class="app-navbar-toggle-ico"></i>
                    <i class="app-navbar-toggle-ico down"></i>
                </button>
                <div class="app-navbar-menu">
                    <div class="app-navbar-toggle-close">
                        <button class="app-navbar-toggle" type="button" 
                                data-navbar-toggle="close">
                            <i class="app-navbar-toggle-ico up"></i>
                            <i class="app-navbar-toggle-ico"></i>
                            <i class="app-navbar-toggle-ico down"></i>
                        </button>
                    </div>
                    <div class="app-navbar-user">
                        <div class="app-navbar-user-img">
                            <img src="<?= shared('/imgs/user.png') ?>">
                        </div>
                        <div class="app-navbar-user-desc">
                            <p class="app-navbar-user-name">Marcelo</p>
                            <p class="app-navbar-user-tasks">Nada pendente</p>
                        </div>
                    </div>
                    <div class="app-navbar-list-content">
                        <ul class="app-navbar-list">
                            <?php $selected = function ($item) use ($content) {
                                return ($item == $content ? 'active' : '');
                            } ?>

                            <li class="app-navbar-item">
                                <a class="app-navbar-link <?= $selected('dash') ?>" href="<?= url('/app/dash') ?>"><i class="fas fa-chart-pie"></i>Dash</a>
                            </li>
                            <li class="app-navbar-item">
                                <a class="app-navbar-link <?= $selected('activities') ?>" href="<?= url('/app/atividades') ?>"><i class="fas fa-list-ul"></i>Atividades</a>
                            </li>
                            <li class="app-navbar-item">
                                <a class="app-navbar-link <?= $selected('profile') ?>" href="<?= url('/app/perfil') ?>"><i class="fas fa-user"></i>Perfil</a>
                            </li>
                            <li class="app-navbar-item">
                                <a class="app-navbar-link app-navbar-signout" href="<?= url('/app/sair') ?>"><i class="fas fa-sign-out-alt"></i>Sair</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <main class="<?= "app-main app-{$content}-main" ?>">
        <?php require __DIR__ . "/{$content}.php" ?>
    </main>

    <footer class="app-footer-rights">
        <div class="container">
            <p class="m-0 fw-light text-center app-footer-rights-p">Todos os direitos reservados à Management. Dev to <a href="https://linkedin.com/in/marcelotomazelli" target="_blank">Marcelo Tomazelli</a> <i class="fas fa-heart text-primary"></i></p>
        </div>
    </footer>

    <script src="<?= shared('/scripts/jquery.min.js') ?>"></script>
    <script src="<?= shared('/scripts/jquery-mask.min.js') ?>"></script>
    <script src="<?= shared('/scripts/jquery-ui.min.js') ?>"></script>
    <script src="<?= shared('/scripts/script.js') ?>"></script>
    <script src="<?= theme('/assets/js/script.js', CONF_VIEW_APP) ?>"></script>
</body>
</html>
