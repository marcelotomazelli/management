<?php $this->layout('_auth', ['content' => 'recover', 'head' => $head]) ?>

<article class="app-auth-main-form">
    <header class="mb-4">
        <h2 class="app-auth-main-title text-center text-lg-start">Recupere sua senha</h2>
    </header>
    <form action="#" method="POST" class="row gy-2">
        <div class="col-12">
            <label for="email" class="form-label w-100">E-mail:</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="Informe seu e-mail">
        </div>
        <div class="request-message col-12 m-0"></div>
        <div class="col-12 mt-3">
            <button type="submit" class="btn btn-outline-primary">Enviar</button>
        </div>
    </form>
</article>
