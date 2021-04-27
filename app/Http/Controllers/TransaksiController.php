<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

use function PHPUnit\Framework\returnSelf;

class TransaksiController extends Controller
{
    public function index($nisn)
    {
        $bayar = Pembayaran::from('pembayarans AS a')
        ->select('a.*','b.nama','b.nis','b.alamat','c.nominal','c.tahun','d.nama_kelas')
        ->join('siswas AS b', 'a.nisn','=','b.nisn')
        ->join('spps AS c', 'b.id_spp','=','c.id')
        ->join('kelas AS d', 'b.id_kelas','=','d.id')
        ->where('a.nisn','=',$nisn)
        ->get();

        return response()->json($bayar);
    }
    public function search($nisn)
    {
        try {
            $bayar = Pembayaran::where('nisn','=',$nisn)->get();
            if($bayar[0]->id){
                return response()->json([
                    'status'=>true,
                    'datae'=>$bayar
                ]);
            }else{
                return response()->json([
                    'status'=>false,
                    'message' => "NISN tidak ditemukan"
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status'=>false,
                'message'=>$th->getMessage()
            ]);
        }
    }

    public function store($id)
    {
        $myDate = date('Y-m-d');
        $tagihan = Pembayaran::find($id);
        $tagihan->update([
            'tgl_bayar'=>$myDate,
            'tahun_dibayar'=>'Lunas'
        ]);
        return response()->json([
            'status'=>true,
            'message'=>'Pembayaran Berhasil!!',
        ]);
    }

    public function destroy($id)
    {
        // return response()->json($id );
        $tagihan = Pembayaran::find($id);
        $tagihan->update([
            'tgl_bayar'=>NULL,
            'tahun_dibayar'=>NULL
        ]);
        return response()->json([
            'status'=>true,
            'message'=>'Pembayaran Berhasil Dibatalkan',
        ]);
    }

    public function history($param)
    {
        if($param == 'all'){
            $history = Pembayaran::from('pembayarans AS a')
            ->select('a.*','b.nama','c.tahun','c.nominal','d.nama_kelas')
            ->join('siswas AS b', 'a.nisn','=','b.nisn')
            ->join('spps AS c', 'b.id_spp','=','c.id')
            ->join('kelas AS d', 'b.id_kelas','=','d.id')
            ->whereNotNull('a.tahun_dibayar')
            ->orderBy('a.tgl_bayar', 'DESC')
            ->get();

            return response()->json($history);
        }else{
            $history = Pembayaran::from('pembayarans AS a')
            ->select('a.*','b.nama','c.tahun','c.nominal','d.nama_kelas')
            ->join('siswas AS b', 'a.nisn','=','b.nisn')
            ->join('spps AS c', 'b.id_spp','=','c.id')
            ->join('kelas AS d', 'b.id_kelas','=','d.id')
            ->whereNotNull('a.tahun_dibayar')
            ->where('b.nama', 'like', "%{$param}%")
            ->get();

            return response()->json($history);
        }
    }


    // public function hapus($id)
    // {
    //     $delete = Pembayaran::find($id);
    //     $delete->delete();

    //     return response()->json([
    //         'status'=>true,
    //         'message'=>'History berhasil dihapus'
    //     ]);
    // }

    // public function hapusAll()
    // {
    //     DB::delete('delete from pembayarans');
    //     return response()->json([
    //         'status'=>true,
    //         'message'=>'Semua History berhasil dihapus'
    //     ]);
    // }

    public function dashboardAdmin()
    {
        $spp = DB::select('select count(*) AS spp from spps');
        $kelas = DB::select('select count(*) AS kelas from kelas');
        $petugas = DB::select("select count(*) AS petugas from users where level = 'petugas' OR level = 'admin'");
        $siswa = DB::select('select count(*) AS siswa from siswas');
        $pembayaran = DB::select("select count(*) AS pembayaran from pembayarans where tahun_dibayar = 'Lunas'");

        return response()->json([
            'spp'=>$spp,
            'kelas'=>$kelas,
            'petugas'=>$petugas,
            'siswa'=>$siswa,
            'pembayaran'=>$pembayaran
        ]);
    }

    public function cetak($id)
    {

        $history = Pembayaran::from('pembayarans AS a')->select('a.*','b.nama','b.nis','b.alamat','c.nominal','c.tahun','d.nama_kelas')
        ->join('siswas AS b', 'a.nisn','=','b.nisn')
        ->join('spps AS c', 'b.id_spp','=','c.id')
        ->join('kelas AS d', 'b.id_kelas','=','d.id')
        ->where('a.id','=',$id)
        ->get();

        return response()->json($history);
        // $pdf = PDF::loadview('repot.history_pdf', ['history'=>$history]);
        // return $pdf->stream();
    }

    public function cariTanggal(Request $request)
    {

        $validation = Validator::make($request->all(),[
            'tanggal' => 'required'
        ]);

        if($validation->fails()){
            return response()->json([
                'status'=>false,
                'message'=>$validation->errors()
            ], 403);
        }

        $history = Pembayaran::from('pembayarans AS a')
        ->select('a.*','b.nama','c.tahun','c.nominal','d.nama_kelas')
        ->join('siswas AS b', 'a.nisn','=','b.nisn')
        ->join('spps AS c', 'b.id_spp','=','c.id')
        ->join('kelas AS d', 'b.id_kelas','=','d.id')
        ->where(
            [
                ['a.tahun_dibayar','!=',NULL],
                ['a.tgl_bayar','=',$request->tanggal]
            ]
            )
        ->get();
        return response()->json($history);
    }
}
