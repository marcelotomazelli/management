<?php

namespace Source\Controllers\App;

use Source\Core\Controller as CoreController;
use Source\Models\App\Auth;
use Source\Models\User;

class Controller extends CoreController
{
    /**
     * @var User
     */
    protected $user;

    /**
     * App constructor.
     */
    public function __construct()
    {
        parent::__construct(__DIR__ . '/../../../themes/' . CONF_VIEW_APP . '/');

        $this->user = Auth::user();

        if (empty($this->user)) {
            $this->message->before('Efetue o acesso. ')->warning('É preciso acessar sua conta para entrar no aplicativo')->flash();
            redirect('/entrar');
        }

        $this->view->engine()->addData(['user' => clone $this->user]);
    }
}
