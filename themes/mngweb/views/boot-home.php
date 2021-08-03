<?php $arrowDown = function () { ?>
    <div class="h2 text-center text-primary my-4">
        <i class="fas fa-chevron-down"></i>
    </div>
<?php } ?>

<p>Essa aplicação é um projeto de portfólio para demonstrar habilidades no front-end e back-end. Foi desenvolvida interamente por Marcelo Tomazelli.</p>
<p>Detalhes técnicos estão no <a href="https://github.com/marcelotomazelli/management" target="_blank">repositório no github</a>.</p>

<?php $arrowDown() ?>

<p class="h4 my-3"><i class="fas fa-layer-group"></i> Aplicativo</p>

<p>Ao se <a href="<?= url('/cadastrar') ?>">cadastrar</a> e <a href="<?= url('/entrar') ?>">entrar</a> na plataforma você terá acesso ao app, lá está disponível a funcionalidade de editar os dados do usuário, como nome, data de nascimento e documento.</p>

<p>Obs: o campo para selecionar foto é apenas para amostra.</p>

<?= $this->insert('widgets::message', ['message' => (object) ['type' => 'warning', 'text' => 'Por favor não informe e-mail ou números reais'], 'containerClass' => 'message-static mt-3']) ?>

<?php $arrowDown() ?>

<p class="h4 my-3"><i class="fas fa-user-tie"></i> Administrativo</p>

<p>No painel administrativo é possível pesquisar e remover usuários testes. Para <a href="<?= url('/adm/entrar') ?>" target="_blank">acessa-lo</a>, deve ser utilizado o mesmo e-mail e senha do aplicativo.</p>
