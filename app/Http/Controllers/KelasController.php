<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use Illuminate\Support\Facades\Validator;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($param)
    {
        if ($param == 'all') {
            $kelas = Kelas::orderBy('created_at', 'DESC')->get();
        } else {
            $kelas = Kelas::where('nama_kelas', 'like', "%{$param}%")->get();
        }

        return response()->json($kelas);
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
            'nama_kelas'=> 'required|string',
            'kompetensi_keahlian'=>'required|string'
        ]);

        if($validation->fails()){
            return response()->json([
                'status' => false,
                'message' => $validation->errors()
            ], 403);
        }

        $kelas = Kelas::create([
            'nama_kelas'=> $request->nama_kelas,
            'kompetensi_keahlian'=> $request->kompetensi_keahlian
        ]);

        return response()->json([
            'status'=> true,
            'message'=> 'Data Berhasil Ditambah',
            'data'=> $kelas
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
        $kelas = Kelas::find($id);

        return response()->json($kelas);
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
            'nama_kelas' => 'required|string',
            'kompetensi_keahlian' => 'required|string'
        ]);

        if($validation->fails()){
            return response()->json([
                'status'=> false,
                'message'=>$validation->errors()
            ], 403);
        }

        $kelas = Kelas::find($id);
        $kelas->update([
            'nama_kelas'=>$request->nama_kelas,
            'kompetensi_keahlian'=>$request->kompetensi_keahlian
        ]);

        return response()->json([
            'status'=>true,
            'message'=>'Data berhasil di-update',
            'data'=>$kelas
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
        $hapus = Kelas::find($id);
        $hapus->delete();

        return response()->json([
            'status'=> true,
            'message'=> 'Data berhasil dihapus'
        ]);
    }
}
