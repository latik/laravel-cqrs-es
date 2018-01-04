<?php

namespace App\Contracts;

use App\User;

interface UserRepository
{
    public function save(User $user): void;
    public function findOneBy(string $attribute, $value): ?User;
}
