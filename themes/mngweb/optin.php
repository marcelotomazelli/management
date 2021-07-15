<?php $this->layout('_theme', ['content' => 'optin']) ?>

<article class="web-main-first">
    <div class="container">
        <div class="py-5 py-lg-10">
            <p class="h1 text-center fw-normal mb-5"><?= $optin->title ?></p>
            <div class="row">
                <?php if (!empty($optin->image)): ?>
                    <div class="col-10 offset-1 col-md-6 offset-md-3 mb-5">
                        <img src="<?= $optin->image ?>" alt="<?= $optin->title ?>" title="<?= $optin->title ?>" class="img-fluid">
                    </div>
                <?php endif ?>
                <div class="col-12 col-lg-8 offset-lg-2">
                    <p class="text-center"><?= $optin->description ?></p>
                    <?php if (!empty($optin->link) && !empty($optin->linkText)): ?>
                        <p class="text-center"><a href="<?= $optin->link ?>" alt="<?= $optin->linkText ?>" class="btn btn-outline-primary"><?= $optin->linkText ?></a></p>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>
</article>
