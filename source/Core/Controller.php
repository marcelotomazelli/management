<?php

namespace Source\Core;

use Source\Support\View;

use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\JsonResponse;

use Psr\Http\Message\ResponseInterface;

abstract class Controller
{
    /**
     * @var string
     */
    protected $templatesPath;

    /**
     * Controller constructor.
     *
     * @param string $templatesPath
     */
    public function __construct(string $templatesPath)
    {
        $this->templatesPath = $templatesPath;
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
        $view = new View($this->templatesPath);

        return $this->htmlResponse($view->render($template, $data));
    }

    protected function htmlResponse(string $html): ResponseInterface
    {
        return new HtmlResponse($html);
    }


    protected function jsonResponse(array $data): ResponseInterface
    {
        return new JsonResponse($data);
    }

}
