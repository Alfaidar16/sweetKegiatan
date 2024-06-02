<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB; 

class UsersController extends Controller
{
    public function index(Request $request) {

        if ($request->ajax()) {
            $user = DB::table('users')->get();
            
              return Datatables::of($user)
                ->addIndexColumn()->editColumn('aksi', function ($user) {
                       $actionButton = '
                      <a href="" class="btn waves-effect waves-light btn-success btn-sm">
                            <i class="bi bi-pencil-square"></i>
                       </a>
                        <button class="btn waves-effect waves-light btn-danger btn-sm" onclick="hapusKat(&quot;' . $user->id . '&quot;)">
                            <i class="bi bi-trash"></i>
                       </button>';
                       return $actionButton;
                     
                   })
                   ->escapeColumns([])
                   ->make(true);
           }
        $with = [
            'title' => 'Users'
        ];
        return view('User.Index')->with($with);
    }

    public function create() {
        $with = [
            'title' => 'Tambah User'
        ];
        return view('User.Create')->with($with);
    }
}
