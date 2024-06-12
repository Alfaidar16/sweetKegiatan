<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = 'panel/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function credentials(Request $request)
    {
        toast('login Berhasil', 'success');
        return ['nip' => $request->{$this->username()}, 'password' => $request->password];
    }


    public function Postlogin(Request $request) {
        // dd('tes');
          $this->validate($request, [
            'nip' => 'required|string',
            'password' => 'required|string'
          ]);
         $user = User::where('nip', $request->nip)->first();
          if (password_verify($request->password, $user->password)) {
           Auth::loginUsingId($user->id);
           toast('success', 'Login berhasil');
           return redirect('/panel/dashboard');
        } else {
            echo 'Invalid password.';
        }
    }
}
