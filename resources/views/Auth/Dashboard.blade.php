@extends('App')
@section('content')
	<!-- Page wrapper start -->
    <div class="page-wrapper">

        <!-- Page header starts -->
        <div class="page-header">

            <div class="toggle-sidebar" id="toggle-sidebar">
                <i class="bi bi-list"></i>
            </div>

            <!-- Header actions ccontainer start -->
            <div class="header-actions-container">


                <!-- Header actions start -->
                {{-- <div class="header-actions d-xl-flex d-lg-none gap-4">
                    <div class="dropdown">
                        <a class="dropdown-toggle" href="#!" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-envelope-open fs-5 lh-1"></i>
                            <span class="count-label"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end shadow-lg">
                            <div class="dropdown-item">
                                <div class="d-flex py-2 border-bottom">
                                    <img src="assets/images/user.png" class="img-3x me-3 rounded-3" alt="Admin Dashboards" />
                                    <div class="m-0">
                                        <h6 class="mb-1 fw-semibold">Sophie Michiels</h6>
                                        <p class="mb-1">Membership has been ended.</p>
                                        <p class="small m-0 text-secondary">Today, 07:30pm</p>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown-item">
                                <div class="d-flex py-2 border-bottom">
                                    <img src="assets/images/user2.png" class="img-3x me-3 rounded-3" alt="Admin Dashboards" />
                                    <div class="m-0">
                                        <h6 class="mb-1 fw-semibold">Benjamin Michiels</h6>
                                        <p class="mb-1">Congratulate, James for new job.</p>
                                        <p class="small m-0 text-secondary">Today, 08:00pm</p>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown-item">
                                <div class="d-flex py-2">
                                    <img src="assets/images/user1.png" class="img-3x me-3 rounded-3" alt="Admin Dashboards" />
                                    <div class="m-0">
                                        <h6 class="mb-1 fw-semibold">Jehovah Roy</h6>
                                        <p class="mb-1">Lewis added new schedule release.</p>
                                        <p class="small m-0 text-secondary">Today, 09:30pm</p>
                                    </div>
                                </div>
                            </div>
                            <div class="d-grid mx-3 my-1">
                                <a href="javascript:void(0)" class="btn btn-primary">View all</a>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <!-- Header actions start -->
             @include('Layouts.header')
                <!-- Header profile start -->
              
                <!-- Header profile end -->
                <div class="modal fade" id="modal-logout" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg" style="width: 560px;">
                        <div class="modal-content rounded">
                            <div class="modal-header justify-content-end border-0 pb-0">
                                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                                    <span class="svg-icon svg-icon-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g transform="translate(12.000000, 12.000000) rotate(-45.000000) translate(-12.000000, -12.000000) translate(4.000000, 4.000000)" fill="#000000">
                                                <rect fill="#000000" x="0" y="7" width="16" height="2" rx="1" />
                                                <rect fill="#000000" opacity="0.5" transform="translate(8.000000, 8.000000) rotate(-270.000000) translate(-8.000000, -8.000000)" x="0" y="7" width="16" height="2" rx="1" />
                                            </g>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                            <div class="modal-body pt-0 pb-15 px-3 p-5 px-xl-20">
                                <div class="mb-13 text-center">
                                    <h1 class="mb-3">Apakah Anda Ingin Keluar ?</h1>
                                </div>
                                <div class="d-flex text-center flex-row-fluid pt-15">
                                    <form action="{{ route('logout')}}" method="post">
                                        {{ csrf_field() }}
                                        <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-danger">Logout</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Header actions ccontainer end -->

        </div>
        <!-- Page header ends -->

        <!-- Main container start -->
        <div class="main-container">

            <!-- Sidebar wrapper start -->
             @include('Layouts.Navbar')
            <!-- Sidebar wrapper end -->

            <!-- Content wrapper scroll start -->
            <div class="content-wrapper-scroll">

              

                <!-- Content wrapper start -->
                <div class="content-wrapper">

                    <!-- Row start -->
                    <div class="row gx-3">
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="stats-tile d-flex align-items-center position-relative tile-red">
                                <div class="sale-icon icon-box xl rounded-5 me-3">
                                    <i class="bi bi-pie-chart font-2x text-red"></i>
                                </div>
                                <div class="sale-details text-white">
                                    <h6>Products</h6>
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
                                    <h6>Orders</h6>
                                    <h2 class="m-0">368</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="stats-tile d-flex align-items-center position-relative tile-yellow">
                                <div class="sale-icon icon-box xl rounded-5 me-3">
                                    <i class="bi bi-emoji-smile font-2x text-yellow"></i>
                                </div>
                                <div class="sale-details text-white">
                                    <h6>Customers</h6>
                                    <h2 class="m-0">725</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="stats-tile d-flex align-items-center position-relative tile-green">
                                <div class="sale-icon icon-box xl rounded-5 me-3">
                                    <i class="bi bi-star font-2x text-green"></i>
                                </div>
                                <div class="sale-details text-white">
                                    <h6>Reviews</h6>
                                    <h2 class="m-0">95%</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Row end -->

                   

                </div>
                <!-- Content wrapper end -->

            </div>
            <!-- Content wrapper scroll end -->

            <!-- App Footer start -->
            <div class="app-footer">
                <span>© Bootstrap Gallery 2023</span>
            </div>
            <!-- App footer end -->

        </div>
        <!-- Main container end -->

    </div>
    <!-- Page wrapper end -->
@endsection