<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use GuzzleHttp\Client;

class TarikDataController extends Controller
{
    public function index() {
        set_time_limit(300); 
        $client = new Client();
        $urlrOpd = (string) $client->get('https://epinisi.sulselprov.go.id/api/pegawai?&size=15000&unit=102241')->getBody();
        $dataPegawai = json_decode($urlrOpd);

        foreach($dataPegawai as $key) {
            $kodeJabatan = $key->RincUnit1  . substr($key->RincUnit3, 0, 2) . $key->RincUnit2;
            if(strlen($kodeJabatan) == 11 || strlen($kodeJabatan) == 13) {
                $kodeBidang = '1022410100';
            }else {
                $kodeBidang = substr($kodeJabatan, 0,10);
            }
         
            $Pegawai = [
                'nip' => $key->nipbaru,
                'name' => $key->nama,
                'unit' => $key->UnitKerja,
                'kode_jabatan' =>  $kodeJabatan, 
                'kode_bidang' => $kodeBidang,
                'email' => $key->email,
                'roles_id' => 2,
                'password' => bcrypt($key->nipbaru),
            ];
            // Cek apakah pengguna dengan email yang sama sudah ada
             $existingUser = User::where('nip', $Pegawai['nip'] ?? null)->first();
            if (!$existingUser) {
                // Jika pengguna tidak ada, buat pengguna baru
                User::create($Pegawai);
            }
            else {
                User::where('nip', $key->nipbaru)->update($Pegawai);
            }
      }
      return true;
    }
    
}
