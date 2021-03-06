<?php

namespace Source\Controllers;

use Source\Controllers\Web\Controller;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Source\Support\Modal;

class Web extends Controller
{
    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function home(ServerRequestInterface $request): ResponseInterface
    {
        $data = $request->getParsedBody();

        $modal = new Modal($request);

        if (!empty($data)) {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

            if (!array_keys_is(['modal_boot'], $data)) {
                return $this->jsonResponse('');
            }

            $modal->disable('webHome');

            return $this->jsonResponse('');
        }

        $this->head();
        return $this->viewResponse('home', [
            'modalBoot' => $modal->boot('webHome')
        ]);
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function contact(ServerRequestInterface $request): ResponseInterface
    {
        return $this->errorResponse();
    }

    /**
     * @param ServerRequestInterface $request
     * @param array $args
     * @return ResponseInterface
     */
    public function error(ServerRequestInterface $request, array $args): ResponseInterface
    {
        $args = filter_var_array($args, FILTER_SANITIZE_STRIPPED);

        $code = (!empty($args['code']) ? $args['code'] : 404);

        $error = new \stdClass();

        switch ($code) {
            default:
                $error->code = (is_numeric($code) && strlen(strval($code)) === 3 ? $code : 'Oops');
                $error->message = 'Conteúdo que tentou acessar está indisponível :/';
                $error->link = url();
                $error->linkText = 'Continuar navegando';
        }

        $this->head('Oops!');
        return $this->viewResponse('error', [
            'error' => $error
        ]);
    }
}
