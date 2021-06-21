<section>
    <div class="container">
        <div class="row d-flex ai-center mt-4">
            <div class="
                    col-12
                    col-lg-6
                    col-xl-7
                    ms-col-xxl-8 col-xxl-8
                 ">
                <header>
                    <h1 class="display-5">Usuários</h1>
                </header>
            </div>
            <div class="
                    mt-4 mt-lg-0
                    col-12
                    offset-sm-1 col-sm-10
                    offset-lg-0 col-lg-6
                    col-xl-5
                    ms-col-xxl-4 col-xxl-4
                 ">
                <form action="#" class="w-100">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Nome, e-mail, registro..." aria-label="Nome, e-mail, registro..." aria-describedby="button-addon2">
                        <button class="btn btn-dark" type="button" id="button-addon2"><i class="fas fa-search"></i></button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row g-3 mt-2">
            <?php for ($i = 0; $i < 10; $i++): ?>
                <article class="col-12 col-md-6 ms-col-lg-6 col-lg-4 ms-col-xl-6 col-xl-6 ms-col-xxl-4 col-xxl-4">
                    <div class="bg-white rounded-2 p-2 d-flex flex-row admin-users-card">
                        <div class="d-flex ai-center me-2">
                            <img src="<?= shared('/imgs/user.png'); ?>" alt="" title="" class="admin-users-card-img">
                        </div>
                        <div class="flex-grow-1">
                            <header>
                                <h2 class="m-0 p-0 admin-users-card-name">Marcelo Tomazelli<?= $i ?></h2>
                            </header>
                            <ul class="admin-users-card-list">
                                <li class="admin-users-card-info admin-users-card-email"><i class="fas fa-envelope"></i>marctomazelli@gmail.com</li>
                                <li class="admin-users-card-info"><i class="fas fa-calendar-alt"></i>0<?= rand(1,9) ?>/20<?= rand(19,21) ?></li>
                            </ul>
                        </div>
                        <div class="d-flex flex-column jc-around admin-users-card-buttons">
                            <button class="admin-users-card-button admin-users-card-edit"><i class="fas fa-pencil-alt"></i></button>
                            <button class="admin-users-card-button admin-users-card-remove"><i class="fas fa-trash-alt"></i></button>
                        </div>
                    </div>
                </article>
            <?php endfor; ?>
        </div>
    </div>
</section>
