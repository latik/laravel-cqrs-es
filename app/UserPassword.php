<?php

namespace App;

use Webmozart\Assert\Assert;

final class UserPassword
{
    /**
     * @var string
     */
    private $hash;

    public static function fromString(string $password): self
    {
        return new self($password);
    }

    private function __construct(string $password)
    {
        Assert::stringNotEmpty($password);

        if (false === $hash = \password_hash($password, PASSWORD_DEFAULT)) {
            throw new \InvalidArgumentException('Unable create hash for password');
        }

        $this->hash = $hash;
    }

    public function __toString(): string
    {
        return $this->hash;
    }

    public function sameValueAs(UserPassword $password): bool
    {
        return \password_verify($password->__toString(), $this->hash);
    }
}
