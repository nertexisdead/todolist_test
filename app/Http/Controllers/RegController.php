<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserProfile;

use Illuminate\Http\Request;
use Cache;
use DateTime;
use DatePeriod;
use DateInterval;
use Carbon\Carbon;
use Session;
use Auth;
use Hash;
use Mail;

use Validator;



class RegController extends Controller
{
	protected $vars = array();

    public function showRegForm (Request $request)
    {
        return view('auth.register');
    }

	public function register(Request $request)
    {
		$data = array(
			'login'=>$request->login,
			'password'=>$request->password
        );

		$validator = Validator::make($data, [
			'login' => ['required', 'string','max:255', 'unique:users'],
			'password' => ['required', 'string', 'min:8'],
			// , 'confirmed'
		]);

        if ($validator->fails())
		{
             return back()->withErrors($validator)->withInput();
        }
		else
		{

            $user=new User;
			$user->name=$request->name;
			$user->login=$request->login;
			$user->password=Hash::make($request->password);
			$user->save();

			Auth::login($user);
			return redirect('/');

        }
    }



}
