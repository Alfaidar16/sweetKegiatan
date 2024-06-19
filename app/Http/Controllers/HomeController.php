<?php

namespace App\Http\Controllers;

use App\Charts\LaporanChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
class HomeController extends Controller
{
    public function Index(LaporanChart $laporanChart) {
     
      $data['laporanChart'] = $laporanChart->build();
        $with = [ 
            'title' => 'Dashboard',
            'laporanChart' => $laporanChart->build()
           
        ];
        return view('Auth.Dashboard')->with($with);
    }
}
