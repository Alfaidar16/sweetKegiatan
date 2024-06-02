<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB; 

class GaleriKegiatanController extends Controller
{
    public function Index(Request $request) {

        if ($request->ajax()) {
            $kategoriBerita = DB::table('galeri_kegiatan')
             ->leftJoin('opd', 'galeri_kegiatan.opd_id', '=', 'opd.id')
           ->select('opd.*', 'galeri_kegiatan.*')
           ->orderBy('galeri_kegiatan.created_at', 'desc')
            ->get();
              return Datatables::of($kategoriBerita)
                ->addIndexColumn()->editColumn('aksi', function ($kategoriBerita) {
                       $actionButton = '
                      <a href="' . route('edit-kategori', $kategoriBerita->slug) . '" class="btn waves-effect waves-light btn-success btn-sm">
                            <i class="bi bi-pencil-square"></i>
                       </a>
                        <button class="btn waves-effect waves-light btn-danger btn-sm" onclick="hapusKat(&quot;' . $kategoriBerita->id . '&quot;)">
                            <i class="bi bi-trash"></i>
                       </button>';
                       return $actionButton;
                     
                   })
                   ->escapeColumns([])
                   ->make(true);
           }
        $with = [ 
            'title' => 'Data Kegiatan'
        ];

        return view('GaleriKegiatan.Index')->with($with);
    }

    public function create() {
        $with = [ 
            'title' => 'Tambah Kegiatan'
        ];

        return view('GaleriKegiatan.Create')->with($with);
    }
}
