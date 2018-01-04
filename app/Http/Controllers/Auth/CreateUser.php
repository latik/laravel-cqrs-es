<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Commands\CreateUserCommand;
use App\Contracts\UserRepository;
use App\UseCases\CreateUserUseCase;
use Illuminate\Http\Request;

class CreateUser extends Controller
{
    public $request;
    public $repository;

    public function __construct(Request $request, UserRepository $repository)
    {
        $this->request = $request;
        $this->repository = $repository;
    }

    public function __invoke()
    {
        $this->validate($this->request, [
          'name' => 'required|string|max:255',
          'email' => 'required|string|email|max:255',
          'password' => 'required|string|min:6|confirmed',
        ]);

        $command = CreateUserCommand::fromArray($this->request->all());

        $useCase = new CreateUserUseCase($this->repository);

        $useCase->handle($command);

        return redirect('/create-user')->with('status', 'User created!');
    }
}
