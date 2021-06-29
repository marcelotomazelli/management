<?php

namespace Source\Support;

use League\Plates\Engine;

class View
{
    /** @var Engine */
    private $engine;

    /**
     * View constructor.
     *
     * @param string $templatesFolder
     */
    public function __construct(string $templateFolder)
    {
        $this->engine = new Engine($templateFolder);
        $this->engine->addFolder('themeweb', __DIR__ . '/../../themes/' . CONF_VIEW_WEB . '/');
        $this->engine->addFolder('themeapp', __DIR__ . '/../../themes/' . CONF_VIEW_APP . '/');
        $this->engine->addFolder('themeadmin', __DIR__ . '/../../themes/' . CONF_VIEW_ADMIN . '/');
        $this->engine->addFolder('widgets', __DIR__ . '/../../widgets/');
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
