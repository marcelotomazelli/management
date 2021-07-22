<?php

namespace Source\Controllers;

use Source\Controllers\Adm\Controller;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

use Source\Models\Admin\Auth;

class Adm extends Controller
{
    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function signout(ServerRequestInterface $request): ResponseInterface
    {
        $admin = clone $this->admin;
        Auth::signout();
        $this->message->success('Deslogado com sucesso ')->after($admin->cutFirstName())->flash();
        redirect('/adm/entrar');
        return $this->htmlResponse('');
    }
}
