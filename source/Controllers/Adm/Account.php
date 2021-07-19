<?php

namespace Source\Controllers\Adm;

use Source\Core\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

use Source\Models\Admin\Auth;

class Account extends Controller
{
    /**
     * Admin Account constructor.
     */
    public function __construct()
    {
        parent::__construct(__DIR__ . '/../../../themes/' . CONF_VIEW_ADMIN . '/');

        if (Auth::admin()) {
            redirect('/adm');
        }

    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function signin(ServerRequestInterface $request): ResponseInterface
    {
        $data = $request->getParsedBody();

        if (!empty($data)) {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $fields = ['email', 'password'];

            if (!array_keys_is($fields, $data)) {
                return $this->errorResponse();
            }

            $auth = new Auth();

            if (!$auth->signin($data['email'], $data['password'])) {
                return $this->jsonResponse($auth->response());
            }

            $this->message->success("Bem vindo(a) de volta ")->flash();
            return $this->jsonResponse(['redirect' => url('/adm')]);
        }

        $this->head(' Admin | Entrar', 'Autenticação administrativa na plataforma Management');
        return $this->viewResponse('signin', []);
    }
}
