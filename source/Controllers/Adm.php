<?php

namespace Source\Controllers;

use Source\Core\Controller;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

use Source\Models\Admin;
use Source\Models\Admin\Auth;
use Source\Models\User;

class Adm extends Controller
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
        parent::__construct(__DIR__ . '/../../themes/' . CONF_VIEW_ADMIN . '/');

        $this->admin = Auth::admin();

        if (!$this->admin) {
            $this->message->before('Efetue o acesso.')->warning(' Para acessar o painel administrativo é necessário acessar sua conta')->flash();
            redirect('/adm/entrar');
        }

        $this->view->engine()->addData(['admin' => clone $this->admin]);
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function users(ServerRequestInterface $request): ResponseInterface
    {
        $this->head(' Admin | Usuários');
        return $this->viewResponse('users', [
            'users' => (new User())
                ->find()
                ->findFetch(true)
        ]);
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function signout(ServerRequestInterface $request): ResponseInterface
    {
        Auth::signout();
        redirect('/');
        return $this->htmlResponse('');
    }
}
