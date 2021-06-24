<?php

namespace Source\Controllers\App;

use Source\Core\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class Auth extends Controller
{
    /**
     * Auth constructor.
     */
    public function __construct()
    {
        parent::__construct(__DIR__ . '/../../../themes/' . CONF_VIEW_APP . '/');
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function signin(ServerRequestInterface $request): ResponseInterface
    {
        return $this->response('signin');
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function register(ServerRequestInterface $request): ResponseInterface
    {
        return $this->response('register');
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function recover(ServerRequestInterface $request): ResponseInterface
    {
        return $this->response('recover');
    }
}
