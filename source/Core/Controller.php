<?php

namespace Source\Core;

use Source\Core\View;
use Source\Support\Message;

use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\JsonResponse;

use Psr\Http\Message\ResponseInterface;

abstract class Controller
{
    /** @var View */
    protected $view;

    /** @var Message */
    protected $message;

    /**
     * Controller constructor.
     *
     * @param string $templatesFolder
     */
    public function __construct(string $templatesFolder)
    {
        $this->view = new View($templatesFolder);
        $this->message = new Message();
    }

    /**
     * @param string|null $title
     * @param string|null $desc
     * @return \stdClass
     */
    protected function head(?string $title = null, ?string $desc = null): \stdClass
    {
        $head = new \stdClass();
        $head->title = (!empty($title) ? CONF_SITE_NAME . ' - ' . $title : CONF_SITE_TITLE);
        $head->desc = (!empty($desc) ? $desc : CONF_SITE_DESC);

        $this->view->engine()->addData(['head' => $head]);

        return $head;
    }

    /**
     * Request response
     *
     * @param string $template
     * @param array $data
     * @return HtmlResponse
     */
    protected function viewResponse($template, array $data = array()): ResponseInterface
    {
        return $this->htmlResponse($this->view->render($template, $data));
    }

    /**
     * @param string $html
     * @return ResponseInterface
     */
    protected function htmlResponse(string $html): ResponseInterface
    {
        return new HtmlResponse($html);
    }

    /**
     * @param array|object $data
     * @return ResponseInterface
     */
    protected function jsonResponse($data): ResponseInterface
    {
        return new JsonResponse($data);
    }

    /**
     * @param string $type
     * @param string $text
     * @param string|null $before
     * @param string|null $after
     * @return ResponseInterface
     */
    protected function messageResponse(
        string $type,
        string $text,
        ?string $before = null,
        ?string $after = null
    ): ResponseInterface
    {
        $types = [];

        foreach ((new \ReflectionClass(Message::class))->getConstants() as $i => $const) {
            if (str_include('MESSAGE_TYPE', $i)) {
                array_push($types, $const);
            }
        }

        if (!in_array($type, $types)) {
            $type = 'info';
        }

        $this->message->$type($text);

        if (!empty($before)) {
            $this->message->before($before);
        }

        if (!empty($after)) {
            $this->message->after($after);
        }

        return $this->jsonResponse($this->message->response());
    }

    /**
     * @param string $text
     * @param string $before
     * @param string $after
     * @return ResponseInterface
     */
    protected function errorResponse(string $text = null, string $before = null, string $after = null): ResponseInterface
    {
        return $this->messageResponse(
            'error',
            (empty($text) ? 'Verifiques os dados ou tente novamente mais tarde' : $text),
            (empty($before) ? 'Erro inesperado ocorreu. ' : $before),
            $after
        );
    }

    /**
     * @param string $text
     * @param string $before
     * @param string $after
     * @return ResponseInterface
     */
    protected function warningResponse(string $text, string $before = null, string $after = null): ResponseInterface
    {
        return $this->messageResponse('warning', $text, $before, $after);
    }
}
