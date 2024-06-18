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
       

        <div class="row mt-5 ">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Sales</div>
                    </div>
                    <div class="card-body">
                        <div id="salesGraph"></div>
                        <div class="d-flex justify-content-between ht-separator pt-4 align-items-end">
                            <div class="m-0">
                                <h5>Highest Sales</h5>
                                <p class="m-0">
                                    Total 85M Income In the month of April
                                </p>
                            </div>
                            <a href="#" class="btn btn-primary">
                                <i class="bi bi-caret-right-fill m-0"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Reports</div>
                    </div>
                    <div class="card-body">
                        <div id="reports"></div>
                        <div class="row gx-3">
                            <div class="col-sm-6 col-6">
                                <div class="d-flex p-3 mt-2 flex-column box-bdr-blue rounded-2">
                                    <h6 class="text-truncate">
                                        Q3 - <span>$72,000</span>
                                    </h6>
                                    <div class="progress small">
                                        <div class="progress-bar shade-blue" role="progressbar" style="width: 60%"
                                            aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-6">
                                <div class="d-flex p-3 mt-2 flex-column box-bdr-blue rounded-2">
                                    <h6 class="text-truncate">
                                        Q4 - <span>$48,000</span>
                                    </h6>
                                    <div class="progress small">
                                        <div class="progress-bar shade-blue" role="progressbar" style="width: 70%"
                                            aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Content wrapper end -->
@endsection