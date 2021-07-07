<?php $this->layout('_auth', ['content' => 'signin', 'head' => $head]) ?>

<article class="app-auth-main-form">
    <header class="mb-4">
        <h2 class="app-auth-main-title text-center text-lg-start">Acesse nossa plataforma</h2>
    </header>
    <form action="<?= url('/signin') ?>" method="POST" class="row gy-2">
        <div class="col-12">
            <label for="email" class="form-label w-100">E-mail:</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="Informe seu e-mail" required value="<?= (!empty($data['email']) ? $data['email'] : '') ?>">
        </div>
        <div class="col-12">
            <div class="d-flex ai-baseline jc-between">
                <label for="password" class="form-label w-100">Senha:</label>
                <a class="app-auth-signin-recover small text-nowrap" href="<?= url('/recuperar') ?>">Esqueceu a senha?</a>
            </div>
            <input type="password" name="password" class="form-control" id="password" placeholder="••••••••" required>
        </div>
        <div class="form-message col-12 m-0"></div>
        <div class="col-12 mt-3 d-flex ai-center jc-between">
            <button type="submit" class="btn btn-outline-primary">Entrar</button>
            <div class="form-check ms-3">
                <input class="form-check-input" type="checkbox" name="save" id="saveData" <?= (!empty($data['email']) ? 'checked' : '') ?>>
                <label class="form-check-label" for="saveData">
                    Lembra os dados?
                </label>
            </div>
        </div>
    </form>
</article>
