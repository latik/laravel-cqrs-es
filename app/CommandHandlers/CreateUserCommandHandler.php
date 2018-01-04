<?php

namespace App\CommandHandlers;

use App\Commands\CreateUserCommand;
use App\Contracts\UserRepository;
use App\Events\UserRegistered;
use App\Events\UserUnableRegister;
use App\User;

final class CreateUserCommandHandler
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

            event(UserRegistered::fromArray(\compact('user')));
        } catch (\Exception $exception) {
            event(UserUnableRegister::fromArray(\compact('user', 'exception')));
        }
    }
}
