<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\User;
use Socialite;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
	protected $username = 'username';
	
	protected $loginPath = '/login';
	
    protected $redirectTo = '/dashboard';
	
    protected $redirectPath = '/dashboard';
	
	protected $redirectAfterLogout = '/login';
	
	/*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'		=> 'required|max:255',
            'email' 	=> 'required|email|max:255|unique:users',
            'username' 	=> 'required|max:255|unique:users',
            'password' 	=> 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' 		=> $data['name'],
            'email' 	=> $data['email'],
            'username' 	=> $data['username'],
            'password' 	=> bcrypt($data['password']),
        ]);
    }
	
	/**
     * Redirect the user to the Facebook authentication page.
     *
     * @return Response
     */
    public function fbRedirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }
	
    /**
     * Obtain the user information from Facebook.
     *
     * @return Response
     */
    public function fbHandleProviderCallback()
    {
        return $this->socialAuthHandler(
			Socialite::driver('facebook')->user(),
			'Facebook'
		);
		
	}
	
	/**
     * Redirect the user to the google authentication page.
     *
     * @return Response
     */
    public function googleRedirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }
	
	 /**
     * Obtain the user information from Google.
     *
     * @return Response
     */
    public function googleHandleProviderCallback()
    {
		return $this->socialAuthHandler(
			Socialite::driver('google')->user(),
			'Gmail'
		);
	}
	
	 /**
     * Process social auth response to register and authenticate
     *
     * @param  array  $authResponse
     * @param  string $socialites
     * @return String
     */
	public function socialAuthHandler($authResponse, $socialites)
	{
		$dbUsers = User::where('username', $authResponse->id)->first();
		
		if ($dbUsers === null) {
			/* === insert authresponse to users table ===*/
			$user = new User;
			$user->name         = $authResponse->name;
			$user->email 		= ($authResponse->email != null) ? $authResponse->email : 'noemail@fabook.com';
			$user->username 	= $authResponse->id;
			$user->password 	= bcrypt($authResponse->id);
			$user->avatar 		= $authResponse->avatar;
			$user->socialites  	= $socialites;
			$user->save();
			
			/* === set array redirect message === */
			$redirectMessage = [
				'key' 		=> 'success_message',
				'message'	=> trans('auth.social_reg_success')
			];
		} else {
			/* === set array redirect message === */
			$redirectMessage = [
				'key' 		=> 'failed_message', 
				'message'	=> trans('auth.social_login_denied')
			];
		}
		
		/* === authentiate authresponse === */
		if (Auth::attempt([
			'username' 	  => $authResponse->id,
			'password' 	  => $authResponse->id,
			'is_approved' => 1
			])) {
			/* === success login === */
			return redirect($this->redirectTo);
		} else {
			/* === failed login === */
			return redirect('login')->with(
				$redirectMessage['key'],
				$redirectMessage['message']
			);
		}
	}
}