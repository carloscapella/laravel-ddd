<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Module\User\Application\UserDto;
use App\Module\User\Application\CreateUserCommand;

class UserController extends Controller
{

	public function create(Request $request)
	{
		// creates an dto object with request-data.
        $userDto = new UserDto($request->all());

		return $this->dispatch(new CreateUserCommand($userDto));

	}
}
