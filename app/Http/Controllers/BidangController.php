<?php

namespace App\Http\Controllers;

use App\Models\Bidang;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

class BidangController extends Controller
{
    public function index(Request $request)
    {
            if ($request->ajax()) {
                // $bidang =  DB::table('ms_bidangs')->get();
                $bidang = DB::table('ms_bidangs')
                ->where(DB::raw('SUBSTRING(kode_bidang, -2)'), '00')
                ->get();

                return Datatables::of($bidang)->addIndexColumn()
                ->editColumn('aksi', function ($bidang) {
                    $actionButton = '
                    <a href="' . route('bidang.edit', $bidang->id) . '" class="btn waves-effect waves-light btn-success btn-sm">
                    <i class="bi bi-pencil-square"></i>
               </a>
                  </button>
                     <button class="btn waves-effect waves-light btn-danger btn-sm" onclick="hapusBidang(&quot;' . $bidang->id . '&quot;)">
                         <i class="bi bi-trash"></i>
                    </button>';
                    return $actionButton; 
                })->escapeColumns([])
                    ->make(true);
            }
        $with = [
            'title' => 'Data Bidang',
        ]; 
        return view('Bidang.Index')->with($with);
    }


    public function create() {
        $with = [
            'title' => 'Data Bidang'
        ];
        return view('Bidang.Create')->with($with);
    }


    public function store(Request $request) {
        $this->validate($request, [
            'nama_unit' =>'required|unique:ms_bidangs,nama_unit',
            'kode_bidang' =>'required|min:10|max:10|unique:ms_bidangs,kode_bidang'
        ], [
            'nama_unit.required' => 'Nama Bidang Wajib Di Isi',
            'kode_bidang.required' => 'Kode Bidang Wajib Di Isi',
            'nama_unit.unique' => 'Nama Bidang sudah ada',
            'kode_bidang.unique' => 'Kode Bidang sudah ada',
            'kode_bidang.min' => 'Kode Bidang Minimal 10 Karakter',
            'kode_bidang.max' => 'Kode Bidang Maksimal 10 Karakter'
        ]);
     
        DB::table('ms_bidangs')->insert([
            'nama_unit' => $request->nama_unit,
            'kode_bidang' => $request->kode_bidang,
            'tingkatan' => 'Sub Unit Kerja',
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        toast('success', 'Data Berhasil DiTambahkan');
        return redirect()->route('bidang.index');
    }

    public function edit($id) {
        $bidang = DB::table('ms_bidangs')->where('id', $id)->first();
        $with = [
            'title' => 'Data Bidang',
            'bidang' => $bidang
        ];
        return view('Bidang.Edit')->with($with);
    }

    public function update(Request $request, $id) {
        $this->validate($request, [
            'nama_unit' =>'required|unique:ms_bidangs,nama_unit',
            'kode_bidang' =>'required|min:10|max:10|'
        ], [
            'nama_unit.required' => 'Nama Bidang Wajib Di Isi',
            'kode_bidang.required' => 'Kode Bidang Wajib Di Isi',
            'nama_unit.unique' => 'Nama Bidang sudah ada',
            'kode_bidang.unique' => 'Kode Bidang sudah ada',
            'kode_bidang.min' => 'Kode Bidang Minimal 10 Karakter',
            'kode_bidang.max' => 'Kode Bidang Maksimal 10 Karakter'
        ]);
      
        // $cek =  [
        //     'nama_unit' => $request->nama_unit,
        //     'kode_bidang' => $request->kode_bidang,
        //     'tingkatan' => 'Sub Unit Kerja',
        //     'created_at' => date('Y-m-d H:i:s'),
        // ];

        // dd($cek);
         
        DB::table('ms_bidangs')->where('id', $id)->update([
            'nama_unit' => $request->nama_unit,
            'kode_bidang' => $request->kode_bidang,
            'tingkatan' => 'Sub Unit Kerja',
            'created_at' => date('Y-m-d H:i:s'),
            ]);
            toast('success', 'Data Berhasil DiUpdate');
            return redirect()->route('bidang.index');
    }

    public function destroy(Request $request) {
        $id = $request->id;
        DB::table('ms_bidangs')->where('id', $id)->delete();
        toast('success', 'Data Berhasil DiHapus');
        return redirect()->route('bidang.index');
    }
}
