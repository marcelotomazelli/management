<?php

namespace Source\Controllers\Web;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

class Optin extends Controller
{
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

        $this->head('Confirme seu cadastro');
        return $this->viewResponse('optin', [
            'optin' => $optin
        ]);
    }
}
