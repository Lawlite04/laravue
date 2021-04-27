<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Spp;
use App\Models\Pembayaran;

use Illuminate\Support\Facades\Validator;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($param)
    {
        if ($param == 'all') {
            $siswa = Siswa::from('siswas AS a')
            ->select('a.*','b.tahun','c.nama_kelas')
            ->join('spps AS b','a.id_spp','=','b.id')
            ->join('kelas AS c','a.id_kelas','=','c.id')
            ->orderBy('created_at','DESC')->get();

            $kelas = Kelas::all();
            $spp = Spp::all();
        } else {
            $siswa = Siswa::from('siswas AS a')
            ->select('a.*','b.tahun','c.nama_kelas')
            ->join('spps AS b','a.id_spp','=','b.id')
            ->join('kelas AS c','a.id_kelas','=','c.id')
            ->where('a.nama','like',"%{$param}%")
            ->get();

            $kelas = Kelas::all();
            $spp = Spp::all();
        }


        return response()->json([
            'siswa'=>$siswa,
            'kelas'=>$kelas,
            'spp'=>$spp
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function detailSiswa($id)
    {
        $siswa = Siswa::from('siswas AS a')
        ->select('a.*','b.tahun','c.nama_kelas')
        ->join('spps AS b','a.id_spp','=','b.id')
        ->join('kelas AS c','a.id_kelas','=','c.id')
        ->orderBy('created_at','DESC')
        ->where('a.id','=',$id)->get();

        $kelas = Kelas::all();
        $spp = Spp::all();
        return response()->json([
            'siswa'=>$siswa,
            'kelas'=>$kelas,
            'spp'=>$spp
        ]);
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
            'nisn'=>'required|string|unique:siswas,nisn',
            'nis'=>'required|string|unique:siswas,nis',
            'nama'=>'required|string',
            'id_kelas'=>'required|numeric',
            'alamat'=>'required|string',
            'no_telp'=>'required|numeric',
            'id_spp'=>'required|numeric'
            ]);

            if($validation->fails()){
                return response()->json([
                    'status'=>false,
                    'message'=>$validation->errors()
                ], 403);
        }

        $siswa = Siswa::create([
            'nisn'=>$request->nisn,
            'nis'=>$request->nis,
            'nama'=>$request->nama,
            'id_kelas'=>$request->id_kelas,
            'alamat'=>$request->alamat,
            'no_telp'=>$request->no_telp,
            'id_spp'=>$request->id_spp
            ]);

        return response()->json([
            'status'=>true,
            'message'=>'Data Berhasil Ditambah',
            'data'=>$siswa
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
        $siswa = Siswa::find($id);
        return response()->json($siswa);
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
            'nisn'=>'required|string',
            'nis'=>'required|string',
            'nama'=>'required|string',
            'id_kelas'=>'required|numeric',
            'alamat'=>'required|string',
            'no_telp'=>'required|numeric',
            'id_spp'=>'required|numeric'
            ]);

            if($validation->fails()){
                return response()->json([
                    'status'=>false,
                    'message'=>$validation->errors()
                ], 403);
        }

        $siswa = Siswa::find($id);
        $siswa->update([
            'nis'=>$request->nis,
            'nama'=>$request->nama,
            'id_kelas'=>$request->id_kelas,
            'alamat'=>$request->alamat,
            'no_telp'=>$request->no_telp,
            'id_spp'=>$request->id_spp
        ]);

        return response()->json([
            'status'=>true,
            'message'=>'Data berhasil di-edit',
            'data'=>$siswa
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
            $siswa = Siswa::find($id);
            $siswa->delete();

            return response()->json([
                'status'=>true,
                'message'=>'Data berhasil dihapus',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status'=>false,
                'message'=>$th->getMessage()
            ]);
        }
    }
}
