<?php $this->layout('_auth', ['content' => 'register', 'head' => $head]) ?>

<article class="app-auth-main-form">
    <header class="mb-4">
        <h2 class="app-auth-main-title text-center text-lg-start">Cadastre-se em nossa plataforma</h2>
    </header>
    <form action="<?= url('/register') ?>" method="POST" class="row gy-2 gx-2">
        <div class="col-12">
            <label for="firstName" class="form-label w-100">Primeiro nome:</label>
            <input type="text" name="first_name" class="form-control" id="firstName" placeholder="Informe seu primeiro nome" value="Marcelo">
        </div>
        <div class="col-12">
            <label for="lastName" class="form-label w-100">Último nome:</label>
            <input type="text" name="last_name" class="form-control" id="lastName" placeholder="Informe seu último nome" value="Tomazelli">
        </div>
        <div class="col-12">
            <label for="email" class="form-label w-100">E-mail:</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="Informe seu e-mail" value="marcelotomazelli<?= rand(1,300) ?>@email.com">
        </div>
        <div class="col-md-6">
            <label for="password" class="form-label w-100">Senha:</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="Informe uma senha" value="12345678">
        </div>
        <div class="col-md-6">
            <label for="passwordRe" class="form-label w-100">Confirme a senha:</label>
            <input type="password" name="password_re" class="form-control" id="passwordRe" placeholder="Informe novamente" value="12345678">
        </div>
        <div class="request-message col-12 m-0"></div>
        <div class="col-12 mt-3">
            <button type="submit" class="btn btn-outline-primary">Cadastrar</button>
        </div>
    </form>
</article>
