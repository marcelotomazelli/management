<?php

namespace Source\Support;

use League\Plates\Engine;

class View
{
    /**
     * @var Engine
     */
    private $engine;

    /**
     * View constructor.
     *
     * @param string $templatesPath
     */
    public function __construct(string $templatesPath)
    {
        $this->engine = new Engine($templatesPath);
    }

    /**
     * @return Engine
     */
    public function engine(): Engine
    {
        return $this->engine;
    }

    /**
     * @param string $template
     * @param array $data
     * @return string
     */
    public function render(string $template, array $data = array()): string
    {
        return $this->engine->render($template, $data);
    }
}
