<?php

namespace Source\Controllers\App;

use Source\Core\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

use Source\Models\User;
use Source\Models\Auth;

class Authentication extends Controller
{
    /**
     * Auth constructor.
     */
    public function __construct()
    {
        parent::__construct(__DIR__ . '/../../../themes/' . CONF_VIEW_APP . '/');

        if (!empty(Auth::user())) {
            redirect('/app');
        }
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function register(ServerRequestInterface $request): ResponseInterface
    {
        $data = $request->getParsedBody();

        if (!empty($data)) {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $fields = ['first_name', 'last_name', 'email', 'password', 'password_re'];

            if (!array_keys_is($fields, $data)) {
                return $this->errorResponse();
            }

            $auth = new Auth();

            $registered = $auth->register(
                $data['first_name'],
                $data['last_name'],
                $data['email'],
                $data['password'],
                $data['password_re']
            );

            if (!$registered) {
                return $this->jsonResponse($auth->response());
            }

            $this->message->text($data['email'])->flash();
            return $this->jsonResponse(['redirect' => url('/confirme')]);
        }

        return $this->viewResponse('register', [
            'head' => $this->head('Cadastrar-se', 'Efetue o cadastro na plafaforma'),
            'userRules' => (new User())->rules()
        ]);
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function signin(ServerRequestInterface $request): ResponseInterface
    {
        $data = $request->getParsedBody();
        $cookies = $request->getCookieParams();

        if (!empty($data)) {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $fields = ['email', 'password'];

            if (!array_keys_exists($fields, $data)) {
                return $this->errorResponse();
            }

            $save = (!empty($data['save']) ? true : false);

            $auth = new Auth();

            if (!$auth->signin($data['email'], $data['password'], $save)) {
                return $this->jsonResponse($auth->response());
            }

            return $this->jsonResponse(['redirect' => url('/app')]);
        }

        return $this->viewResponse('signin', [
            'head' => $this->head('Entrar', 'Acesse a plataforma'),
            'data' => [
                'email' => (!empty($cookies['authEmail']) ? $cookies['authEmail'] : null)
            ]
        ]);
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function recover(ServerRequestInterface $request): ResponseInterface
    {
        $data = $request->getParsedBody();

        if (!empty($data)) {
            return $this->errorResponse();
        }

        return $this->viewResponse('recover', [
            'head' => $this->head('Recuperar senha', 'Recupere a senha')
        ]);
    }
}
