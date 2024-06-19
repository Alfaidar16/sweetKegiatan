<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use PDF;
use App\Models\GaleriKegiatan;
use Svg\Tag\Rect;
use Yajra\DataTables\Contracts\DataTable;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $auth = Auth::user()->id;
            $kegiatan = DB::table('galeri_kegiatan')
             ->leftJoin('users', 'galeri_kegiatan.users_id', '=', 'users.id')
           ->select('users.*', 'galeri_kegiatan.*')->where('users.id', $auth)
           ->orderBy('galeri_kegiatan.created_at', 'desc')
            ->get();
            return Datatables::of($kegiatan)
                ->addIndexColumn()->editColumn('narasi_kegiatan', function ($kegiatan) {
                    $action = '<td class="text-wrap">' . $kegiatan->narasi_kegiatan . '</td>';

                    return $action;
                })->editColumn('tanggal', function ($kegiatan) {
                    return \Carbon\Carbon::parse($kegiatan->tanggal)->format('d-m-Y');
                })->editColumn('image', function ($kegiatan) {
                    $imageFiles = explode(",", $kegiatan->image);
                    $imageTags = [];
                    foreach ($imageFiles as $file) {
                        $file = trim($file);
                        if ($file) {

                            $imageTags[] = '<img src="' . asset('upload/kegiatan/' . $file) . '" style="max-width: 100px; max-height: 100px; margin-right: 10px;">';
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
                        <button class="btn waves-effect waves-light btn-danger btn-sm" onclick="hapusKat(&quot;' . $kegiatan->id . '&quot;)">
                            <i class="bi bi-trash"></i>
                       </button>';
                    return $actionButton;
                })
                ->escapeColumns([])
                ->make(true);
        }

        $pekan =  DB::table('pekans')->get();
        $with = [
            'title' => 'Laporan',
            'pekan' => $pekan
        ];
        return view('Laporan.Index')->with($with);
    }


    public function filterByPekan(Request $request, $id) {

        $userId = Auth::user()->id;
        $data = DB::table('galeri_kegiatan')
        ->leftJoin('users', 'galeri_kegiatan.users_id', '=', 'users.id')->leftJoin('pekans', 'galeri_kegiatan.pekan_id', '=', 'pekans.id')
        ->select('users.*', 'pekans.*', 'galeri_kegiatan.*')
        ->where('users.id', $userId) // Filter berdasarkan ID pengguna yang sedang login
        ->where('galeri_kegiatan.pekan_id', $id) // Filter berdasarkan field pekan_id
        ->orderBy('galeri_kegiatan.created_at', 'desc')
        ->get();

        // dd($data);
       
        $pekan =  DB::table('pekans')->get();
        $with = [
            'title' => 'Laporan',
            'pekan' => $pekan,
            'datapekan' => $data
        ];
        return view('Laporan.DataPekan')->with($with);

    }


    public function downloadPdf(Request $request)
    {
        $request->validate([
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_awal',
        ]);
        $tanggal_awal = date('Y-m-d', strtotime($request->tanggal_awal));
        $tanggal_akhir = date('Y-m-d', strtotime($request->tanggal_akhir));
      
        $template = new \PhpOffice\PhpWord\TemplateProcessor(public_path("/templateWord/format-word.docx"));
    
        $tanggal = $request->tanggal_awal . ' s.d ' . $request->tanggal_akhir;
        $bidangId = Auth::user()->kode_bidang;
        $nama = 'Dinas Ketahanan Pangan';
        $kepalaBidang = 'Drs. ANDI MUHAMMAD ARSJAD, M.Si';
        if($bidangId != null ) {
            $bidang = DB::table('ms_bidangs')->where('kode_bidang', $bidangId)->first();

            if($bidang) {
                $nama = $bidang->nama_unit;
                $kepalaBidang = $bidang->kepala_bidang;
            }
        }
        $template->setValues(array('name' => $nama, 'tanggal' => $tanggal,  'kepalaBidang' => $kepalaBidang));
        $data = DB::table('galeri_kegiatan')
            ->leftJoin('users', 'galeri_kegiatan.users_id', '=', 'users.id')
            ->select('users.*', 'galeri_kegiatan.*')
            ->when($bidangId, function($qr, $bidangId) {
                return $qr->where('users.kode_bidang', $bidangId);
            })
            ->whereBetween('tanggal', [$tanggal_awal, $tanggal_akhir])
            ->get();

        $template->cloneBlock('block_name', $data->count(), true, true);
        foreach ($data as $index => $item) {
            $template->setValue('lokasi_kegiatan#' . $index + 1, $item->lokasi_kegiatan);
            $template->setValue('nama_kegiatan#' . $index + 1, $item->nama_kegiatan);
            $template->setValue('hari#' . $index + 1, getHari($item->hari));
            $template->setValue('narasi_kegiatan#' . $index + 1, strip_tags($item->narasi_kegiatan));
            $template->setValue('tanggal#' . $index + 1, date('d-m-Y', strtotime($item->tanggal)));
            $template->setValue('created_at#' . $index + 1, date('H:i', strtotime($item->created_at)));
            $template->setValue('dasar_pelaksanaan#' . $index + 1, strip_tags($item->dasar_pelaksanaan));
            // $template->setImageValue('image#'. $index+1,  array('path' => public_path('upload/kegiatan/'. $item->image), 'width' => 400, 'height' => 350, 'ratio' => true));
            $imageFiles = explode(",", $item->image);

             // Loop untuk menambahkan beberapa gambar ke dalam template
            $template->cloneBlock('block_nama#' . $index + 1,  count($imageFiles), true, true);
            foreach ($imageFiles as $imageIndex => $file) {
                $file = trim($file); // Menghapus spasi di sekitar nama file
                if ($file) {
                    // Membuat placeholder name, misalnya image1_1, image1_2, ...
                    $placeholder = 'foto#' . ($index + 1) . '#' . ($imageIndex + 1);

                    // Set image value di template
                    $template->setImageValue($placeholder, [
                        'path' => 'upload/kegiatan/' . $file,
                        'width' => 400,
                        'height' => 350,
                        'ratio' => true
                    ]);
                }
            }
        }

        $saveDocPath = 'new-result' . date("ymdhis") . '.docx';
        $template->saveAs($saveDocPath);

        $paramsUrl = url("new-result" . date("ymdhis") . ".docx");

        return redirect($paramsUrl);
    }

    public function dataPerpekan(Request $request)
    {
        $request->validate([
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_awal',
        ]);
        $startOfWeek = Carbon::parse($request->tanggal_awal)->startOfWeek()->toDateString();
        $endOfWeek = Carbon::parse($request->tanggal_akhir)->endOfWeek()->toDateString();

        $template = new \PhpOffice\PhpWord\TemplateProcessor(public_path("/templateWord/format-word.docx"));
        $tanggal = $request->tanggal_awal . ' s.d ' . $request->tanggal_akhir;
        $bidangId = Auth::user()->kode_bidang;
        $nama = 'Dinas Ketahanan Pangan';
        $kepalaBidang = 'Drs. ANDI MUHAMMAD ARSJAD, M.Si';
        if($bidangId != null ) {
            $bidang = DB::table('ms_bidangs')->where('kode_bidang', $bidangId)->first();

            if($bidang) {
                $nama = $bidang->nama_unit;
                $kepalaBidang = $bidang->kepala_bidang;
            }
        }
        $template->setValues(array('name' => $nama, 'tanggal' => $tanggal,  'kepalaBidang' => $kepalaBidang));
        
        $data = DB::table('galeri_kegiatan')
        ->leftJoin('users', 'galeri_kegiatan.users_id', '=', 'users.id')
        ->select('users.*', 'galeri_kegiatan.*')
        ->when($bidangId, function($qr, $bidangId) {
            return $qr->where('users.kode_bidang', $bidangId);
        })->whereBetween('tanggal', [$startOfWeek, $endOfWeek])->get();

       
        $template->cloneBlock('block_name', $data->count(), true, true);
        foreach ($data as $index => $item) {
            $template->setValue('lokasi_kegiatan#' . $index + 1, $item->lokasi_kegiatan);
            $template->setValue('nama_kegiatan#' . $index + 1, $item->nama_kegiatan);
            $template->setValue('hari#' . $index + 1, getHari($item->hari));
            $template->setValue('narasi_kegiatan#' . $index + 1, strip_tags($item->narasi_kegiatan));
            $template->setValue('tanggal#' . $index + 1, date('d-m-Y', strtotime($item->tanggal)));
            $template->setValue('created_at#' . $index + 1, date('H:i', strtotime($item->created_at)));
            $template->setValue('dasar_pelaksanaan#' . $index + 1, strip_tags($item->dasar_pelaksanaan));
            // $template->setImageValue('image#' . $index + 1,  array('path' => public_path('upload/kegiatan/' . $item->image), 'width' => 400, 'height' => 350, 'ratio' => true));

            $imageFiles = explode(",", $item->image);

            // Loop untuk menambahkan beberapa gambar ke dalam template
           $template->cloneBlock('block_nama#' . $index + 1,  count($imageFiles), true, true);
           foreach ($imageFiles as $imageIndex => $file) {
               $file = trim($file); // Menghapus spasi di sekitar nama file
               if ($file) {
                   // Membuat placeholder name, misalnya image1_1, image1_2, ...
                   $placeholder = 'foto#' . ($index + 1) . '#' . ($imageIndex + 1);

                   // Set image value di template
                   $template->setImageValue($placeholder, [
                       'path' => 'upload/kegiatan/' . $file,
                       'width' => 400,
                       'height' => 350,
                       'ratio' => true
                   ]);
               }
           }
        }
        $saveDocPath = 'new-result' . date("ymdhis") . '.docx';
        $template->saveAs($saveDocPath);

        $paramsUrl = url("new-result" . date("ymdhis") . ".docx");
        return redirect($paramsUrl);
    }

    public function dataBulan(Request $request)
    {
        $request->validate([
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_awal',
        ]);

        $startOfMonth = Carbon::createFromFormat('d-m-Y', $request->tanggal_awal)->startOfMonth()->toDateString();
        $endOfMonth = Carbon::createFromFormat('d-m-Y', $request->tanggal_akhir)->endOfMonth()->toDateString();

        $template = new \PhpOffice\PhpWord\TemplateProcessor(public_path("/templateWord/format-word.docx"));
        $tanggal = $request->tanggal_awal . ' s.d ' . $request->tanggal_akhir;
        $bidangId = Auth::user()->kode_bidang;
        $nama = 'Dinas Ketahanan Pangan';
        $kepalaBidang = 'Drs. ANDI MUHAMMAD ARSJAD, M.Si';
        if($bidangId != null ) {
            $bidang = DB::table('ms_bidangs')->where('kode_bidang', $bidangId)->first();

            if($bidang) {
                $nama = $bidang->nama_unit;
                $kepalaBidang = $bidang->kepala_bidang;
            }
        }
        $template->setValues(array('name' => $nama, 'tanggal' => $tanggal,  'kepalaBidang' => $kepalaBidang));
        

        $data = DB::table('galeri_kegiatan')
        ->leftJoin('users', 'galeri_kegiatan.users_id', '=', 'users.id')
        ->select('users.*', 'galeri_kegiatan.*')
        ->when($bidangId, function($qr, $bidangId) {
            return $qr->where('users.kode_bidang', $bidangId);
        })->whereBetween('tanggal', [$startOfMonth, $endOfMonth])->get();


        // dd($data);

        $template->cloneBlock('block_name', $data->count(), true, true);
        foreach ($data as $index => $item) {
            $template->setValue('lokasi_kegiatan#' . $index + 1, $item->lokasi_kegiatan);
            $template->setValue('nama_kegiatan#' . $index + 1, $item->nama_kegiatan);
            $template->setValue('hari#' . $index + 1, getHari($item->hari));
            $template->setValue('narasi_kegiatan#' . $index + 1, strip_tags($item->narasi_kegiatan));
            $template->setValue('tanggal#' . $index + 1, date('d-m-Y', strtotime($item->tanggal)));
            $template->setValue('created_at#' . $index + 1, date('H:i', strtotime($item->created_at)));
            $template->setValue('dasar_pelaksanaan#' . $index + 1, strip_tags($item->dasar_pelaksanaan));
            $template->setImageValue('image#' . $index + 1,  array('path' => public_path('upload/kegiatan/' . $item->image), 'width' => 400, 'height' => 350, 'ratio' => true));
            $imageFiles = explode(",", $item->image);

            // Loop untuk menambahkan beberapa gambar ke dalam template
           $template->cloneBlock('block_nama#' . $index + 1,  count($imageFiles), true, true);
           foreach ($imageFiles as $imageIndex => $file) {
               $file = trim($file); // Menghapus spasi di sekitar nama file
               if ($file) {
                   // Membuat placeholder name, misalnya image1_1, image1_2, ...
                   $placeholder = 'foto#' . ($index + 1) . '#' . ($imageIndex + 1);

                   // Set image value di template
                   $template->setImageValue($placeholder, [
                       'path' => 'upload/kegiatan/' . $file,
                       'width' => 400,
                       'height' => 350,
                       'ratio' => true
                   ]);
               }
           }
        }
        $saveDocPath = 'new-result' . date("ymdhis") . '.docx';
        $template->saveAs($saveDocPath);

        $paramsUrl = url("new-result" . date("ymdhis") . ".docx");
        return redirect($paramsUrl);
    }
}
