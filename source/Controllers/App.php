<?php

namespace Source\Controllers;

use Source\Core\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class App extends Controller
{
    /**
     * App constructor.
     */
    public function __construct()
    {
        parent::__construct(__DIR__ . '/../../themes/' . CONF_VIEW_APP . '/');
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function profile(ServerRequestInterface $request): ResponseInterface
    {
        return $this->viewResponse('profile', [
            'head' => $this->head('Seu perfil')
        ]);
    }
}
