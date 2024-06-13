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
        ->where('ms_bidangs.kode_bidang', $kode_bidang)
        ->select('ms_bidangs.*', 'users.*')
        ->get();
        $with = [ 
            'title' => 'Daftar Pegawai',
            'datas' => $dataPegawai,
            'jBidang' => $titleBidang
        ];
        return view('DaftarPegawai.Index')->with($with);
    }
}
