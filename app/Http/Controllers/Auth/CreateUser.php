<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Commands\CreateUserCommand;
use Illuminate\Http\Request;

class CreateUser extends Controller
{
    public $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function __invoke()
    {
        $this->validate($this->request, [
          'name' => 'required|string|max:255',
          'email' => 'required|string|email|max:255',
          'password' => 'required|string|min:6|confirmed',
        ]);

        event(CreateUserCommand::fromArray($this->request->all()));

        return redirect('/create-user')->with('status', 'User created!');
    }
}
