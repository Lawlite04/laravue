<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Petugas;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
class PetugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($param)
    {
        if ($param == 'all') {
            $petugas = DB::select("select * from users where level = 'admin' OR level = 'petugas'");
        } else {
            $petugas = User::where([
                    ['name','like',"%{$param}%"],
                    ['level','!=','user'],
                ])->get();
        }


        return response()->json($petugas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validation = Validator::make($request->all(),[
            'email'=>'required|string|unique:users,email',
            'password'=>'required|string',
            'name'=>'required|string',
            'level'=>'required',
        ]);

        if($validation->fails()){
            return response()->json([
                'status'=>false,
                'message'=>$validation->errors()
            ], 403);
        }

        $petugas = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'level'=>$request->level
        ]);

        return response()->json([
            'status'=>true,
            'message'=>'Data berhasil ditambah',
            'data'=>$petugas
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $petugas = User::find($id);
        return response()->json($petugas);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $validation = Validator::make($request->all(),[
            'name'=>'required|string',
            'level'=>'required'
        ]);

        if($validation->fails()){
            return response()->json([
                'status'=>false,
                'message'=>$validation->errors()
            ], 403);
        }

        $petugas = User::find($id);
        $petugas->update([
            'name'=>$request->name,
            'level'=>$request->level,
        ]);

        return response()->json([
            'status'=>true,
            'message'=>'Data berhasil diubah',
            'data'=>$petugas
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try {
            $petugas = User::find($id);
            $petugas->delete();

            return response()->json([
                'status'=>true,
                'message'=>'Data berhasil dihapus',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status'=> false,
                'message'=>$th->getMessage(),
            ], 500);
        }
    }
}
