<?php $this->layout('_theme', ['content' => 'users']) ?>

<section>
    <div class="container">
        <div class="row d-flex ai-center mt-4">
            <div class="col-12 col-lg-6 col-xl-7 col-xxl-8">
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
                    col-xxl-4
                 ">
                <form action="<?= url('/adm/users/search') ?>" method="POST" class="w-100 admin-form-search">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Nome, e-mail, registro em..." value="<?= $search ?>">
                        <button type="submit" class="btn btn-dark"><i class="fas fa-search"></i></button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row g-3 mt-2">
            <?php if (!empty($users)): ?>
                <?php foreach ($users as $user): ?>
                    <article class="col-12 col-md-6 col-lg-4 col-xl-6 col-xxl-4">
                        <div class="bg-white rounded-2 p-2 d-flex flex-row admin-users-card">
                            <div class="d-flex ai-center me-2">
                                <img src="<?= shared('/imgs/user.png'); ?>" alt="" title="" class="admin-users-card-img">
                            </div>
                            <div class="flex-grow-1">
                                <header>
                                    <h2 class="m-0 p-0 admin-users-card-name"><?= "{$user->cutFirstName()} {$user->cutLastName()}" ?></h2>
                                </header>
                                <ul class="admin-users-card-list">
                                    <li class="admin-users-card-info admin-users-card-email"><i class="fas fa-envelope"></i><?= $user->email ?></li>
                                    <li class="admin-users-card-info"><i class="fas fa-calendar-alt"></i><?= date_fmt($user->created_at, 'm/Y') ?></li>
                                </ul>
                            </div>
                            <div class="d-flex flex-column jc-around admin-users-card-buttons">
                                <button class="admin-users-card-button admin-users-card-edit" disabled><i class="fas fa-pencil-alt"></i></button>
                                <button class="admin-users-card-button admin-users-card-remove"
                                        data-request-action="<?= url("/adm/user/{$user->id}") ?>"
                                        data-request-data="action=remove"
                                        ><i class="fas fa-trash-alt"></i></button>
                            </div>
                        </div>
                    </article>
                <?php endforeach ?>
            <?php else: ?>
                <p class="border-top text-secondary text-center py-3">
                    Nenhum resultado para a pesquisa: "<strong><?= $search ?></strong>" :/
                </p>
            <?php endif ?>
        </div>
    </div>
</section>
