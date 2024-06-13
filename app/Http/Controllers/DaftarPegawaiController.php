<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use Yajra\DataTables\DataTables;

class DaftarPegawaiController extends Controller
{
    public function index(Request $request, $kode_bidang) {
      
        $titleBidang = DB::table('ms_bidangs')->where('kode_bidang', $kode_bidang)->first();
        $dataPegawai = DB::table('ms_bidangs')
        ->leftJoin('users', 'ms_bidangs.kode_bidang', '=', 'users.kode_bidang')->leftJoin('galeri_kegiatan', 'galeri_kegiatan.users_id', '=', 'users.id')
        ->where('ms_bidangs.kode_bidang', $kode_bidang)
        ->select( 'users.*',  'galeri_kegiatan.*', 'ms_bidangs.*')
        ->get();

    //    $dataPegawai = DB::table('ms_bidangs')
    //         ->leftJoin('users', 'ms_bidangs.kode_bidang', '=', 'users.kode_bidang')
    //         ->leftJoin('galeri_kegiatan', 'galeri_kegiatan.users_id', '=', 'users.id')
    //         ->where('ms_bidangs.kode_bidang', $kode_bidang)
    //         ->select('users.id as user_id', 'users.name', 'ms_bidangs.nama_bidang', 'galeri_kegiatan.bulan', 'galeri_kegiatan.kegiatan')
    //         ->orderBy('galeri_kegiatan.created_at', 'desc')
    //         ->groupBy('users.id') // Mengelompokkan berdasarkan user ID
    //         ->first();

    // $dataPegawai = DB::table('ms_bidangs')
    // ->leftJoin('users', 'ms_bidangs.kode_bidang', '=', 'users.kode_bidang')
    // ->leftJoin('galeri_kegiatan', 'galeri_kegiatan.users_id', '=', 'users.id')
    // ->where('ms_bidangs.kode_bidang', $kode_bidang)
    // ->select('users.id as users_id', 'users.name', 'ms_bidangs.nama_unit', 'galeri_kegiatan.bulan', 'galeri_kegiatan.nama_kegiatan')
    // ->orderBy('galeri_kegiatan.created_at', 'desc')
    // ->groupBy('users.id') // Mengelompokkan berdasarkan user ID
    // ->first();

        // dd($dataPegawai);
        $with = [ 
            'title' => 'Daftar Pegawai',
            'datas' => $dataPegawai,
            'jBidang' => $titleBidang
        ];
        return view('DaftarPegawai.Index')->with($with);
    }
}
