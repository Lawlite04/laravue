<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('loginAdmin');
    }
    public function proses(Request $request)
    {
        request()->validate(
            [
                'username'=> 'required',
                'password'=> 'required'
            ]
        );

        $kredensil = $request->only('username', 'password');

        if(Auth::attempt($kredensil)){
            $user = Auth::petugas();
            if($user->level == 'admin'){
                return redirect()->intended('/homeAdmin');
            }elseif($user->level == 'petugas'){
                return redirect()->intended('/homePetugas');
            }
            return var_dump($user);
            return redirect()->intended();
        }
        return redirect('/loginAdmin');
    }
}
