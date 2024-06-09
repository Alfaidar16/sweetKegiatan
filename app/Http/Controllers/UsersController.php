<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Hash;
use GuzzleHttp\Client;

class UsersController extends Controller
{
    public function index(Request $request) {

        // if ($request->ajax()) {
        //     $user = DB::table('users')->get();
            
        //       return Datatables::of($user)
        //         ->addIndexColumn()->editColumn('aksi', function ($user) {
        //                $actionButton = '
        //               <a href=" '. route('user.edit', $user->id).'" class="btn waves-effect waves-light btn-success btn-sm">
        //                     <i class="bi bi-pencil-square"></i>
        //                </a>
        //                 <button class="btn waves-effect waves-light btn-danger btn-sm" onclick="hapusUser(&quot;' . $user->id . '&quot;)">
        //                     <i class="bi bi-trash"></i>
        //                </button>';
        //                return $actionButton;
                     
        //            })
        //            ->escapeColumns([])
        //            ->make(true);
        //    }

        $client = new Client();
        $urlrOpd = (string) $client->get('https://epinisi.sulselprov.go.id/api/pegawai?&size=15000&unit=102241')->getBody();
        $dataPegawai = json_decode($urlrOpd);
        dd($dataPegawai);
        $with = [
            'title' => 'Users',
            // 'data' => $dataPegawai
        ];
        return view('User.Index')->with($with);
    }

    public function create() {
       
        $role = DB::table('roles')->get();
        $with = [
            'title' => 'Tambah User',
            'role' => $role
        ];
        return view('User.Create')->with($with);
    }

    public function store(Request $request) {

        // dd($request->all());
        $this->validate($request, [
            'name' =>'required',
            'email' =>'required|email|unique:users,email',
            'password' => 'required|min:5',
            'roles_id' =>'required'
        ], [ 
            'name.required' => 'Nama harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 5 karakter',
            'roles_id.required' => 'Roles harus diisi'
        ]);

        DB::table('users')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' =>  Hash::make($request->password),
            'roles_id' => $request->roles_id
        ]);
        toast('success', 'Data berhasil ditambahkan');
        return redirect()->route('user.index');
    }


    public function edit($id) {
        $user = DB::table('users')
            ->leftJoin('roles', 'users.roles_id', '=', 'roles.id')
            ->where('users.id', $id)
            ->select('users.*' ,'roles.nama as roles_name')
            ->first();

        $role = DB::table('roles')->get();
        $with = [
            'title' => 'Edit User',
            'user' => $user,
            'role' => $role
        ];
        return view('User.Edit')->with($with);
    }


    public function update(Request $request) {
        $this->validate($request, [
            'name' =>'required',
            'email' =>'required|email',
            'password' => 'required|min:5',
            'roles_id' =>'required'
        ], [ 
            'name.required' => 'Nama harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 5 karakter',
            'roles_id.required' => 'Roles harus diisi'
        ]);
        DB::table('users')->where('id', $request->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' =>  Hash::make($request->password),
            'roles_id' => $request->roles_id
        ]);
        toast('success', 'Data berhasil ditambahkan');
        return redirect()->route('user.index');
    }

    public function destroy(Request $request) {
      DB::table('users')->where('id', $request->id)->delete();
      toast('success', 'Data berhasil dihapus');
      return redirect()->back();
    }
}
