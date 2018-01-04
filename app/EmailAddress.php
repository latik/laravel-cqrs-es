<?php

namespace App;

use Webmozart\Assert\Assert;

final class EmailAddress
{
    private $email;

    public static function fromString(string $email): self
    {
        return new self($email);
    }

    public function __construct(string $email)
    {
        Assert::stringNotEmpty($email);

        if (false === \filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException('Invalid email address');
        }

        $this->email = $email;
    }

    public function __toString(): string
    {
        return $this->email;
    }
}
