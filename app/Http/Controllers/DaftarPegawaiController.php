<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;

class DaftarPegawaiController extends Controller
{
    public function index(Request $request, $kode_bidang) {
      
        $titleBidang = DB::table('ms_bidangs')->where('kode_bidang', $kode_bidang)->first();
        // $dataPegawai = DB::table('ms_bidangs')
        // ->leftJoin('users', 'ms_bidangs.kode_bidang', '=', 'users.kode_bidang')
        // ->leftJoin('galeri_kegiatan', 'galeri_kegiatan.users_id', 'users.id')
        // ->leftJoin('pekans', 'galeri_kegiatan.pekan_id', 'pekans.id')
        // ->where('ms_bidangs.kode_bidang', $kode_bidang)
        // ->select( 'users.id', 'pekans.pekan', 'galeri_kegiatan.bulan', 'galeri_kegiatan.pekan_id',   'ms_bidangs.nama_unit', 'users.name')
        // ->get();

        
        $dataPegawai = DB::table('galeri_kegiatan')
            ->leftJoin('users', 'galeri_kegiatan.users_id', '=', 'users.id')
            ->leftJoin('ms_bidangs', 'users.kode_bidang', '=', 'ms_bidangs.kode_bidang')
            ->select('users.name', 'galeri_kegiatan.bulan', 'galeri_kegiatan.pekan_id', 'galeri_kegiatan.users_id')
            ->where('ms_bidangs.kode_bidang', '=', $kode_bidang)
            ->get();

        // dd($cek);
        
        // dd($groupedData);
        $with = [ 
            'title' => 'Daftar Pegawai',
            'datas' => $dataPegawai,
            'jBidang' => $titleBidang
        ];
        return view('DaftarPegawai.Index')->with($with);
    }

    public function detailPekan($users_id, $pekan_id) {
       

        // $userId = Auth::user()->id;
      
        $data = DB::table('galeri_kegiatan')
        ->leftJoin('users', 'galeri_kegiatan.users_id', '=', 'users.id')
        ->leftJoin('ms_bidangs', 'users.kode_bidang', '=', 'ms_bidangs.kode_bidang')
        ->leftJoin('pekans', 'galeri_kegiatan.pekan_id', '=', 'pekans.id')
        ->select('users.name', 'ms_bidangs.nama_unit', 'pekans.pekan', 'galeri_kegiatan.*')
        ->where('users.id', $users_id)
        ->where('galeri_kegiatan.pekan_id', $pekan_id)
        ->orderBy('galeri_kegiatan.created_at', 'desc')
        ->get();

        $with = [
            'title' => 'Informasi Perpekan',
            'dataPerpekan' => $data
        ];

        return view('DaftarPegawai.InformasiPerpekan')->with($with);
        

    // Group the data by pekan_id
    // $groupedData = $dataPegawai->groupBy('pekan_id');

        // dd($groupedData);
    }
}
