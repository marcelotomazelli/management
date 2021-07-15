<?php $this->layout('_theme', ['content' => 'home']) ?>

<?php $this->push('styles') ?>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style type="text/css">
        .web-home {
            background-image: url('<?= theme('/assets/img/home-cta.png', CONF_VIEW_WEB) ?>');
        }
    </style>
<?php $this->end() ?>

<article class="web-home-cta web-main-first" id="home">
    <div class="container">
        <div class="web-home-cta-container">
            <div class="row d-flex ai-center">
                <div class="col-lg-7">
                    <header class="mb-5">
                        <h1 class="display-5 text-light text-center text-lg-start"
                            data-aos="fade-up" data-aos-delay="500">
                            Essa plataforma te auxilia no gerenciamento de suas atividades diárias
                        </h1>
                        <p class="text-secondary py-3 text-center text-lg-start"
                           data-aos="fade-up" data-aos-delay="600" date-aos-duration="1000">
                            Lorem ipsum dolor sit amet consectetur adipisicing, elit. Quo reiciendis unde officia repudiandae nobis eos officiis autem nesciunt, culpa, ipsa nisi vel tempore.
                        </p>
                    </header>
                    <p class="text-center text-lg-start"
                       data-aos="fade-up" data-aos-delay="600" data-aos-duration="1200">
                       <a href="#plataforma" class="btn btn-primary btn-lg fw-light" data-section="plataforma">Saiba mais</a>
                    </p>
                </div>
                <div class="web-home-cta-illustration col-5 d-none d-lg-flex ai-center">
                    <img class="img-fluid"
                         src="<?= theme('/assets/img/home-cta-illustration.png', CONF_VIEW_WEB) ?>" alt="Gerencie suas atividades" title="Gerencie suas atividades"
                         data-aos="zoom-out-right" data-aos-delay="500">
                </div>
            </div>
        </div>
    </div>
</article>

<section class="bg-glass" id="plataforma">
    <div class="container">
        <div class="web-home-section">
            <header class="mb-5">
                <h1 class="display-5">O que é a Management</h1>
            </header>

            <div class="row">
                <div class="col-5 col-xl-6 d-none d-lg-flex ai-center">
                    <img src="<?= theme('/assets/img/home-platform.png', CONF_VIEW_WEB) ?>" alt="" class="img-fluid">
                </div>
                <div class="col-12 col-lg-7 col-xl-6 d-flex ai-center">
                    <div class="container">
                        <div class="row web-home-platform-cards">
                            <article class="col-12 web-home-platform-card-container">
                                <div class="web-home-platform-card" data-aos="fade-down">
                                    <div class="web-home-platform-card-img">
                                        <img src="<?= theme('/assets/img/easy.png', CONF_VIEW_WEB) ?>" alt="" class="">
                                    </div>
                                    <div>
                                        <header>
                                            <h2 class="h3 web-home-platform-card-title">Lorem ipsum</h2>
                                        </header>
                                        <p class="small">In quibusdam quam doloremque, voluptas. Voluptatibus culpa, minus, optio nihil nulla soluta omnis rem. Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus exercitationem in corporis accusantium cum minima blanditiis.</p>
                                    </div>
                                </div>
                            </article>
                            <article class="col-12 col-sm-6 web-home-platform-card-container">
                                <div class="web-home-platform-card" data-aos="fade-up" data-aos-delay="200">
                                    <div class="web-home-platform-card-img">
                                        <img src="<?= theme('/assets/img/fast.png', CONF_VIEW_WEB) ?>" alt="" class="">
                                    </div>
                                    <div>
                                        <header>
                                            <h2 class="h3 web-home-platform-card-title">Magnam similique</h2>
                                        </header>
                                        <p class="small">Officiis magni omnis cupiditate, quam ratione commodi porro numquam sed eveniet similique ullam dolor voluptate.</p>
                                    </div>
                                </div>
                            </article>
                            <article class="col-12 col-sm-6 web-home-platform-card-container">
                                <div class="web-home-platform-card" data-aos="fade-up" data-aos-delay="400">
                                    <div class="web-home-platform-card-img">
                                        <img src="<?= theme('/assets/img/genius.png', CONF_VIEW_WEB) ?>" alt="" class="">
                                    </div>
                                    <div>
                                        <header>
                                            <h2 class="h3 web-home-platform-card-title">Adipisicing elit</h2>
                                        </header>
                                        <p class="small">Ratione quam nobis recusandae deleniti ea eligendi, repudiandae, rem accusamus earum nam ab quis, libero quia.</p>
                                    </div>
                                </div>
                            </article>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<article class="bg-light" id="contato">
    <div class="container">
        <div class="web-home-section">
            <header class="mb-5">
                <h1 class="text-center display-5">Entre em contato conosco</h1>
            </header>
            <div class="row">
                <div class="col-12 col-md-8 offset-xl-1 col-lg-7 col-xl-6 mb-3 mb-md-0"
                data-aos="fade-up">
                    <form action="#" class="row g-3">
                        <div class="col-12 col-md-6">
                            <label for="contactName" class="small">Seu nome:</label>
                            <input type="text" name="name" id="contactName" class="form-control" placeholder="Informe seu nome">
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="contactEmail" class="small">Seu email:</label>
                            <input type="email" name="name" id="contactEmail" class="form-control" placeholder="Informe seu email">
                        </div>
                        <div class="col-12">
                            <label for="contactMessage" class="small">Mensagem:</label>
                            <textarea name="name" id="contactMessage" class="form-control" cols="30" rows="9"></textarea>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-outline-primary">Enviar</button>
                        </div>
                    </form>
                </div>
                <div class="col-12 offset-lg-1 col-md-4 col-xl-3" data-aos="fade-down">
                    <article>
                        <header class="mb-3">
                            <h2 class="h4">Informações para contato</h2>
                        </header>
                        <ul class="web-home-contact-info">
                            <li><a href="#" target="_blank"><i class="fas fa-envelope"></i>management@email.com</a></li>
                            <li><a href="#" target="_blank"><i class="fas fa-map-marker-alt"></i>Rua Lorem ipsum dolor sit amet, 99</a></li>
                            <li><a href="#" target="_blank"><i class="fas fa-phone-alt"></i>+55 99902-2930</a></li>
                            <li><a href="#" target="_blank"><i class="fas fa-phone-alt"></i>+55 99239-9837</a></li>
                        </ul>
                    </article>
                </div>
            </div>
        </div>
    </div>
</article>

<?php $this->unshift('scripts'); ?>
    <script src="<?= shared('/scripts/aos.min.js') ?>"></script>
    <script>
        AOS.init({
            easing: 'ease-out-back',
            duration: 800,
            once: true
        });
    </script>
<?php $this->end(); ?>

