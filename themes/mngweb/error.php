<?php $this->layout('_theme', ['content' => 'error']) ?>

<article class="web-main-frist">
    <div class="container">
        <div class="py-5 py-lg-10">
            <div class="row">
                <div class="col-12 col-lg-5 d-flex flex-column jc-center">
                    <header class="mb-4">
                        <span class="web-error-code d-block text-center text-lg-start"><?= $error->code ?></span>
                        <h1 class="h6 fw-normal text-center text-lg-start"><?= $error->message ?></h1>
                    </header>
                    <?php if (!empty($error->link) && !empty($error->linkText)): ?>
                        <p class="text-center text-lg-start"><a href="<?= $error->link ?>" class="btn btn-secondary shadow-sm"><?= $error->linkText ?></a></p>
                    <?php endif ?>
                </div>
                <div class="col-10 offset-1 col-lg-6 offset-lg-1 mt-5 mt-lg-0">
                    <img src="<?= theme('/assets/img/error-art.png', CONF_VIEW_WEB) ?>" alt="<?= $error->message ?>" title="<?= $error->message ?>" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</article>
