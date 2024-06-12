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

                return Datatables::of($bidang)
                    ->addIndexColumn()->editColumn('subunit', function($bidang) {
                        if ($bidang->subunit == null) {
                            return '--';
                        } else {
                            return $bidang->subunit;
                        }
                    })
                    ->editColumn('aksi', function ($bidang) {
                        $actionButton = '
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $v->id }}">
                        <i class="bi bi-pencil-square"></i>
                      </button>
                    {{-- <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#EditJenisInformasi">
                       
                    </button> --}}
                    <button class="btn waves-effect waves-light btn-danger btn-sm" onclick="hapusUser()">
                        <i class="bi bi-trash"></i>
                   </button>';
                        return $actionButton;
                    })
                    ->escapeColumns([])
                    ->make(true);
            }
        $with = [
            'title' => 'Data Bidang',
          
        ]; 
        return view('Bidang.Index')->with($with);
    }
}
