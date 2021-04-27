<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $inputVal = $request->all();
        $this->validate($request,[
            'email'=>'required|email',
            'password'=>'required'
        ]);
        if(Auth::attempt(['email' => $inputVal['email'], 'password' => $inputVal['password']])){
            if(Auth::user()->level == 'admin'){
                return redirect()->route('home');
            }elseif(Auth::user()->level == 'petugas'){
                return redirect()->route('petugas');
            }elseif(Auth::user()->level == 'user'){
                return redirect()->route('user');
            }
        }else{
            return redirect()->route('login')->with('error','Email & Password are incorrect');
        }

    }
}
