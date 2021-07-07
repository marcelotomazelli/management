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

}
