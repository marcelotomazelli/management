<?= $this->layout('_theme', ['content' => 'profile', 'head' => $head]) ?>

<article class="py-5 py-lg-4">
    <div class="container">
        <header class="by-4">
            <h1 class="display-5">Seu perfil</h1>
        </header>

        <div class="row">
            <div class="col-12">
                <div class="p-3">
                    <form class="row g-3 app-form">
                        <div class="col-12 d-flex jc-center">
                            <input class="form-control d-none" type="file" id="profileImage" data-img-demo="demoProfileImg">
                            <div class="app-profile-image">
                                <label for="profileImage" class="app-profile-image-label">
                                    <img src="<?= shared('/imgs/user.png') ?>" alt="" class="app-profile-image-img" id="demoProfileImg">
                                </label>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 menushow-col-lg-12 menushow-col-xl-6 col-xl-6">
                            <label for="full_name" class="form-label w-100">Nome completo:</label>
                            <input type="text" class="form-control" id="full_name" placeholder="Informe seu nome">
                        </div>
                        <div class="col-12 col-lg-6 menushow-col-lg-12 menushow-col-xl-6 col-xl-6">
                            <label for="email" class="form-label w-100">E-mail:</label>
                            <input type="email" class="form-control" id="email" placeholder="Informe seu e-mail">
                        </div>
                        <div class="col-12 col-sm-6 col-lg-4 menushow-col-lg-6 menushow-col-xl-4">
                            <label for="birthdate" class="form-label w-100">Data de nascimento:</label>
                            <input type="text" class="form-control mask-day" id="birthdate" placeholder="00/00/0000">
                        </div>
                        <div class="col-12 col-sm-6 col-lg-4 menushow-col-lg-6 menushow-col-xl-4">
                            <label for="document" class="form-label w-100">CPF:</label>
                            <input type="text" class="form-control mask-cpf" id="document" placeholder="000.000.000-00">
                        </div>
                        <div class="col-12 mt-4 text-center">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-user-edit me-2"></i>Atualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</article>
