<?php $this->layout('_auth', ['content' => 'register']) ?>

<article class="app-auth-main-form">
    <header class="mb-4">
        <h2 class="app-auth-main-title text-center text-lg-start">Cadastre-se em nossa plataforma</h2>
    </header>
    <form action="<?= url('/register') ?>" method="POST" class="row gy-2 gx-2">
        <?= csrf_input() ?>

        <div class="col-12">
            <label for="firstName" class="form-label w-100">Primeiro nome:</label>
            <input type="text" name="first_name" class="form-control" id="firstName" placeholder="Ex: Jairo" required
                   minlength="<?= $userRules->first_name_min_len ?>"
                   maxlength="<?= $userRules->first_name_max_len ?>"
            >
        </div>
        <div class="col-12">
            <label for="lastName" class="form-label w-100">Último nome:</label>
            <input type="text" name="last_name" class="form-control" id="lastName" placeholder="Ex: Pederneiras" required
                   minlength="<?= $userRules->last_name_min_len ?>"
                   maxlength="<?= $userRules->last_name_max_len ?>"
            >
        </div>
        <div class="col-12">
            <label for="email" class="form-label w-100">E-mail:</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="Ex: jairopederneiras@email.com" required
                   maxlength="<?= $userRules->email_max_len ?>"
            >
        </div>
        <div class="col-md-6">
            <label for="password" class="form-label w-100">Senha:</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="••••••••" required
                   minlength="<?= $userRules->password_min_len ?>"
                   maxlength="<?= $userRules->password_max_len ?>"
            >
        </div>
        <div class="col-md-6">
            <label for="passwordRe" class="form-label w-100">Confirme a senha:</label>
            <input type="password" name="password_re" class="form-control" id="passwordRe" placeholder="••••••••" required
                   minlength="<?= $userRules->password_min_len ?>"
                   maxlength="<?= $userRules->password_max_len ?>"
            >
        </div>
        <div class="col-12 m-0">
            <div class="message form-message"></div>
        </div>
        <div class="col-12 mt-3">
            <button type="submit" class="btn btn-outline-primary">Cadastrar</button>
        </div>
    </form>
</article>
