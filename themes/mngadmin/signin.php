<?php $this->layout('_auth', ['content' => 'signin']); ?>

<article class="admin-auth-main-form">
    <div class="admin-auth-main-form-content">
        <header class="mb-5">
            <h1 class="display-5 text-center">Acesse o administrativo</h1>
        </header>
        <form action="<?= url('/adm/signin') ?>" method="POST" class="row gy-2">
            <?= csrf_input() ?>

            <div class="col-12 mt-0">
                <label for="email" class="form-label w-100">E-mail:</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Informe seu e-mail" required>
            </div>
            <div class="col-12">
                <label for="password" class="form-label w-100">Senha:</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="••••••••" required>
            </div>
            <div class="col-12 m-0">
                <?= $this->insert('widgets::message', ['containerClass' => 'form-message']) ?>
            </div>
            <div class="col-12 mt-3 d-flex jc-center">
                <button type="submit" class="btn btn-primary">Entrar</button>
            </div>
        </form>
    </div>
</article>
