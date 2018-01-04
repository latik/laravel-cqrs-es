<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [

        // Command -> CommandHandler chains (one-to-one)
      \App\Commands\CreateUserCommand::class => [ \App\CommandHandlers\CreateUserCommandHandler::class ],

      // DomainEvent -> Listeners chains
      \App\Events\UserRegistered::class => [
        \App\Listeners\UserRegistered::class,
      ],

      \App\Events\UserUnableRegister::class => [
        \App\Listeners\UserUnableRegister::class,
      ],

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
