<?php

namespace App\Listeners;

use App\Contracts\UserRepository;
use App\Events\UserRegistered as UserRegisteredEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserRegistered
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(UserRepository $repository)
    {
        $this->userRepository = $repository;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(UserRegisteredEvent $event): void
    {
        $this->userRepository->save($event->payload['user']);
    }
}
