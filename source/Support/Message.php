<?php

namespace Source\Support;

use Source\Core\Session;

class Message
{
    public const MESSAGE_TYPE_SUCCESS = 'success';
    public const MESSAGE_TYPE_INFO = 'info';
    public const MESSAGE_TYPE_WARNING = 'warning';
    public const MESSAGE_TYPE_ERROR = 'error';

    /** @var string */
    private $type;

    /** @var string */
    private $text;

    /** @var string */
    private $before;

    /** @var string */
    private $after;

    /**
     * @param string $type
     * @param string $text
     * @return Message
     */
    protected function message(string $type, string $text): Message
    {
        $this->type = $type;
        $this->text = $text;
        return $this;
    }

    /**
     * @param string $text
     * @return Message
     */
    public function text(string $text): Message
    {
        $this->text = $text;
        return $this;
    }

    /**
     * @param string $text
     * @return Message
     */
    public function success(string $text): Message
    {
        return $this->message(self::MESSAGE_TYPE_SUCCESS, $text);
    }

    /**
     * @param string $text
     * @return Message
     */
    public function info(string $text): Message
    {
        return $this->message(self::MESSAGE_TYPE_INFO, $text);
    }

    /**
     * @param string $text
     * @return Message
     */
    public function warning(string $text): Message
    {
        return $this->message(self::MESSAGE_TYPE_WARNING, $text);
    }

    /**
     * @param string $text
     * @return Message
     */
    public function error(string $text): Message
    {
        return $this->message(self::MESSAGE_TYPE_ERROR, $text);
    }

    /**
     * @param string $text
     * @return Message
     */
    public function before(string $text): Message
    {
        $this->before = $text;
        return $this;
    }

    /**
     * @param string $text
     * @return Message
     */
    public function after(string $text): Message
    {
        $this->after = $text;
        return $this;
    }

    /**
     * @return Message
     */
    public function flash(): Message
    {
        if (empty($this->text)) {
            return null;
        }

        $session = new Session();
        $session->set('flash', clone $this);

        return $this;
    }

    /**
     * @param boolean $withIndex
     * @return array|null
     */
    public function response(bool $withIndex = true): ?array
    {
        if (empty($this->text)) {
            return null;
        }

        $response = [
            'text' => $this->text
        ];

        if (!empty($this->type)) {
            $response['type'] = $this->type;
        }

        if (!empty($this->before)) {
            $response['before'] = $this->before;
        }

        if (!empty($this->after)) {
            $response['after'] = $this->after;
        }

        if ($withIndex) {
            return ['message' => $response];
        }

        return $response;
    }
}
