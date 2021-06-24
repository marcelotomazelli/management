<?php

namespace Source\Controllers;

use Source\Core\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class Web extends Controller
{
    /**
     * Web constructor.
     */
    public function __construct()
    {
        parent::__construct(__DIR__ . '/../../themes/' . CONF_VIEW_WEB . '/');
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function home(ServerRequestInterface $request): ResponseInterface
    {
        return $this->response('home');
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function confirm(ServerRequestInterface $request): ResponseInterface
    {
        $optin = new \stdClass();
        $optin->title = 'Enviamos um e-mail para "marctomazelli@gmail.com" para validar seu cadastro!';
        $optin->image = theme('/assets/img/optin-confirm.png', CONF_VIEW_WEB);
        $optin->description = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora debitis fugiat hic, ipsa eaque amet facilis nam blanditiis doloribus saepe pariatur odit dolor eum minima, eligendi est nemo voluptate tenetur?';

        return $this->response('optin', [
            'optin' => $optin
        ]);
    }

    /**
     * @param ServerRequestInterface $request
     * @param array $args
     * @return ResponseInterface
     */
    public function error(ServerRequestInterface $request, array $args): ResponseInterface
    {
        $args = filter_var_array($args, FILTER_SANITIZE_STRIPPED);

        $code = (!empty($args['code']) ? $args['code'] : 404);

        $error = new \stdClass();

        switch ($code) {
            default:
                $error->code = (is_numeric($code) && strlen(strval($code)) === 3 ? $code : 'Oops');
                $error->message = 'Conteúdo que tentou acessar está indisponível :/';
                $error->link = url();
                $error->linkText = 'Continuar navegando';
        }

        return $this->response('error', [
            'error' => $error
        ]);
    }
}
