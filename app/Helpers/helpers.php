<?php

use App\Models\Hitstat;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

function getHari($hari)
{
    switch ($hari) {
        case 'Sunday':
            return 'Minggu';
        case 'Monday':
            return 'Senin';
        case 'Tuesday':
            return 'Selasa';
        case 'Wednesday':
            return 'Rabu';
        case 'Thursday':
            return 'Kamis';
        case 'Friday':
            return 'Jumat';
        case 'Saturday':
            return 'Sabtu';
        default:
            return 'hari tidak valid';
    }
}

function changeDate($date)
{
    return date("d-m-Y", strtotime($date));
}


function tgl_indo($tanggal)
	{
		$bulan = array(
			1 =>   'Januari',
			'Februari',
			'Maret',
			'April',
			'Mei',
			'Juni',
			'Juli',
			'Agustus',
			'September',
			'Oktober',
			'November',
			'Desember'
		);
		$pecahkan = explode('-', $tanggal);

		// variabel pecahkan 0 = tanggal
		// variabel pecahkan 1 = bulan
		// variabel pecahkan 2 = tahun

		return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
	}


function get_bulan($tanggal)
{
	$bulan = array(
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);
	$pecahkan = explode('-', $tanggal);

	// variabel pecahkan 0 = tanggal
	// variabel pecahkan 1 = bulan
	// variabel pecahkan 2 = tahun

	return $bulan[(int)$pecahkan[1]]  ;
}

function get_pegawai($link)
{
	$curl = curl_init();
	
	curl_setopt_array($curl, array(
		CURLOPT_URL => $link,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'GET',
	));
	$response = curl_exec($curl);
	curl_close($curl);
	return  json_decode($response, true);
}
// function recordHit() {
//     $today = date('d');
//     $month = date('m');
//     $year = date('Y');

//     // Mencari atau membuat hitstat baru untuk hari ini
//     Hitstat::updateOrCreate(
//         ['day' => $today, 'month' => $month, 'year' => $year],
//         ['hits' => DB::raw('hits + 1')]
//     );
// }

// function getHitStats() {
//     return Cache::remember('hit_stats', now()->addMinutes(60), function () {
//         $today = Hitstat::where('day', date('d'))->where('month', date('m'))->where('year', date('Y'))->sum('hits');
//         $month = Hitstat::where('month', date('m'))->where('year', date('Y'))->sum('hits');
//         $total = Hitstat::sum('hits');

//         return compact('today', 'month', 'total');
//     });
// }

// function hitstat($is_hit = false) {

// 	if($is_hit) {
// 		$hitstat = \App\Models\Hitstat::updateOrCreate(
// 			[
// 				'day' => date('d'),
// 				'month' => date('m'),
// 				'year' => date('Y'),
// 			],
// 			[
// 				'hits' => \Illuminate\Support\Facades\DB::raw('hits + 1'),
// 			]
// 		);
// 	}

// 	$today = \App\Models\Hitstat::where('day', date('d'))->where('month', date('m'))->where('year', date('Y'))->sum('hits');
// 	$month = \App\Models\Hitstat::where('month', date('m'))->where('year', date('Y'))->sum('hits');
// 	$total = \App\Models\Hitstat::sum('hits');


// 	return compact('today', 'month', 'total');
// }