<?php

namespace App\Commands;

class CreateUserCommand
{
    private $name;
    private $email;
    private $password;

    public static function fromArray(array $payload): self
    {
        return new self($payload);
    }

    private function __construct(array $payload)
    {
        $this->name = $payload['name'];
        $this->email = $payload['email'];
        $this->password = $payload['password'];
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
