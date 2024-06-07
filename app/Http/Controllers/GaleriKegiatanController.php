<?php

namespace App\Http\Controllers;

use PDF;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB; 
use App\Http\Controllers\Controller;
use App\Models\GaleriKegiatan;
use Illuminate\Support\Str;

class GaleriKegiatanController extends Controller
{
    public function Index(Request $request) {

        if ($request->ajax()) {
            $kegiatan = DB::table('galeri_kegiatan')
             ->leftJoin('opd', 'galeri_kegiatan.opd_id', '=', 'opd.id')
           ->select('opd.*', 'galeri_kegiatan.*')
           ->orderBy('galeri_kegiatan.created_at', 'desc')
            ->get();
              return Datatables::of($kegiatan)
                ->addIndexColumn()->editColumn('narasi_kegiatan', function ($kegiatan) {
                    $action = '<td class="text-wrap">'. $kegiatan->narasi_kegiatan .'</td>';

                    return $action;
                })->editColumn('image', function($kegiatan) {
                    $gambar = '
                      <td><img src="('. asset('upload/kegiatan/' . $kegiatan->image).')"</td>';
                    return $gambar;
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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4048', // Validasi untuk file gambar
            'lokasi_kegiatan' => 'required|string|max:255',
            'dokumen' => 'required|file|mimes:pdf,doc,docx|max:10240', // Validasi untuk file dokumen
            'narasi_kegiatan' => 'required',
        ], [
            'nama_kegiatan.required' => 'Nama kegiatan harus diisi.',
            'nama_kegiatan.string' => 'Nama kegiatan harus berupa teks.',
            'nama_kegiatan.max' => 'Nama kegiatan tidak boleh lebih dari 255 karakter.',
            'dasar_pelaksanaan.required' => 'Wajib Di Isi',
            'image.required' => 'Gambar kegiatan harus diunggah.',
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
        ]);
        $image = $request->file('image');
        $imageName = time() . $image->getClientOriginalName();
        $image->move(public_path($dir), $imageName);

        $dokumen =  $request->file('dokumen');
        $dokumenName = time() . $dokumen->getClientOriginalName();
        $dokumen->move(public_path($dok), $dokumenName);

        DB::table('galeri_kegiatan')->insert([
            'nama_kegiatan' => $request->nama_kegiatan,
            'lokasi_kegiatan' => $request->lokasi_kegiatan,
            'narasi_kegiatan' => $request->narasi_kegiatan,
            'dasar_pelaksanaan' => $request->dasar_pelaksanaan,
            'image' => $imageName,
            'dokumen' => $dokumenName,
            'slug'  => Str::slug($request->nama_kegiatan),
            'opd_id' => $request->opd_id,
            'hari' => date('l'),
            'url' =>  $request->url,
            'tanggal' => date('d-m-Y'),
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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4048', // Validasi untuk file gambar
            'lokasi_kegiatan' => 'required|string|max:255',
            'dokumen' => 'required|file|mimes:pdf,doc,docx|max:10240', // Validasi untuk file dokumen
            'narasi_kegiatan' => 'required',
        ], [
            'nama_kegiatan.required' => 'Nama kegiatan harus diisi.',
            'nama_kegiatan.string' => 'Nama kegiatan harus berupa teks.',
            'nama_kegiatan.max' => 'Nama kegiatan tidak boleh lebih dari 255 karakter.',
            'dasar_pelaksanaan.required' => 'Wajib Di Isi',
            'image.required' => 'Gambar kegiatan harus diunggah.',
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
        ]);
        $image = $request->file('image');
        $imageName = time() . $image->getClientOriginalName();
        $image->move(public_path($dir), $imageName);

        $dokumen =  $request->file('dokumen');
        $dokumenName = time() . $dokumen->getClientOriginalName();
        $dokumen->move(public_path($dok), $dokumenName);

        DB::table('galeri_kegiatan')->where('id', $id)->update([
            'nama_kegiatan' => $request->nama_kegiatan,
            'lokasi_kegiatan' => $request->lokasi_kegiatan,
            'narasi_kegiatan' => $request->narasi_kegiatan,
            'dasar_pelaksanaan' => $request->dasar_pelaksanaan,
            'image' => $imageName,
            'dokumen' => $dokumenName,
            'slug'  => Str::slug($request->nama_kegiatan),
            'opd_id' => $request->opd_id,
            'hari' => date('l'),
            'url' =>  $request->url,
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

    public function generatePdf($id) {
        // $data = [
        //     'title' => 'Laporan Kegiatan',
        //     'date' => date('m/d/Y'),
        //     'activities' => [
        //         [
        //             'no' => 1,
        //             'kegiatan' => 'Mempersiapkan dan Menghadiri Undangan Apel Pagi Bersama Pj Gubernur Sulawesi Selatan',
        //             'dasar_pelaksanaan' => 'Surat Pj. Sekretariat Daerah Provinsi Sulawesi Selatan Nomor: 800.1.6.2/6728BKD, Tanggal 26 Mei 2024.',
        //             'uraian' => 'Apel Bersama Penjabat Gubernur Sulawesi Selatan Prof. Dr. Zudan Arif Fakhrulloh S.H, M.H Dengan Seluruh OPD Lingkup Pemerintah Provinsi Sulawesi Selatan Secara Virtual Melalui Media Zoom Meeting.',
        //             'images' => [
        //                 '/TemplateDashboard/assets/design/images/transparent-img1.png',
        //                 '/TemplateDashboard/assets/design/images/transparent-img1.png'
        //             ]
        //         ],
        //         // Tambahkan kegiatan lainnya jika ada
        //     ]
        // ];

        // $pdf = PDF::loadView('Auth.laporan_kegiatan', $data);

        // return $pdf->download('laporan_kegiatan');

       
        $template = new \PhpOffice\PhpWord\TemplateProcessor(public_path("format-word.docx"));

        $template->setValue('opd', 'jsndjsnd');
       
        $saveDocPath = public_path('new-result' . date("ymdhis") . '.docx');
        $template->saveAs($saveDocPath);

        $paramsUrl = url("new-result" . date("ymdhis") . ".docx");
        
       

        return redirect($paramsUrl);
    }
}
