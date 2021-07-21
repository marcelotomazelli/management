<?php

namespace Source\Controllers\Adm;

use Source\Core\Controller as CoreController;
use Source\Models\Admin\Auth;
use Source\Models\Admin;

class Controller extends CoreController
{
    /**
     * @var Admin
     */
    protected $admin;

    /**
     * Admin constructor.
     */
    public function __construct()
    {
        parent::__construct(__DIR__ . '/../../../themes/' . CONF_VIEW_ADMIN . '/');

        $this->admin = Auth::admin();

        if (!$this->admin) {
            $this->message->before('Efetue o acesso.')->warning(' Para acessar o painel administrativo é necessário acessar sua conta')->flash();
            redirect('/adm/entrar');
        }

        $this->view->engine()->addData(['admin' => clone $this->admin]);
    }
}
