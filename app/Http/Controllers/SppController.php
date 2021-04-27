<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Spp;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class SppController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($param)
    {
        //
        if($param == 'all'){
            $dataSpp = Spp::orderBy('tahun', 'DESC')->get();
        }else{
            $dataSpp = Spp::where('tahun','like',"%{$param}%")->get();
        }
        return response()->json($dataSpp);
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
            'tahun'=>'required|numeric',
            'nominal'=>'required|numeric'
        ]);

        if($validation->fails()){
            return response()->json([
                'status'=> false,
                'message'=>$validation->errors()
            ], 403);
        }

        $dataSpp = Spp::create([
            'tahun'=>$request->tahun,
            'nominal'=>$request->nominal
        ]);

        return response()->json([
            'status'=>true,
            'message'=> 'Data berhasil ditambah',
            'data'=> $dataSpp
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
        $editSpp = Spp::find($id);
        return response()->json($editSpp);
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
            'tahun'=>'required|numeric',
            'nominal'=>'required|numeric'
        ]);

        if($validation->fails()){
            return response()->json([
                'status'=> false,
                'message'=>$validation->errors()
            ], 403);
        }

        $editSpp = Spp::find($id);
        $editSpp->update([
            'tahun'=>$request->tahun,
            'nominal'=>$request->nominal
        ]);

        return response()->json([
            'status'=>true,
            'message'=>'Data Berhasil Di-edit',
            'data'=>$editSpp
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
        $hapusSpp = Spp::find($id);
        $hapusSpp->delete();

        return response()->json([
            'status'=>true,
            'message'=> 'Data Berhasil Dihapus'
        ]);
    }
}
