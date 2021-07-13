<!DOCTYPE html>
<html lang="pt-br" class="app-auth-html">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= $head->desc ?>">
    <title><?= $head->title ?></title>
    <link rel="shortcut icon" href="<?= shared('/imgs/favicon.ico') ?>">
    <!-- SHARED Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <link rel="stylesheet" href="<?= shared('/styles/bootstrap.css') ?>">

    <!-- APP Auth Styles -->
    <link rel="stylesheet" href="<?= theme('/assets/css/auth.css', CONF_VIEW_APP) ?>">

    <!-- CUSTOM Styles -->
    <style type="text/css">
        @media (min-width: 992px) {
            .app-auth {
                background-image: url('<?= theme("/assets/img/auth-{$content}.png", CONF_VIEW_APP) ?>');
            }
        }
    </style>
</head>
<body class="app-auth <?= "app-auth-{$content}" ?>">
    <main class="app-auth-main">
        <div class="message flash-message">
            <?= $this->insert('widgets::alert', flash_message()) ?>
        </div>
        <div class="app-auth-main-content h-100">
            <?= $this->section('content') ?>
        </div>
    </main>
    <div class="app-auth-footer">
        <div class="app-auth-footer-content">
            <section>
                <header class="app-auth-footer-header">
                    <h2 class="app-auth-footer-title">
                        <span class="sr-only">Plataforma Management</span>
                        <a class="d-flex ai-center" href="<?= url() ?>">
                            <img class="app-auth-footer-brand img-fluid" src="<?= shared('/imgs/brand.png') ?>" alt="Management" title="Management">
                        </a>
                    </h2>
                    <p class="app-auth-footer-desc">Lorem ipsum dolor sit amet consectetur adipisicing, elit. Molestias repudiandae voluptate iste velit autem, magnam laborum quod a natus ipsa eius, nam, minima rerum aut quam neque veritatis. Veritatis, consequuntur!</p>
                </header>

                <article class="app-auth-footer-main">
                    <?php $footerMain = [
                        'signin' => ['Ainda não possui conta?', url('/cadastrar'), 'Cadastrar-se'],
                        'register' => ['Já está cadastrado?', url('/entrar'), 'Entrar'],
                        'recover' => ['Lembrou sua senha?', url('/entrar'), 'Entrar']
                    ][$content] ?>

                    <header>
                        <h3 class="app-auth-footer-ask h6"><?= $footerMain[0] ?></h3>
                    </header>
                    <p class="app-auth-footer-ask-link"><a class="btn btn-primary text-nowrap" href="<?= $footerMain[1] ?>"><?= $footerMain[2] ?></a></p>
                </article>

                <article class="app-auth-footer-social">
                    <ul>
                        <li><a class="app-auth-footer-social-ico" href="<?= CONF_SOCIAL_FACEBOOK ?>" target="_blank" title="Facebook Management"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a class="app-auth-footer-social-ico" href="<?= CONF_SOCIAL_INSTAGRAM ?>" target="_blank" title="Instagram Management"><i class="fab fa-instagram"></i></a></li>
                        <li><a class="app-auth-footer-social-ico" href="<?= CONF_SOCIAL_LINKEDIN ?>" target="_blank" title="LinkedIn Management"><i class="fab fa-linkedin-in"></i></a></li>
                    </ul>
                </article>
            </section>

            <footer class="app-auth-footer-rights">
                <p>Todos os diretos reservados à Management. Dev to <a href="https://linkedin.com/in/marcelotomazelli" target="_blank">Marcelo Tomazelli</a> <i class="fas fa-heart text-primary"></i></p>
            </footer>
        </div>
    </div>

    <?= $this->insert('widgets::loading') ?>

    <?= $this->sharedScripts(['jquery', 'jquery-ui', 'jquery-mask', 'script']) ?>
    <script src="<?= theme('/assets/js/script.js', CONF_VIEW_APP) ?>"></script>
</body>
</html>
