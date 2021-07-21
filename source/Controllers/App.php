<?php

namespace Source\Controllers;

use Source\Controllers\App\Controller;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

use Source\Models\App\Auth;
use Source\Models\User;

class App extends Controller
{
    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function profile(ServerRequestInterface $request): ResponseInterface
    {
        $data = $request->getParsedBody();

        if (!empty($data)) {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $user = Auth::user();

            if (!$user->edit($data)) {
                return $this->jsonResponse($user->response());
            }

            $this->message->before('Usuário atualizado com sucesso. ')->success('Dados do usuário foram atualizados com sucesso')->flash();
            return $this->jsonResponse(['reload' => true]);
        }

        $this->head('Seu perfil');
        return $this->viewResponse('profile', [
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
        Auth::signout();
        redirect('/');
        return $this->htmlResponse('');
    }
}
