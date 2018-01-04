<?php

namespace App\Commands;

use App\EmailAddress;
use App\UserId;
use App\UserName;
use App\UserPassword;

class CreateUserCommand
{
    private $payload;

    public static function fromArray(array $payload): self
    {
        return new self($payload);
    }

    private function __construct(array $payload)
    {
        $this->payload = $payload;
    }

    public function getId(): UserId
    {
        return UserId::generate();
    }

    public function getName(): UserName
    {
        return UserName::fromString($this->payload['name']);
    }

    public function getEmail(): EmailAddress
    {
        return EmailAddress::fromString($this->payload['email']);
    }

    public function getPassword(): UserPassword
    {
        return UserPassword::fromString($this->payload['password']);
    }
}
