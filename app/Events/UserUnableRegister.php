<?php

namespace App\Events;

class UserUnableRegister
{
    private $payload;

    public static function fromArray($payload): self
    {
        return new self($payload);
    }

    private function __construct($payload)
    {
        $this->payload = $payload;
    }
}
