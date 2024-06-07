<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB; 
use Carbon\Carbon;
use PDF;
use App\Models\GaleriKegiatan;

class LaporanController extends Controller
{
     public function index(Request $request) {
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
                })->editColumn('tanggal', function($kegiatan) {
                    return \Carbon\Carbon::parse($kegiatan->tanggal)->format('d-m-Y');
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

       $cek = $request->validate([
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_awal',
        ]);

        // dd($cek);

        $tanggal_awal = Carbon::parse($request->tanggal_awal)->startOfDay();
        $tanggal_akhir = Carbon::parse($request->tanggal_akhir)->endOfDay();
      
        $template = new \PhpOffice\PhpWord\TemplateProcessor(public_path("format-word.docx"));

        
        $replacements = [];

        $data = DB::table('galeri_kegiatan')->leftJoin('opd', 'galeri_kegiatan.opd_id', '=', 'opd.id')->select('opd.*', 'galeri_kegiatan.*')->whereBetween('tanggal', [$tanggal_awal, $tanggal_akhir])->get();
      

       
        $template->cloneBlock('block_name', $data->count(), true, true);
        foreach($data as $index => $item) {
            $template->setValue('lokasi_kegiatan#' . $index+1, $item->lokasi_kegiatan);
            $template->setValue('nama_kegiatan#' . $index+1, $item->nama_kegiatan);
            $template->setValue('hari#' . $index+1, getHari($item->hari));
            $template->setValue('narasi_kegiatan#' . $index+1, strip_tags($item->narasi_kegiatan));
            $template->setValue('tanggal#' . $index+1, date('d-m-Y', strtotime($item->tanggal)));
            $template->setValue('created_at#' . $index+1, date('H:i', strtotime($item->created_at)));
            $template->setValue('dasar_pelaksanaan#' . $index+1, strip_tags($item->dasar_pelaksanaan));
            $template->setImageValue('image#'. $index+1,  array('path' => public_path('upload/kegiatan/'. $item->image), 'width' => 200, 'height' => 100, 'ratio' => true));
        }
        

        // $template->setValue('opd', $data->nama);
        // $template->setValue('tanggal', $data->tanggal);
       
        $saveDocPath = public_path('new-result' . date("ymdhis") . '.docx');
        $template->saveAs($saveDocPath);

        $paramsUrl = url("new-result" . date("ymdhis") . ".docx");
        
       

        return redirect($paramsUrl);

        // $data = DB::table('galeri_kegiatan')->first();

       
        // if (is_string($data)) {
        //     dd($data); // Debug: Dump the content of $items if it's a string
        // }
        // $pdf = PDF::loadView('Auth/laporan_kegiatan', compact('data'));
        // return $pdf->download('items.pdf');
        //  $period = $request->get('period', 'daily');
        // //  $title = "download";
 
        //  if ($period == 'daily') {
        //      $kegiatan = $this->getDailyActivities();
        //  } elseif ($period == 'weekly') {
        //      $kegiatan = $this->getWeeklyActivities();
        //  } else {
        //      $kegiatan = $this->getMonthlyActivities();
        //  }
 
        //  $pdf = PDF::loadView('Auth/laporan_kegiatan', compact('kegiatan', 'period', ));
        //  return $pdf->download("laporan_{$period}.pdf");
     }
 
     private function getDailyActivities()
     {
         $today = Carbon::today()->toDateString();
         return DB::table('galeri_kegiatan')
             ->whereDate('tanggal', $today)
             ->get();
     }
 
     private function getWeeklyActivities()
     {
         $startOfWeek = Carbon::now()->startOfWeek()->toDateString();
         $endOfWeek = Carbon::now()->endOfWeek()->toDateString();
         return DB::table('galeri_kegiatan')
             ->whereBetween('tanggal', [$startOfWeek, $endOfWeek])
             ->get();
     }
 
     private function getMonthlyActivities()
     {
         $startOfMonth = Carbon::now()->startOfMonth()->toDateString();
         $endOfMonth = Carbon::now()->endOfMonth()->toDateString();
         return DB::table('galeri_kegiatan')
             ->whereBetween('tanggal', [$startOfMonth, $endOfMonth])
             ->get();
     }
}
