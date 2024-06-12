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
                $bidang =  DB::table('ms_bidangs')->get();

                return Datatables::of($bidang)->addIndexColumn()
                ->editColumn('aksi', function ($bidang) {
                    $actionButton = '
                   <a href="#" class="btn waves-effect waves-light btn-success btn-sm">
                         <i class="bi bi-pencil-square"></i>
                    </a>
                     <button class="btn waves-effect waves-light btn-danger btn-sm" onclick="hapusUser(&quot;' . $bidang->id . '&quot;)">
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
}
