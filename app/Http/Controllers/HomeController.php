<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
class HomeController extends Controller
{
    public function Index() {
     
      
        $with = [ 
            'title' => 'Dashboard',
           
        ];
        return view('Auth.Dashboard')->with($with);
    }
}
