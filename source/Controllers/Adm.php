<?php

namespace Source\Controllers;

use Source\Core\Controller;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

use Source\Models\Admin;
use Source\Models\Admin\Auth;
use Source\Models\TestUser;

class Adm extends Controller
{
    /**
     * @var Admin
     */
    protected $admin;

    /**
     * Admin constructor.
     */
    public function __construct()
    {
        parent::__construct(__DIR__ . '/../../themes/' . CONF_VIEW_ADMIN . '/');

        $this->admin = Auth::admin();

        if (!$this->admin) {
            $this->message->before('Efetue o acesso.')->warning(' Para acessar o painel administrativo é necessário acessar sua conta')->flash();
            redirect('/adm/entrar');
        }

        $this->view->engine()->addData(['admin' => clone $this->admin]);
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function users(ServerRequestInterface $request): ResponseInterface
    {
        $this->head(' Admin | Usuários');
        return $this->viewResponse('users', [
            'users' => (new TestUser())
                ->find('user_id = :user_id', "user_id={$this->admin->id}")
                ->findFetch(true)
        ]);
    }

    /**
     * @param ServerRequestInterface $request
     * @param array $args
     * @return ResponseInterface
     */
    public function user(ServerRequestInterface $request, array $args): ResponseInterface
    {
        $args = filter_var_array($args, FILTER_SANITIZE_STRIPPED);
        $data = $request->getParsedBody();

        if (!empty($data)) {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

            $user = (new TestUser())
                ->find('id = :id AND user_id = :user_id', "id={$args['id']}&user_id={$this->admin->id}")->findFetch();

            if (!$user) {
                return $this->errorResponse('Usuário não encontrado. ', 'O usuário que tentou acessar não está dispónivel ou não existe');
            }

            $action = $data['actionName'];

            if ($this->admin->level > 2) {
                $this->message->before('Não está autorizado. ')->info('Você não possui autorização para executar essa ação');
                return $this->jsonResponse($this->message->response());
            }

            if ($action == 'remove') {
                $fullName = "{$user->cutFirstName()} {$user->cutLastName()}";
                if (!$user->destroy($this->admin)) {
                    return $this->jsonResponse($user->response());
                }
            }

            $this->message->before("Usuário \"{$fullName}\" removido. ")->success("Usuário removido com sucesso de nossos registros")->flash();
            return $this->jsonResponse(['reload' => true]);
        }

        redirect('/ops');

        $this->head(" Admin | Usuário");
        return $this->htmlResponse('');
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
