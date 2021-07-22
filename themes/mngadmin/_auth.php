<!DOCTYPE html>
<html lang="pt-br" class="admin-auth-html">
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
    <link rel="stylesheet" href="<?= theme('/assets/css/auth.css', CONF_VIEW_ADMIN) ?>">
</head>
<body class="admin-auth-body <?= "admin-auth-{$content}" ?>">
    <header class="admin-auth-header">
        <a class="admin-auth-brand" href="<?= url() ?>">
            <img src="<?= shared('/imgs/brand.png') ?>"
                 alt="Management"
                 title="Management"
                 class="admin-auth-brand-img">
        </a>
    </header>
    <main class="admin-auth-main">
        <?= $this->insert('widgets::message', array_merge(flash_message(), ['containerClass' => 'flash-message'])) ?>

        <span class="admin-auth-main-icon">
            <i class="fas fa-user-tie"></i>
        </span>

        <?= $this->section('content'); ?>
    </main>
    <footer class="admin-auth-footer">
        <p class="text-secondary fw-light m-0">Dev to <a href="https://linkedin.com/in/marcelotomazelli">Marcelo Tomazelli</a> <i class="fas fa-heart text-primary"></i></p>
    </footer>

    <?= $this->insert('widgets::loading') ?>

    <?= $this->sharedScripts(['jquery', 'jquery-ui', 'jquery-mask', 'script']); ?>
    <script src="<?= theme('/assets/js/script.js', CONF_VIEW_ADMIN) ?>"></script>
</body>
</html>
