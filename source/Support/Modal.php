<?php

namespace Source\Support;

use Psr\Http\Message\ServerRequestInterface;

class Modal
{
    /**
     * @var ServerRequestInterface
     */
    protected $request;

    /**
     * @param ServerRequestInterface $request
     */
    public function __construct(ServerRequestInterface $request)
    {
        $this->request = $request;
    }

    /**
     * @param string $name
     * @return Modal|null
     */
    public function enable(string $name): ?Modal
    {
        $name = $this->name($name);

        setcookie($name, true, (time() - (60 * 60)), '/');

        return $this;
    }

    /**
     * @param string $name
     * @param integer $days
     * @return Modal|null
     */
    public function disable(string $name, $days = 7): ?Modal
    {
        $name = $this->name($name);

        if (!is_numeric($days)) {
            $days = 7;
        }

        setcookie($name, true, (time() + (60 * 60 * 24 * $days)), '/');

        return $this;
    }

    /**
     * @param string $name
     * @return boolean
     */
    public function boot(string $name): bool
    {
        $name = $this->name($name);
        $cookies = $this->request->getCookieParams();

        return (empty($cookies[$name]) ? true : false);
    }

    /**
     * @param string $name
     * @return string
     */
    private function name(string $name): string
    {
        return (str_include('modalBoot', $name) ? $name : 'modalBoot' . ucfirst($name));
    }
}
