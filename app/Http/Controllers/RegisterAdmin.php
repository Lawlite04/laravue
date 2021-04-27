<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;


class RegisterAdmin extends Controller
{
    //
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'name'=>'string',
            'email'=>'email|unique:users,email',
            'password'=>'string|max:30',
            'level'=>'required'
        ]);

        if($validation->fails()){
            return response()->json([
                'status'=>false,
                'message'=>$validation->errors()
            ], 403);
        }

        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'level'=>$request->level
        ]);
        return response()->json([
            'status'=>true,
            'message'=>'Registrasi berhasil!!!',
            'data'=>$user
        ]);
    }
}
