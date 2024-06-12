<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use Yajra\DataTables\DataTables;

class DaftarPegawaiController extends Controller
{
    public function index(Request $request, $kode_bidang) {
      
        $dataPegawai = DB::table('ms_bidangs')
        ->leftJoin('users', 'ms_bidangs.kode_bidang', '=', 'users.kode_bidang')
        ->where('ms_bidangs.kode_bidang', $kode_bidang)
        ->select('ms_bidangs.*', 'users.*')
        ->get();
        // if ($request->ajax()) {
        //     $dataPegawai = DB::table('ms_bidangs')
        //     ->leftJoin('users', 'ms_bidangs.kode_bidang', '=', 'users.kode_bidang')
        //     ->where('ms_bidangs.kode_bidang', $kode_bidang)
        //     ->select('ms_bidangs.*', 'users.*')
        //     ->get();
        //       return Datatables::of($dataPegawai)
        //         ->addIndexColumn()
        //         ->editColumn('aksi', function ($dataPegawai) {
        //                $actionButton = '
        //               <a href="#" class="btn waves-effect waves-light btn-success btn-sm">
        //                     <i class="bi bi-pencil-square"></i>
        //                </a>
        //                 <button class="btn waves-effect waves-light btn-danger btn-sm" onclick="hapusUser(&quot;' . $dataPegawai->id . '&quot;)">
        //                     <i class="bi bi-trash"></i>
        //                </button>';
        //                return $actionButton;
                     
        //            })
        //            ->escapeColumns([])
        //            ->make(true);
        //    }
        $with = [ 
            'title' => 'Daftar Pegawai',
            'datas' => $dataPegawai
        ];
        return view('DaftarPegawai.Index')->with($with);
    }
}
