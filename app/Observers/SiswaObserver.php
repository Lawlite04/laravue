<?php

namespace App\Observers;

use App\Models\Siswa;

use App\Models\Pembayaran;

class SiswaObserver
{
    /**
     * Handle the Siswa "created" event.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return void
     */
    public function created(Siswa $siswa)
    {
        $tagihan = [
            [
                'nisn'=>$siswa->nisn,
                'tgl_bayar'=>NULL,
                'bulan_dibayar'=>'Januari',
                'tahun_dibayar'=>NULL,
                'jumlah_dibayar'=>NULL
            ],
            [
                'nisn'=>$siswa->nisn,
                'tgl_bayar'=>NULL,
                'bulan_dibayar'=>'Februari',
                'tahun_dibayar'=>NULL,
                'jumlah_dibayar'=>NULL
            ],
            [
                'nisn'=>$siswa->nisn,
                'tgl_bayar'=>NULL,
                'bulan_dibayar'=>'Maret',
                'tahun_dibayar'=>NULL,
                'jumlah_dibayar'=>NULL
            ],
            [
                'nisn'=>$siswa->nisn,
                'tgl_bayar'=>NULL,
                'bulan_dibayar'=>'April',
                'tahun_dibayar'=>NULL,
                'jumlah_dibayar'=>NULL
            ],
            [
                'nisn'=>$siswa->nisn,
                'tgl_bayar'=>NULL,
                'bulan_dibayar'=>'Mei',
                'tahun_dibayar'=>NULL,
                'jumlah_dibayar'=>NULL
            ],
            [
                'nisn'=>$siswa->nisn,
                'tgl_bayar'=>NULL,
                'bulan_dibayar'=>'Juni',
                'tahun_dibayar'=>NULL,
                'jumlah_dibayar'=>NULL
            ],
            [
                'nisn'=>$siswa->nisn,
                'tgl_bayar'=>NULL,
                'bulan_dibayar'=>'Juli',
                'tahun_dibayar'=>NULL,
                'jumlah_dibayar'=>NULL
            ],
            [
                'nisn'=>$siswa->nisn,
                'tgl_bayar'=>NULL,
                'bulan_dibayar'=>'Agustus',
                'tahun_dibayar'=>NULL,
                'jumlah_dibayar'=>NULL
            ],
            [
                'nisn'=>$siswa->nisn,
                'tgl_bayar'=>NULL,
                'bulan_dibayar'=>'September',
                'tahun_dibayar'=>NULL,
                'jumlah_dibayar'=>NULL
            ],
            [
                'nisn'=>$siswa->nisn,
                'tgl_bayar'=>NULL,
                'bulan_dibayar'=>'Oktober',
                'tahun_dibayar'=>NULL,
                'jumlah_dibayar'=>NULL
            ],
            [
                'nisn'=>$siswa->nisn,
                'tgl_bayar'=>NULL,
                'bulan_dibayar'=>'November',
                'tahun_dibayar'=>NULL,
                'jumlah_dibayar'=>NULL
            ],
            [
                'nisn'=>$siswa->nisn,
                'tgl_bayar'=>NULL,
                'bulan_dibayar'=>'Desember',
                'tahun_dibayar'=>NULL,
                'jumlah_dibayar'=>NULL
            ],
        ];

        foreach ($tagihan as $key) {
            Pembayaran::create($key);
        }
    }

    /**
     * Handle the Siswa "updated" event.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return void
     */
    public function updated(Siswa $siswa)
    {
        //
    }

    /**
     * Handle the Siswa "deleted" event.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return void
     */
    public function deleted(Siswa $siswa)
    {
        //
        $hapusTagihan = Pembayaran::where('nisn','=',$siswa->nisn);
        $hapusTagihan->delete();
    }

    /**
     * Handle the Siswa "restored" event.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return void
     */
    public function restored(Siswa $siswa)
    {
        //
    }

    /**
     * Handle the Siswa "force deleted" event.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return void
     */
    public function forceDeleted(Siswa $siswa)
    {
        //
    }
}
