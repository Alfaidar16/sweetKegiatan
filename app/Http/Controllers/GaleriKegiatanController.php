<?php

namespace App\Http\Controllers;

use PDF;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB; 
use App\Http\Controllers\Controller;
use App\Models\GaleriKegiatan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class GaleriKegiatanController extends Controller
{
    public function Index(Request $request) {

        if ($request->ajax()) {
            $auth = Auth::user()->id;
            $kegiatan = DB::table('galeri_kegiatan')
             ->leftJoin('users', 'galeri_kegiatan.users_id', '=', 'users.id')->leftJoin('pekans', 'galeri_kegiatan.pekan_id', '=', 'pekans.id' )
           ->select('users.*', 'pekans.*', 'galeri_kegiatan.*')->where('users.id', $auth)
           ->orderBy('galeri_kegiatan.created_at', 'desc')
            ->get();
              return Datatables::of($kegiatan)
                ->addIndexColumn()->editColumn('narasi_kegiatan', function ($kegiatan) {
                    $action = '<td class="text-wrap">'. $kegiatan->narasi_kegiatan .'</td>';
                    return $action;
                })->editColumn('image', function($kegiatan) {          
                    $imageFiles = explode(",", $kegiatan->image);
                    $imageTags = [];
                    foreach ($imageFiles as $file) {
                        $file = trim($file); 
                        if ($file) {
                        
                            $imageTags[] = '<img src="' . asset('upload/kegiatan' . $file) . '" style="max-width: 100px; max-height: 100px; margin-right: 10px;">';
                        }
                    }
                    $imageString = implode('', $imageTags);
                    return $imageString ? $imageString : '-';
                 
                })
                ->editColumn('aksi', function ($kegiatan) {
                       $actionButton = '
                      <a href="' . route('kegiatan.edit', $kegiatan->slug) . '" class="btn waves-effect waves-light btn-success btn-sm">
                            <i class="bi bi-pencil-square"></i>
                       </a>
                        <button class="btn waves-effect waves-light btn-danger btn-sm" onclick="hapusKegiatan(&quot;' . $kegiatan->id . '&quot;)">
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
        $opd = DB::table('opd')->get();
        $with = [ 
            'title' => 'Tambah Kegiatan',
            'opd' => $opd
        ];

        return view('GaleriKegiatan.Create')->with($with);
    }

    public function store(Request $request) {
        // dd($request->all());
        $dir = 'upload/kegiatan';
        $dok = 'upload/file';
        $this->validate($request, [
            'nama_kegiatan' => 'required|string|max:255',
            'dasar_pelaksanaan' => 'required|string|max:255',
            'image1' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4048',
            'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4048',
            'image3' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4048', // Validasi untuk file gambar
            'lokasi_kegiatan' => 'required|string|max:255',
            'dokumen' => 'required|file|mimes:pdf,doc,docx|max:10240', // Validasi untuk file dokumen
            'narasi_kegiatan' => 'required',
            'pekan' => 'required'
        ], [
            'nama_kegiatan.required' => 'Nama kegiatan harus diisi.',
            'nama_kegiatan.string' => 'Nama kegiatan harus berupa teks.',
            'nama_kegiatan.max' => 'Nama kegiatan tidak boleh lebih dari 255 karakter.',
            'dasar_pelaksanaan.required' => 'Wajib Di Isi',
            'image1.required' => 'Gambar Pertama Wajib Diisi',
            'image2.nullable' => 'Gambar kegiatan boleh Kosong.',
            'image3.nullable' => 'Gambar kegiatan boleh Kosong.',
            'image.image' => 'File yang diunggah harus berupa gambar.',
            'image.mimes' => 'Gambar harus berformat jpeg, png, jpg, gif, atau svg.',
            'image.max' => 'Ukuran gambar tidak boleh lebih dari 2MB.',
            'lokasi_kegiatan.required' => 'Lokasi kegiatan harus diisi.',
            'lokasi_kegiatan.string' => 'Lokasi kegiatan harus berupa teks.',
            'lokasi_kegiatan.max' => 'Lokasi kegiatan tidak boleh lebih dari 255 karakter.',
            'dokumen.required' => 'Dokumen kegiatan harus diunggah.',
            'dokumen.file' => 'Dokumen harus berupa file.',
            'dokumen.mimes' => 'Dokumen harus berformat pdf, doc, atau docx.',
            'dokumen.max' => 'Ukuran dokumen tidak boleh lebih dari 10MB.',
            'narasi_kegiatan.required' => 'Narasi kegiatan harus diisi.',
            'narasi_kegiatan.string' => 'Narasi kegiatan harus berupa teks.',
            'pekan.required' => 'Laporan Pekan Wajib Di Isi'
        ]);

        $imagePaths = [];

        // Simpan gambar pertama
        if ($request->hasFile('image1')) {
            $image1 = $request->file('image1');
            $imageName1 = time() . '_' . $image1->getClientOriginalName();
            $image1->move(public_path($dir), $imageName1);
            $imagePaths[] =  $imageName1;
        }

        // Simpan gambar kedua
        if ($request->hasFile('image2')) {
            $image2 = $request->file('image2');
            $imageName2 = time() . '_' . $image2->getClientOriginalName();
            $image2->move(public_path($dir), $imageName2);
            $imagePaths[] =  $imageName2;
        }

        // Simpan gambar ketiga
        if ($request->hasFile('image3')) {
            $image3 = $request->file('image3');
            $imageName3 = time() . '_' . $image3->getClientOriginalName();
            $image3->move(public_path($dir), $imageName3);
            $imagePaths[] =  $imageName3;
        }

        // Gabungkan path gambar menjadi satu string
        $imagePathsString = implode(',', $imagePaths);



        $dokumen =  $request->file('dokumen');
        $dokumenName = time() . $dokumen->getClientOriginalName();
        $dokumen->move(public_path($dok), $dokumenName);

        DB::table('galeri_kegiatan')->insert([
            'nama_kegiatan' => $request->nama_kegiatan,
            'lokasi_kegiatan' => $request->lokasi_kegiatan,
            'narasi_kegiatan' => $request->narasi_kegiatan,
            'dasar_pelaksanaan' => $request->dasar_pelaksanaan,
            'image' => $imagePathsString ,
            'dokumen' => $dokumenName,
            'slug'  => Str::slug($request->nama_kegiatan),
            'users_id' => Auth::user()->id,
            'hari' => date('l'),
            'pekan_id' =>  $request->pekan,
            'tanggal' => date('Y-m-d'),
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        toast('success', 'Data Berhasil DiTambahkan');
        return redirect()->route('kegiatan');
    }

    public function edit($slug) {
        $kegiatan = DB::table('galeri_kegiatan')->where('slug', $slug)->first();
        $opd = DB::table('opd')->get();
        $with = [ 
            'title' => 'Edit Kegiatan',
            'kegiatan' => $kegiatan,
            'opd' => $opd
        ];

        return view('GaleriKegiatan.Edit')->with($with);
    }


    public function update(Request $request, $id) {
        $dir = 'upload/kegiatan';
        $dok = 'upload/file';
        $this->validate($request, [
            'nama_kegiatan' => 'required|string|max:255',
            'dasar_pelaksanaan' => 'required|string|max:255',
            'image1' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4048',
            'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4048',
            'image3' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4048', // Validasi untuk file gambar
            'lokasi_kegiatan' => 'required|string|max:255',
            'dokumen' => 'required|file|mimes:pdf,doc,docx|max:10240', // Validasi untuk file dokumen
            'narasi_kegiatan' => 'required',
            'pekan' => 'required'
        ], [
            'nama_kegiatan.required' => 'Nama kegiatan harus diisi.',
            'nama_kegiatan.string' => 'Nama kegiatan harus berupa teks.',
            'nama_kegiatan.max' => 'Nama kegiatan tidak boleh lebih dari 255 karakter.',
            'dasar_pelaksanaan.required' => 'Wajib Di Isi',
            'image1.required' => 'Gambar Pertama Wajib Diisi',
            'image2.nullable' => 'Gambar kegiatan boleh Kosong.',
            'image3.nullable' => 'Gambar kegiatan boleh Kosong.',
            'image.image' => 'File yang diunggah harus berupa gambar.',
            'image.mimes' => 'Gambar harus berformat jpeg, png, jpg, gif, atau svg.',
            'image.max' => 'Ukuran gambar tidak boleh lebih dari 2MB.',
            'lokasi_kegiatan.required' => 'Lokasi kegiatan harus diisi.',
            'lokasi_kegiatan.string' => 'Lokasi kegiatan harus berupa teks.',
            'lokasi_kegiatan.max' => 'Lokasi kegiatan tidak boleh lebih dari 255 karakter.',
            'dokumen.required' => 'Dokumen kegiatan harus diunggah.',
            'dokumen.file' => 'Dokumen harus berupa file.',
            'dokumen.mimes' => 'Dokumen harus berformat pdf, doc, atau docx.',
            'dokumen.max' => 'Ukuran dokumen tidak boleh lebih dari 10MB.',
            'narasi_kegiatan.required' => 'Narasi kegiatan harus diisi.',
            'narasi_kegiatan.string' => 'Narasi kegiatan harus berupa teks.',
             'pekan.required' => 'Pekan Wajbi Di Isi'
        ]);
      // Simpan gambar pertama
      if ($request->hasFile('image1')) {
        $image1 = $request->file('image1');
        $imageName1 = time() . '_' . $image1->getClientOriginalName();
        $image1->move(public_path($dir), $imageName1);
        $imagePaths[] =  $imageName1;
    }

    // Simpan gambar kedua
    if ($request->hasFile('image2')) {
        $image2 = $request->file('image2');
        $imageName2 = time() . '_' . $image2->getClientOriginalName();
        $image2->move(public_path($dir), $imageName2);
        $imagePaths[] =  $imageName2;
    }

    // Simpan gambar ketiga
    if ($request->hasFile('image3')) {
        $image3 = $request->file('image3');
        $imageName3 = time() . '_' . $image3->getClientOriginalName();
        $image3->move(public_path($dir), $imageName3);
        $imagePaths[] =  $imageName3;
    }

    // Gabungkan path gambar menjadi satu string
    $imagePathsString = implode(',', $imagePaths);


        $dokumen =  $request->file('dokumen');
        $dokumenName = time() . $dokumen->getClientOriginalName();
        $dokumen->move(public_path($dok), $dokumenName);

        DB::table('galeri_kegiatan')->where('id', $id)->update([
            'nama_kegiatan' => $request->nama_kegiatan,
            'lokasi_kegiatan' => $request->lokasi_kegiatan,
            'narasi_kegiatan' => $request->narasi_kegiatan,
            'dasar_pelaksanaan' => $request->dasar_pelaksanaan,
            'image' =>  $imagePathsString,
            'dokumen' => $dokumenName,
            'slug'  => Str::slug($request->nama_kegiatan),
            'users_id' => Auth::user()->id,
            'hari' => date('l'),
            'pekan_id' =>  $request->pekan,
            'tanggal' => date('Y-m-d'),
            'created_at' => date('Y-m-d H:i:s'),
        
        ]);
        toast('success', 'Data Berhasil DiUpdate');
        return redirect()->route('kegiatan');
    }


    public function destroy(Request $request) {
        $id = $request->id;
        DB::table('galeri_kegiatan')->where('id', $id)->delete();
        toast('success', 'Data Berhasil DiHapus');
        return redirect()->route('kegiatan');
    }

   
}
