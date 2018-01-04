<?php

namespace App;

use Webmozart\Assert\Assert;

final class UserName
{
    private $username;

    public static function fromString(string $username): self
    {
        return new self($username);
    }

    private function __construct(string $username)
    {
        Assert::stringNotEmpty($username);

        $this->username = $username;
    }

    public function __toString(): string
    {
        return $this->username;
    }
}
