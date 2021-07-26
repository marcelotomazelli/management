<?php

namespace Source\Controllers\Adm;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

use Source\Models\TestUser as User;

class Users extends Controller
{
    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function users(ServerRequestInterface $request, array $args): ResponseInterface
    {
        $args = filter_var_array($args, FILTER_SANITIZE_STRIPPED);
        $data = $request->getParsedBody();

        if (!empty($data)) {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $search = $data['search'];

            if (is_numeric(str_replace(['/', '-'], '', $search))) {
                $date = \DateTime::createFromFormat('m/Y', $search);

                if (empty($date)) {
                    $this->message->info('O formato correto para data de registro é mm/aaaa');
                    return $this->jsonResponse(array_merge(
                        $this->message->response(),
                        ['invalid' => ['search']]
                    ));
                }

                $search = $date->format('Y-m');
            } else if (str_include('@', $search)) {
                $search = urlencode(str_slug($search, '', ['@', '.']));
            } else {
                $search = urlencode(filter_var($search, FILTER_SANITIZE_STRIPPED));
            }

            $search = (!empty($search) ? "/{$search}" : '');

            return $this->jsonResponse(['redirect' => url("/adm/usuarios{$search}")]);
        }

        $users = new User();

        $search = !empty($args['search']) ? $args['search'] : null;

        $searchTerms = 'user_id = :user_id';
        $searchParams = "user_id={$this->admin->id}";

        if (!empty($search)) {
            $date = \DateTime::createFromFormat('Y-m', $search);

            if (!empty($date)) {
                $search = $date->format('m/Y');

                $searchTerms .= ' AND year(created_at) = :year AND month(created_at) = :month';
                $searchParams .= "&year={$date->format('Y')}&month={$date->format('m')}";
            } else if (str_include('@', urldecode($search))) {
                $searchTerms .= ' AND email LIKE :email';
                $searchParams .= "&email=%25" . $search . "%25";
                $search = urldecode($search);
            } else if (!empty($search)) {
                $searchTerms .= ' AND (MATCH (first_name, last_name) AGAINST (:nameMatch) OR first_name LIKE :nameLike OR last_name LIKE :nameLike)';
                $searchParams .= "&nameMatch={$search}&nameLike=%25" . $search . "%25";
                $search = urldecode($search);
            } else {
                $searchTerms = '';
                $searchParams = '';
            }
        }

        if (!empty($searchTerms) && !empty($searchParams)) {
            $users = $users->find($searchTerms, $searchParams)->findFetch(true);
        }

        $this->head(' Admin | Usuários');
        return $this->viewResponse('users', [
            'search' => $search,
            'users' => $users
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

            $user = (new User())
                ->find('id = :id AND user_id = :user_id', "id={$args['id']}&user_id={$this->admin->id}")->findFetch();

            if (!$user) {
                return $this->errorResponse('O usuário que tentou acessar não está dispónivel ou não existe', 'Usuário não encontrado. ');
            }

            $action = $data['action'];

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
}
