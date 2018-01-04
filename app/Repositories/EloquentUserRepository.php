<?php

namespace App\Repositories;

use App\User;
use App\Contracts\UserRepository as UserRepositoryInterface;

class EloquentUserRepository implements UserRepositoryInterface
{
    public function save(User $user): void
    {
        $user->save();
    }

    public function findOneBy(string $attribute, $value): ?User
    {
        return User::where($attribute, $value)->first();
    }
}
