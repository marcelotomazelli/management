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
        $optin->description = 'O recurso de envio de e-mails não está disponível, essa página é uma amostra :)';

        $this->head('Confirme seu cadastro');
        return $this->viewResponse('optin', [
            'optin' => $optin
        ]);
    }
}
