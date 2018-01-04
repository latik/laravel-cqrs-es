<?php

namespace App\UseCases;

use App\Commands\CreateUserCommand;
use App\Contracts\UserRepository;
use App\User;

final class CreateUserUseCase
{
    private $userRepository;

    public function __construct(UserRepository $repository)
    {
        $this->userRepository = $repository;
    }

    public function handle(CreateUserCommand $command): void
    {
        try {
            if (null !== $this->userRepository->findOneBy('email', $command->getEmail())) {
                throw new \DomainException(\sprintf('User with email: %s already exists', $command->getEmail()));
            }

            $user = new User();
            $user->fill([
              'id' => $command->getId(),
              'name' => $command->getName(),
              'email' => $command->getEmail(),
              'password' => $command->getPassword(),
            ]);

            $this->userRepository->save($user);
        } catch (\Exception $exception) {
            throw new \DomainException(\sprintf('Unable create new user: %s ', $exception->getMessage()));
        }
    }
}
