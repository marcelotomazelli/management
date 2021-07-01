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
        return $this->viewResponse('home', [
            'head' => $this->head()
        ]);
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function confirm(ServerRequestInterface $request): ResponseInterface
    {
        $flash = flash_message();

        if (empty($flash['message']) || empty($flash['message']->text)) {
            redirect('/');
        }

        $optin = new \stdClass();
        $optin->title = "Enviamos um e-mail para \"{$flash['message']->text}\" para confirmar seu cadastro!";
        $optin->image = theme('/assets/img/optin-confirm.png', CONF_VIEW_WEB);
        $optin->description = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora debitis fugiat hic, ipsa eaque amet facilis nam blanditiis doloribus saepe pariatur odit dolor eum minima, eligendi est nemo voluptate tenetur?';

        return $this->viewResponse('optin', [
            'head' => $this->head('Confirme seu cadastro'),
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

        return $this->viewResponse('error', [
            'head' => $this->head('Oops!'),
            'error' => $error
        ]);
    }
}
