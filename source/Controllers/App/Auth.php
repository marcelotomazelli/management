<?php

namespace Source\Controllers\App;

use Source\Core\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class Auth extends Controller
{
    /**
     * Auth constructor.
     */
    public function __construct()
    {
        parent::__construct(__DIR__ . '/../../../themes/' . CONF_VIEW_APP . '/');
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function signin(ServerRequestInterface $request): ResponseInterface
    {
        $data = $request->getParsedBody();

        if (!empty($data)) {
            $message = new \Source\Support\Message();

            $message->success('Verefique se informou o e-mail corretamente');

            return $this->jsonResponse([
                'debug' => $data,
                'message' => $message->response()
            ]);
        }

        return $this->viewResponse('signin', [
            'head' => $this->head('Entrar', 'Acesse a plataforma')
        ]);
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function register(ServerRequestInterface $request): ResponseInterface
    {
        return $this->viewResponse('register', [
            'head' => $this->head('Cadastrar-se', 'Efetue o cadastro na plafaforma')
        ]);
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function recover(ServerRequestInterface $request): ResponseInterface
    {
        return $this->viewResponse('recover', [
            'head' => $this->head('Recuperar senha', 'Recupere a senha')
        ]);
    }
}
