<?php

namespace App\Http\Controllers;

use App\Charts\LaporanChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 


class HomeController extends Controller
{
    public function Index(LaporanChart $LaporanChart) {
     
      $data['laporanChart'] = $LaporanChart->build();
        $with = [ 
            'title' => 'Dashboard',
            'laporanChart' => $LaporanChart->build()
           
        ];
        return view('Auth.Dashboard')->with($with);
    }
}
