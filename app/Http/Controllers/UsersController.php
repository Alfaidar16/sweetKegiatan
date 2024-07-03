<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class UsersController extends Controller
{
    public function index(Request $request)
    {
        
   
        if ($request->ajax()) {
             $kode = request('unit');
                $query =  DB::table('users')
                ->leftJoin('ms_bidangs', 'users.kode_bidang', '=', 'ms_bidangs.kode_bidang')
                ->leftJoin('roles', 'users.roles_id', '=', 'roles.id')
                ->select('roles.*', 'ms_bidangs.*', 'users.*')
                ->orderBy('users.created_at', 'desc');

                // Tambahkan kondisi filter berdasarkan kode_bidang jika ada
                if (!empty($kode)) {
                    $query->where('users.kode_bidang', $kode);
                }
                $user = $query->get();

            return Datatables::of($user)
                ->addIndexColumn()->editColumn('name', function ($user) {
                    if ($user->name == null) {
                        return '--';
                    } else {
                        return $user->name;
                    }
                })
                ->editColumn('aksi', function ($user) {
                    $actionButton = '
                      <a href=" ' . route('akun.edit', $user->id) . '" class="btn waves-effect waves-light btn-success btn-sm">
                            <i class="bi bi-pencil-square"></i>
                       </a>
                        <button class="btn waves-effect waves-light btn-danger btn-sm" onclick="hapusUser(&quot;' . $user->id . '&quot;)">
                            <i class="bi bi-trash"></i>
                       </button>';
                    return $actionButton;
                })
                ->escapeColumns([])
                ->make(true);
        }
         
        $notBidang = 
        $bidang = DB::table('ms_bidangs')
            ->where(DB::raw('SUBSTRING(kode_bidang, -2)'), '00')
            ->get();

        $with = [
            'title' => 'Users',
            'bidang' => $bidang
            // 'data' => $dataPegawai
        ];
        return view('User.Index')->with($with);
    }

    public function create()
    {

        $role = DB::table('roles')->get();
        $bidang = DB::table('ms_bidangs')
            ->where(DB::raw('SUBSTRING(kode_bidang, -2)'), '00')
            ->get();
        $with = [
            'title' => 'Tambah User',
            'role' => $role,
            'bidang' => $bidang
        ];
        return view('User.Create')->with($with);
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'nip'  => 'required|string|unique:users,nip',
            'password' => 'required|min:5|same:nip',
            'roles_id' => 'required'
        ], [
            'name.required' => 'Nama harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'nip' => 'Nip Sudah Terdaftar',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 5 karakter',
            'password.same' => 'Password Harus Sama Dengan Nip',
            'nip.required' => 'NIP harus diisi',
            'roles_id.required' => 'Roles harus diisi'
        ]);
        DB::table('users')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' =>  bcrypt($request->password),
            'nip' => $request->nip,
            'unit' => 'Dinas Ketahanan Pangan',
            'kode_jabatan' => $request->kode_bidang,
            'kode_bidang' => $request->kode_bidang,
            'roles_id' => $request->roles_id
        ]);
        toast('success', 'Data berhasil ditambahkan');
        return redirect()->route('akun.index');
    }


    public function edit($id)
    {
        $user = DB::table('users')->where('id', $id)->first();
        // $user = DB::table('users')
        // ->join('ms_bidangs', 'users.kode_bidang', '=', 'ms_bidangs.kode_bidang')
        // ->where(DB::raw('RIGHT(ms_bidangs.kode_bidang, 2)'), '00')
        // ->select('users.*', 'ms_bidangs.*')
        // ->first();
        $bidang = DB::table('ms_bidangs')
            ->where(DB::raw('SUBSTRING(kode_bidang, -2)'), '00')
            ->get();
        $with = [
            'title' => 'Edit User',
            'user' => $user,
            'bidang' => $bidang
        ];
        return view('User.Edit')->with($with);
    }

    public function update(Request $request)
    {
        $this->validate($request, [

            'kode_bidang' => 'required'
        ], [
            'kode_bidang.required' => 'Kode Bidang Wajib Di isi'
        ]);
        DB::table('users')->where('id', $request->id)->update([
            'kode_bidang' => $request->kode_bidang,
        ]);
        toast('success', 'Data berhasil ditambahkan');
        return redirect()->route('akun.index');
    }

    public function destroy(Request $request)
    {
        DB::table('users')->where('id', $request->id)->delete();
        toast('success', 'Data berhasil dihapus');
        return redirect()->back();
    }


    public function filter($kode_bidang)
    {
       
        $data =  DB::table('users')
        ->leftJoin('ms_bidangs', 'users.kode_bidang', '=', 'ms_bidangs.kode_bidang')
        ->leftJoin('roles', 'users.roles_id', '=', 'roles.id')
        ->select('roles.*', 'ms_bidangs.*', 'users.*')
        ->where('users.kode_bidang', '=', $kode_bidang)
        ->orderBy('users.created_at', 'desc')
        ->get();
      

         return redirect()->route('akun.index');
    }
}
