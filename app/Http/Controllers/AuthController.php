<?php namespace App\Http\Controllers;

use App\Services\AuthService;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class AuthController extends Controller {

	public function redirect()
	{
		return AuthService::redirect();
	}

	public function callback()
	{
		return AuthService::callback();
	}
}
