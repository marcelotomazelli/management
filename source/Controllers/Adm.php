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
        Auth::signout();
        redirect('/');
        return $this->htmlResponse('');
    }
}
