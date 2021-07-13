<?php

namespace Source\Core;

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


        $this->engine->registerFunction('sharedScripts', function (array $scripts) {
            $folder = array_diff(scandir(__DIR__ . '/../../shared/scripts'), ['.', '..']);

            $scripts = array_diff(array_map(function ($script) use ($folder) {
                foreach ($folder as $item) {
                    if ($script == strstr($item, '.', true)) {
                        return $item;
                    }
                }
            }, $scripts), [null]);

            $html = '';

            foreach ($scripts as $script) {
                $html .= "<script src=" . shared("/scripts/{$script}") . "></script>";
            }

            return $html;
        });
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
