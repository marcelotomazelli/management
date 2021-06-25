<?php

namespace Source\Support;

class Message
{
    public const MESSAGE_TYPE_SUCCESS = 'success';
    public const MESSAGE_TYPE_INFO = 'info';
    public const MESSAGE_TYPE_WARNING = 'warning';
    public const MESSAGE_TYPE_ERROR = 'error';

    private $type;
    private $text;
    private $before;
    private $after;

    public function success(string $text): Message
    {
        return $this->message(self::MESSAGE_TYPE_SUCCESS, $text);
    }

    public function info(string $text): Message
    {
        return $this->message(self::MESSAGE_TYPE_INFO, $text);
    }

    public function warning(string $text): Message
    {
        return $this->message(self::MESSAGE_TYPE_WARNING, $text);
    }

    public function error(string $text): Message
    {
        return $this->message(self::MESSAGE_TYPE_ERROR, $text);
    }

    public function before(string $text)
    {
        $this->before = $text;
        return $this;
    }

    public function after(string $text)
    {
        $this->after = $text;
        return $this;
    }

    private function message(string $type, string $text): Message
    {
        $this->type = $type;
        $this->text = $text;
        return $this;
    }

    public function response(bool $withIndex = true): ?array
    {
        if (empty($this->type) || empty($this->text)) {
            return null;
        }

        $response = [
            'type' => $this->type,
            'text' => $this->text
        ];

        if (!empty($this->before)) {
            $response['before'] = $this->before;
        }

        if (!empty($this->after)) {
            $response['after'] = $this->after;
        }

        return $response;
    }
}
