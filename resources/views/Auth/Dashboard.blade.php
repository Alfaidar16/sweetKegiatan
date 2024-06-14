@extends('App')
@section('content')
	<!-- Page wrapper start -->
      <!-- Content wrapper start -->
      <div class="content-wrapper">
	  
        <!-- Row start -->
        <div class="row gx-3 d-none">
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="stats-tile d-flex align-items-center position-relative tile-red">
                    <div class="sale-icon icon-box xl rounded-5 me-3">
                        <i class="bi bi-pie-chart font-2x text-red"></i>
                    </div>
                    <div class="sale-details text-white">
                        <h6>Laporan Kegiatan Mingguan</h6>
                        <h2 class="m-0">296</h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="stats-tile d-flex align-items-center position-relative tile-blue">
                    <div class="sale-icon icon-box xl rounded-5 me-3">
                        <i class="bi bi-sticky font-2x text-blue"></i>
                    </div>
                    <div class="sale-details text-white">
                        <h6>Unit Kerja</h6>
                        <h2 class="m-0">368</h2>
                    </div>
                </div>
            </div>
        
        </div>
        <!-- Row end -->
        <div class="row">
           <div class="col-lg-12 text-center">
            <h2>Selamat Datang, 
                <strong> {{ Auth::user()->name }}</strong>
            </h2>
            <p>Aplikasi  <strong>Sweet,</strong> Sistem Informasi Weekly Report</p>
           </div>
        </div>
       

    </div>
    <!-- Content wrapper end -->
@endsection