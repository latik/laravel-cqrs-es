<?php

namespace App\Events;

class UserRegistered
{
    public $payload;

    public static function fromArray($payload): self
    {
        return new self($payload);
    }

    private function __construct($payload)
    {
        $this->payload = $payload;
    }
}
