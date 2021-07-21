<?php

namespace Source\Controllers\App;

use Source\Core\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

use Source\Models\User;
use Source\Models\App\Auth;

class Account extends Controller
{
    /**
     * App Account constructor.
     */
    public function __construct()
    {
        parent::__construct(__DIR__ . '/../../../themes/' . CONF_VIEW_APP . '/');

        if (Auth::user()) {
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
            $validateResponse = $this->validateRequest($data, $fields);

            if (!empty($validateResponse)) {
                return $validateResponse;
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

        $this->head('Cadastrar-se', 'Efetue o cadastro na plafaforma');
        return $this->viewResponse('register', [
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
            $validateResponse = $this->validateRequest($data, $fields, false);

            if (!empty($validateResponse)) {
                return $validateResponse;
            }

            $auth = new Auth();

            $save = (!empty($data['save']) ? true : false);

            if (!$auth->signin($data['email'], $data['password'], $save)) {
                return $this->jsonResponse($auth->response());
            }

            return $this->jsonResponse(['redirect' => url('/app')]);
        }

        $this->head('Entrar', 'Acesse a plataforma');
        return $this->viewResponse('signin', [
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

        $this->head('Recuperar senha', 'Recupere a senha');
        return $this->viewResponse('recover');
    }

    /**
     * @param array $data
     * @param array $fields
     * @param boolean $keyIs
     * @return ResponseInterface|null
     */
    protected function validateRequest(array $data, array $fields, bool $keyIs = true): ?ResponseInterface
    {
        if (!csrf_verify($data['csrf'])) {
            return $this->errorResponse('Verificamos que não está utilizando corretamente o formulário para está requisação', 'Use o formulário. ');
        }

        $fields = array_merge($fields, ['csrf']);

        $invalidKeys = false;

        if ($keyIs && !array_keys_is($fields, $data)) {
            $invalidKeys = true;
        } elseif (!array_keys_exists($fields, $data)) {
            $invalidKeys = true;
        }

        if ($invalidKeys) {
            return $this->warningResponse('Alguns campos estão incorretos para prosseguir com a requisição', 'Há campos incorretos. ');
        }

        return null;
    }
}
