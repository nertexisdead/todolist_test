<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

use App\Models\User;

use Validator;
use Auth;
use Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {

        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

	public function logout()
	{
		Auth::logout();
		Session::flush();
		return redirect('/');
	}


	public function login(Request $request)
    {

		$data=array(
			'login'=>$request->login,
			'password'=>$request->password
		);

		$validator = Validator::make($data, [
            'login' => ['required', 'string',  'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);

		if ($validator->fails())
		{
			return back()->withErrors($validator)->withInput();
		}
		else
		{

			if (Auth::attempt($data))
			{
				$user = User::where('login',$request->login)->first();
				Auth::login($user);

				return redirect('/');

			}
			else
			{
				return back()->withErrors(['login' => 'Неверный логин или пароль'])->withInput();
			}
		}
    }

}
