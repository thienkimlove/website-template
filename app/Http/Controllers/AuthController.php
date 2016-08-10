<?php

namespace App\Http\Controllers;

use App\Account;
use App\User;
use Auth;
use Exception;
use Laravel\Socialite\Facades\Socialite;
use Validator;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
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
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/admin';
    
    protected $guard = 'backend';

    protected $redirectAfterLogout = '/admin';

    /**
     * Create a new authentication controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:accounts',
            'permission_id' => 'required'
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
        return Account::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'permission_id' => (int) $data['permission_id'],
        ]);
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $authUser = Account::where('email', $user->email)->first();
            if ($authUser) {
                Auth::guard($this->guard)->login($authUser, true);
                return redirect('admin');
            } else {
                return redirect('/');
            }
        } catch (Exception $e) {
            return redirect('admin/login');
        }

    }

    public function logout()
    {
        Auth::guard($this->guard)->logout();
        return redirect('/');
    }
}
