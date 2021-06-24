<?php

namespace Source\Core;

use Source\Support\View;
use Laminas\Diactoros\Response\HtmlResponse;

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
     * Request response
     *
     * @param string $template
     * @param array $data
     * @return HtmlResponse
     */
    protected function response(string $template, array $data = array()): HtmlResponse
    {
        $view = new View($this->templatesPath);

        return new HtmlResponse($view->render($template, $data));
    }
}
