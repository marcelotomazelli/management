<!DOCTYPE html>
<html lang="pt-br" class="web-html">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Esta é a melhor ferramento para gerenciamentos de suas atividades diárias">
    <title>Management - Gerencie suas atividades</title>
    <link rel="shortcut icon" href="<?= shared('/imgs/favicon.ico') ?>">
    <!-- SHARED Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <link rel="stylesheet" href="<?= shared('/styles/bootstrap.css') ?>">

    <!-- WEB Styles -->
    <link rel="stylesheet" href="<?= theme('/assets/css/style.css', CONF_VIEW_WEB) ?>">

    <!-- CUSTOM Styles -->
    <?php if ($content == 'home'): ?>
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <style type="text/css">
            .web-home {
                background-image: url('<?= theme('/assets/img/home-cta.png', CONF_VIEW_WEB) ?>');
            }
        </style>
    <?php endif; ?>
</head>
<body class="web-body <?= "web-{$content}" ?>" data-bs-no-jquery="">
    <header class="web-header">
        <div class="container">
            <nav class="web-navbar-container">
                <a class="web-navbar-brand" href="<?= url() ?>">
                    <img src="<?= shared('/imgs/brand.png') ?>"
                         alt="Management"
                         title="Management"
                         class="web-navbar-brand-img">

                </a>
                <button class="app-menu-toggle web-navbar-toggle-show" data-menu-toggle="show">
                    <i class="app-menu-toggle-ico"></i>
                    <i class="app-menu-toggle-ico"></i>
                    <i class="app-menu-toggle-ico"></i>
                </button>
                <div class="web-navbar-menu-container">
                    <div class="web-navbar-menu-back" data-menu-toggle="hide"></div>
                    <div class="web-navbar-menu">
                        <div class="web-navbar-toggle-hide">
                            <button class="app-menu-toggle" data-menu-toggle="hide">
                                <i class="app-menu-toggle-ico up"></i>
                                <i class="app-menu-toggle-ico down"></i>
                            </button>
                        </div>
                        <div class="web-navbar-list-content">
                            <ul class="web-navbar-list web-navbar-menu-pages">
                                <li class="web-navbar-item">
                                    <a href="<?= url('/#home') ?>" data-menu-toggle="hide"
                                    class="web-navbar-link link-pd active"
                                    data-section="home">
                                        Home
                                    </a>
                                </li>
                                <li class="web-navbar-item">
                                    <a href="<?= url('/#plataforma') ?>" data-menu-toggle="hide"
                                    class="web-navbar-link link-pd"
                                    data-section="plataforma">
                                        Plataforma
                                    </a>
                                </li>
                                <li class="web-navbar-item">
                                    <a href="<?= url('/#contato') ?>" data-menu-toggle="hide"
                                    class="web-navbar-link link-pd"
                                    data-section="contato">
                                        Contato
                                    </a>
                                </li>
                            </ul>
                            <?php if (false): ?>
                                <ul class="web-navbar-list web-navbar-menu-user">
                                    <li class="web-navbar-item"><a class="web-navbar-link web-navbar-signin link-pd" href="<?= url('/entrar') ?>">Entrar</a></li>
                                    <li class="web-navbar-item"><a class="web-navbar-link web-navbar-register link-pd" href="<?= url('/cadastrar') ?>">Cadastro</a></li>
                                </ul>
                            <?php else: ?>
                                <ul class="web-navbar-list web-navbar-menu-user">
                                    <li class="web-navbar-item">
                                        <a href="<?= url('/app') ?>" class="web-navbar-logged">
                                            <img src="<?= shared('/imgs/user.png') ?>" class="web-navbar-logged-image">
                                            <span class="web-navbar-logged-name">Marcelo</span>
                                        </a>
                                    </li>
                                </ul>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <main class="<?= "web-main web-{$content}-main" ?>">
        <?php require __DIR__ . "/{$content}.php" ?>
    </main>

    <section class="web-footer">
        <div class="container">
            <div class="web-footer-content">
                <header class="mb-5">
                    <h1 class="text-light">Quer saber mais?</h1>
                </header>

                <div class="row">
                    <article class="col-12 col-md-6 col-xl-5 mb-3 mb-md-0">
                        <header>
                            <h2 class="h3 text-light fw-normal">A Management</h2>
                        </header>
                        <p class="text-secondary small">Lorem ipsum dolor, sit amet consectetur, adipisicing elit. Accusamus officia deleniti harum possimus ex, quod nemo expedita labore et qui sunt cum quibusdam quisquam hic, beatae enim fuga aut nesciunt? Lorem, ipsum dolor sit amet consectetur adipisicing elit.</p>
                    </article>

                    <article class="col-6 col-md-3 offset-xl-1">
                        <header>
                            <h2 class="h3 text-light fw-normal">Links Úteis</h2>
                        </header>
                        <ul class="web-footer-list">
                            <li class="web-footer-item"><a href="#">Política de Privacidade</a></li>
                            <li class="web-footer-item"><a href="#">Aviso Legal</a></li>
                            <li class="web-footer-item"><a href="#">Termos de Uso</a></li>
                        </ul>
                    </article>


                    <article class="col-6 col-md-3">
                        <header>
                            <h2 class="h3 text-light fw-normal">Redes Sociais</h2>
                        </header>
                        <ul class="web-footer-list">
                            <li class="web-footer-item"><a href="<?= CONF_SOCIAL_INSTAGRAM ?>" target="_blank"><i class="fab fa-instagram"></i>@management</a></li>
                            <li class="web-footer-item"><a href="<?= CONF_SOCIAL_FACEBOOK ?>" target="_blank"><i class="fab fa-facebook"></i>/management</a></li>
                            <li class="web-footer-item"><a href="<?= CONF_SOCIAL_LINKEDIN ?>" target="_blank"><i class="fab fa-linkedin"></i>/management</a></li>
                        </ul>
                    </article>
                </div>
            </div>
        </div>
    </section>

    <footer class="web-footer-rights">
        <div class="container">
            <p class="m-0 text-secondary fw-light text-center">Todos os direitos reservados à Management. Dev to <a href="https://linkedin.com/in/marcelotomazelli" target="_blank">Marcelo Tomazelli</a> <i class="fas fa-heart text-primary"></i></p>
        </div>
    </footer>

    <script src="<?= shared('/scripts/jquery.min.js') ?>"></script>
    <script src="<?= shared('/scripts/jquery-ui.min.js') ?>"></script>
    <script src="<?= shared('/scripts/jquery-mask.min.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <script src="<?= shared('/scripts/script.js') ?>"></script>
    <script src="<?= theme('/assets/js/script.js', CONF_VIEW_WEB) ?>"></script>

    <? if ($content == 'home'): ?>
        <script src="<?= shared('/scripts/aos.min.js') ?>"></script>
        <script>
            AOS.init({
                easing: 'ease-out-back',
                duration: 800,
                once: true
            });
        </script>
    <? endif; ?>
</body>
</html>
