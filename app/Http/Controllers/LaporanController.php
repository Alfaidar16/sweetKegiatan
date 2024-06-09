<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB; 
use Carbon\Carbon;
use PDF;
use App\Models\GaleriKegiatan;
use Svg\Tag\Rect;

class LaporanController extends Controller
{
     public function index(Request $request) {
        if ($request->ajax()) {
            $kegiatan = DB::table('galeri_kegiatan')
             ->leftJoin('users', 'galeri_kegiatan.users_id', '=', 'users.id')
           ->select('users.*', 'galeri_kegiatan.*')
           ->orderBy('galeri_kegiatan.tanggal', 'DESC')
            ->get();
              return Datatables::of($kegiatan)
                ->addIndexColumn()->editColumn('narasi_kegiatan', function ($kegiatan) {
                    $action = '<td class="text-wrap">'. $kegiatan->narasi_kegiatan .'</td>';

                    return $action;
                })->editColumn('tanggal', function($kegiatan) {
                    return \Carbon\Carbon::parse($kegiatan->tanggal)->format('d-m-Y');
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
                        <button class="btn waves-effect waves-light btn-danger btn-sm" onclick="hapusKat(&quot;' . $kegiatan->id . '&quot;)">
                            <i class="bi bi-trash"></i>
                       </button>';
                       return $actionButton;
                     
                   })
                   ->escapeColumns([])
                   ->make(true);
           }
        $with = [ 
            'title' => 'Laporan'
        ];
        return view('Laporan.Index')->with($with);
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
        $replacements = [];

        $data = DB::table('galeri_kegiatan')->leftJoin('users_id', 'galeri_kegiatan.users_id', '=', 'users.id')
        ->select('users.*', 'galeri_kegiatan.*')->whereBetween('tanggal', [$tanggal_awal, $tanggal_akhir])->get();
        $template->cloneBlock('block_name', $data->count(), true, true);
        foreach($data as $index => $item) {
            $template->setValue('lokasi_kegiatan#' . $index+1, $item->lokasi_kegiatan);
            $template->setValue('nama_kegiatan#' . $index+1, $item->nama_kegiatan);
            $template->setValue('hari#' . $index+1, getHari($item->hari));
            $template->setValue('narasi_kegiatan#' . $index+1, strip_tags($item->narasi_kegiatan));
            $template->setValue('tanggal#' . $index+1, date('d-m-Y', strtotime($item->tanggal)));
            $template->setValue('created_at#' . $index+1, date('H:i', strtotime($item->created_at)));
            $template->setValue('dasar_pelaksanaan#' . $index+1, strip_tags($item->dasar_pelaksanaan));
            $template->setImageValue('image#'. $index+1,  array('path' => public_path('upload/kegiatan/'. $item->image), 'width' => 400, 'height' => 350, 'ratio' => true));
        }
       
        $saveDocPath = public_path('new-result' . date("ymdhis") . '.docx');
        $template->saveAs($saveDocPath);

        $paramsUrl = url("new-result" . date("ymdhis") . ".docx");

        return redirect($paramsUrl);

      
     }

     public function dataPerpekan(Request $request) {
        $request->validate([
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_awal',
        ]);
        $startOfWeek = Carbon::parse($request->tanggal_awal)->startOfWeek()->toDateString();
        $endOfWeek= Carbon::parse($request->tanggal_akhir)->endOfWeek()->toDateString();
      
        $template = new \PhpOffice\PhpWord\TemplateProcessor(public_path("/templateWord/format-word.docx"));

        
        $replacements = [];

        $data = DB::table('galeri_kegiatan')->leftJoin('users', 'galeri_kegiatan.users_id', '=', 'users.id')
        ->select('users.*', 'galeri_kegiatan.*')->whereBetween('tanggal', [$startOfWeek, $endOfWeek])->get();

        dd($data);
        $template->cloneBlock('block_name', $data->count(), true, true);
        foreach($data as $index => $item) {
            $template->setValue('lokasi_kegiatan#' . $index+1, $item->lokasi_kegiatan);
            $template->setValue('nama_kegiatan#' . $index+1, $item->nama_kegiatan);
            $template->setValue('hari#' . $index+1, getHari($item->hari));
            $template->setValue('narasi_kegiatan#' . $index+1, strip_tags($item->narasi_kegiatan));
            $template->setValue('tanggal#' . $index+1, date('d-m-Y', strtotime($item->tanggal)));
            $template->setValue('created_at#' . $index+1, date('H:i', strtotime($item->created_at)));
            $template->setValue('dasar_pelaksanaan#' . $index+1, strip_tags($item->dasar_pelaksanaan));
            $template->setImageValue('image#'. $index+1,  array('path' => public_path('upload/kegiatan/'. $item->image), 'width' => 400, 'height' => 350, 'ratio' => true));
        }
        $saveDocPath = public_path('new-result' . date("ymdhis") . '.docx');
        $template->saveAs($saveDocPath);

        $paramsUrl = url("new-result" . date("ymdhis") . ".docx");
        return redirect($paramsUrl);
     }
 
    //  private function getDailyActivities()
    //  {
    //      $today = Carbon::today()->toDateString();
    //      return DB::table('galeri_kegiatan')
    //          ->whereDate('tanggal', $today)
    //          ->get();
    //  }
 
    //  private function getWeeklyActivities()
    //  {
    //      $startOfWeek = Carbon::now()->startOfWeek()->toDateString();
    //      $endOfWeek = Carbon::now()->endOfWeek()->toDateString();
    //      return DB::table('galeri_kegiatan')
    //          ->whereBetween('tanggal', [$startOfWeek, $endOfWeek])
    //          ->get();
    //  }

     public function dataBulan(Request $request) {
        $request->validate([
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_awal',
        ]);
        // $tanggal_awal = date('Y-m-d', strtotime($request->tanggal_awal));
        // $tanggal_akhir = date('Y-m-d', strtotime($request->tanggal_akhir));
        $startOfMonth = Carbon::parse($request->tanggal_awal)->startOfMonth()->toDateString();
        $endOfMonth = Carbon::parse($request->tanggal_akhir)->endOfMonth()->toDateString();
      
        $template = new \PhpOffice\PhpWord\TemplateProcessor(public_path("/templateWord/format-word.docx"));

        
        $replacements = [];

        $data = DB::table('galeri_kegiatan')->leftJoin('users', 'galeri_kegiatan.users_id', '=', 'users.id')
        ->select('users.*', 'galeri_kegiatan.*')->whereBetween('tanggal', [$startOfMonth, $endOfMonth])->get();
  
        
    //   dd($data);
       
        $template->cloneBlock('block_name', $data->count(), true, true);
        foreach($data as $index => $item) {
            $template->setValue('lokasi_kegiatan#' . $index+1, $item->lokasi_kegiatan);
            $template->setValue('nama_kegiatan#' . $index+1, $item->nama_kegiatan);
            $template->setValue('hari#' . $index+1, getHari($item->hari));
            $template->setValue('narasi_kegiatan#' . $index+1, strip_tags($item->narasi_kegiatan));
            $template->setValue('tanggal#' . $index+1, date('d-m-Y', strtotime($item->tanggal)));
            $template->setValue('created_at#' . $index+1, date('H:i', strtotime($item->created_at)));
            $template->setValue('dasar_pelaksanaan#' . $index+1, strip_tags($item->dasar_pelaksanaan));
            $template->setImageValue('image#'. $index+1,  array('path' => public_path('upload/kegiatan/'. $item->image), 'width' => 400, 'height' => 350, 'ratio' => true));
        }
        $saveDocPath = public_path('new-result' . date("ymdhis") . '.docx');
        $template->saveAs($saveDocPath);

        $paramsUrl = url("new-result" . date("ymdhis") . ".docx");
        return redirect($paramsUrl);
     }
}
