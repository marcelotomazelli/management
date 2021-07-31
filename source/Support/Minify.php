<?php

namespace Source\Support;

class Minify
{
    /**
     * @var string
     */
    protected $themeDir;

    /**
     * @var array
     */
    protected $versionsDir;

    /**
     * @var string
     */
    protected $aliasSufix;

    /**
     * @param string $themeDir
     * @param string $cssVersionDir
     * @param string $jsVersionDir
     * @param string $aliasSufix
     */
    public function __construct(
        string $themeDir,
        string $cssVersionDir,
        string $jsVersionDir,
        string $aliasSufix = '::'
    )
    {
        $this->themeDir = $themeDir;
        $this->versionsDir = [
            'css' => $cssVersionDir,
            'js' => $jsVersionDir,
        ];
        $this->aliasSufix = $aliasSufix;
    }

    /**
     * @param array $paths
     * @param string $minifyTo
     * @return Minify
     */
    public function css(array $paths, string $minifyTo = 'styles.min.css'): Minify
    {
        $dirs = [
            'shared' => __DIR__ . "/../../shared/styles/",
            'theme'  => __DIR__ . "/../../themes/{$this->themeDir}/assets/css/",
        ];

        $this->minify('css', $minifyTo, $paths, $dirs);
        return $this;
    }

    /**
     * @param array $paths
     * @param string $minifyTo
     * @return Minify
     */
    public function js(array $paths, string $minifyTo = 'scripts.min.js'): Minify
    {
        $dirs = [
            'shared' => __DIR__ . "/../../shared/scripts/",
            'theme'  => __DIR__ . "/../../themes/{$this->themeDir}/assets/js/",
        ];

        $this->minify('js', $minifyTo, $paths, $dirs);
        return $this;
    }

    /**
     * @param string $minify
     * @param string $minifyTo
     * @param array $paths
     * @param array $dirs
     * @return void
     */
    protected function minify(
        string $minify,
        string $minifyTo,
        array $paths,
        array $dirs
    ): void
    {
        $minify = strtolower($minify);
        $version = $this->versionsDir[$minify];

        $versionDir = "{$dirs['theme']}/{$version}";
        $minifyTo = "{$versionDir}/{$minifyTo}";

        if (file_exists($minifyTo) && is_file($minifyTo)) {
            return;
        }

        $paths = $this->paths($paths, $dirs);
        $minifier = $this->minifier($minify);

        foreach ($paths as $path) {
            $data = $path;

            if (filter_var($path, FILTER_VALIDATE_URL)) {
                $data = file_get_contents($path);
            }

            $minifier->add($data);
        }

        $minifiedData = $minifier->minify();

        if (!is_dir($versionDir)) {
            mkdir($versionDir);
        }

        $minifiedFile = fopen($minifyTo, 'w');
        fwrite($minifiedFile, $minifiedData);
        fclose($minifiedFile);
    }

    /**
     * @param string $minify
     * @return object
     */
    protected function minifier(string $minify): object
    {
        $minify = strtoupper($minify);
        $class = "\\MatthiasMullie\\Minify\\{$minify}";
        return new $class();
    }

    /**
     * @param array $paths
     * @param array $dirs
     * @return array
     */
    protected function paths(array $paths, array $dirs): array
    {
        $aliasSufix = $this->aliasSufix;

        $alias = array_map(function ($value) use ($aliasSufix) {
            return (!str_include($aliasSufix, $value) ? "{$value}{$aliasSufix}" : $value);
        }, array_keys($dirs));
        $dirs = array_values($dirs);

        $paths = array_map(function ($value) use ($alias, $dirs) {
            if (filter_var($value, FILTER_VALIDATE_URL)) {
                return $value;
            }

            return str_replace($alias, $dirs, $value);
        }, $paths);

        return $paths;
    }
}
