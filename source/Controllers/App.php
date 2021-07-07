<?php

namespace Source\Controllers;

use Source\Core\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

use Source\Models\User;
use Source\Models\Auth;

class App extends Controller
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
        parent::__construct(__DIR__ . '/../../themes/' . CONF_VIEW_APP . '/');

        $this->user = Auth::user();

        if (empty($this->user)) {
            $this->message->before('Efetue o acesso. ')->warning('É preciso acessar sua conta para entrar no aplicativo')->flash();
            redirect('/entrar');
        }
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function profile(ServerRequestInterface $request): ResponseInterface
    {
        return $this->viewResponse('profile', [
            'head' => $this->head('Seu perfil'),
            'userRules' => (new User())->rules(),
            'user' => $this->user
        ]);
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function signout(ServerRequestInterface $request): ResponseInterface
    {
        (new Auth())->signout();
        redirect('/');
        return $this->htmlResponse('');
    }
}
