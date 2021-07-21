<?php

namespace Source\Controllers\Adm;

use Source\Core\Controller;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

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
            $validateResponse = $this->validateRequest($data, $fields);

            if (!empty($validateResponse)) {
                return $validateResponse;
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
