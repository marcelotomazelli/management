<?php $this->layout('_auth', ['content' => 'register']) ?>

<article class="app-auth-main-form">
    <header class="mb-4">
        <h2 class="app-auth-main-title text-center text-lg-start">Cadastre-se em nossa plataforma</h2>
    </header>
    <form action="#" method="POST" class="row gy-2 gx-2">
        <div class="col-12">
            <label for="fullName" class="form-label w-100">Nome completo:</label>
            <input type="text" name="full_name" class="form-control" id="fullName" placeholder="Informe seu nome">
        </div>
        <div class="col-12">
            <label for="email" class="form-label w-100">E-mail:</label>
            <input type="text" name="email" class="form-control" id="email" placeholder="Informe seu e-mail">
        </div>
        <div class="col-md-6">
            <label for="password" class="form-label w-100">Senha:</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="Informe uma senha">
        </div>
        <div class="col-md-6">
            <label for="passwordRe" class="form-label w-100">Confirme a senha:</label>
            <input type="password" name="password_re" class="form-control" id="passwordRe" placeholder="Informe novamente">
        </div>
        <div class="col-12 mt-3">
            <button type="submit" class="btn btn-outline-primary">Cadastrar</button>
        </div>
    </form>
</article>
