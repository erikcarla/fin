<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'email', 'facebook_id', 'avatar'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['facebook_id', 'remember_token'];

	public static function createUser($facebookUser)
	{
		$user = User::where('facebook_id', $facebookUser->id)->first();

		if ($user){
			return $user;
		}

		return User::create([
			'name' => $facebookUser->name,
			'email' => $facebookUser->email,
			'facebook_id' => $facebookUser->id,
			'avatar' => $facebookUser->avatar
		]);
	}
}
