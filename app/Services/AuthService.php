<?php namespace App\Services;

use Socialite;

use App\Models\User;
use App\Transformers\UserTransformer;

use Illuminate\Http\Request;

class AuthService extends ApiServices{

	public static function redirect()
	{
		return Socialite::driver('facebook')->redirect();
	}

	public static function callback()
	{
		try {
			$user = Socialite::driver('facebook')->user();
		} catch (Exception $e) {
			return AuthService::redirect();
		}
		$authUser = User::createUser($user);
		return ApiServices::respondWithItem($authUser, new UserTransformer);
	}
}
