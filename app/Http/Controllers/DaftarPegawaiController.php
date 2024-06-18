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
        ->leftJoin('users', 'ms_bidangs.kode_bidang', '=', 'users.kode_bidang')
        ->leftJoin('galeri_kegiatan', 'galeri_kegiatan.users_id', 'users.id')
        ->leftJoin('pekans', 'galeri_kegiatan.pekan_id', 'pekans.id')
        ->where('ms_bidangs.kode_bidang', $kode_bidang)
        ->select( 'users.id', 'pekans.pekan', 'galeri_kegiatan.bulan', 'galeri_kegiatan.pekan_id',   'ms_bidangs.nama_unit', 'users.name')
        ->get();

        // $groupedData = $dataPegawai->groupBy('pekan_id');

        // $dataPegawai = DB::table('ms_bidangs')
        // ->leftJoin('users', 'ms_bidangs.kode_bidang', '=', 'users.kode_bidang')
        // ->where('ms_bidangs.kode_bidang', $kode_bidang)
        // ->select( 'users.id',    'ms_bidangs.nama_unit', 'users.name')
        // ->get();
        // dd($tes);
        
        // dd($groupedData);
        $with = [ 
            'title' => 'Daftar Pegawai',
            'datas' => $dataPegawai,
            'jBidang' => $titleBidang
        ];
        return view('DaftarPegawai.Index')->with($with);
    }

    public function detailPekan($id) {
       

       

    // Group the data by pekan_id
    // $groupedData = $dataPegawai->groupBy('pekan_id');

        // dd($groupedData);
    }
}
