<!DOCTYPE html>
<html lang="en">

	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

		<!-- Meta -->
        @yield('css')
		<meta name="description" content="Best Bootstrap Admin Dashboards" />
		<meta name="author" content="Bootstrap Gallery" />
        <link rel="canonical" href="https://www.bootstrap.gallery/">
		<meta property="og:url" content="https://www.bootstrap.gallery">
		<meta property="og:title" content="Admin Templates - Dashboard Templates | Bootstrap Gallery">
		<meta property="og:description" content="Marketplace for Bootstrap Admin Dashboards">
		<meta property="og:type" content="Website">
		<meta property="og:site_name" content="Bootstrap Gallery">
		<link rel="shortcut icon" href="assets/images/favicon.svg" />

		<!-- Title -->
		<title>@yield('judul')</title>

		<!-- *************
			************ Common Css Files *************
		************ -->
		<!-- Bootstrap css -->
		<link rel="stylesheet" href="{{ asset('/TemplateDashboard/design/assets/css/bootstrap.min.css')}}" />

		<!-- Bootstrap font icons css -->
		<link rel="stylesheet" href="{{ asset('/TemplateDashboard/design/assets/fonts/bootstrap/bootstrap-icons.css')}}" />

		<!-- Main css -->
		<link rel="stylesheet" href="{{ asset('/TemplateDashboard/design/assets/css/main.css')}}" />
		<link rel="stylesheet" href="{{ asset('/TemplateDashboard/design/assets/css/login.css')}}" />


		{{-- Trix Editor --}}
		<link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
		<script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
		{{-- End --}}
	   {{-- SweetA;ert --}}
	   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
		<!-- Scrollbar CSS -->
		<link rel="stylesheet" href="{{ asset('/TemplateDashboard/design/assets/vendor/overlay-scroll/OverlayScrollbars.min.css')}}" />
		{{-- Data Table --}}
		<link rel="stylesheet" href="{{ asset('/TemplateDashboard/design/assets/vendor/datatables/dataTables.bs5.css')}}" />
		<link rel="stylesheet" href="{{ asset('/TemplateDashboard/design/assets/vendor/datatables/dataTables.bs5-custom.css')}}" />
	</head>
		

	<body>
  
		
	

	  <div class="page-wrapper">
		<!-- Page header starts -->
		<div class="page-header">
	  
		  <div class="toggle-sidebar" id="toggle-sidebar">
			  <i class="bi bi-list"></i>
		  </div>
	  
		  <!-- Header actions ccontainer start -->
		  <div class="header-actions-container">
	  
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
	  
					
					@yield('content')
					
	  
				  </div>
				  <!-- Content wrapper scroll end -->
	  
				  <!-- App Footer start -->
				  <div class="app-footer">
					  <span>2024© Pemerintah Provinsi Sulawesi Selatan</span>
				  </div>
				  <!-- App footer end -->
	  
			  </div>
			  <!-- Main container end -->
	  
		  </div>
		  <!-- Page wrapper end -->

		<!-- *************
			************ Required JavaScript Files *************
		************* -->
		<!-- Required jQuery first, then Bootstrap Bundle JS -->
		<script src="{{ asset('/TemplateDashboard/design/assets/js/jquery.min.js')}}"></script>
		<script src="{{ asset('/TemplateDashboard/design/assets/js/bootstrap.bundle.min.js')}}"></script>
		<script src="{{ asset('/TemplateDashboard/design/assets/js/modernizr.js')}}"></script>
		<script src="{{ asset('/TemplateDashboard/design/assets/js/moment.js')}}"></script>

		<!-- *************
			************ Vendor Js Files *************
		************* -->

		<!-- Overlay Scroll JS -->
		<script src="{{ asset('/TemplateDashboard/design/assets/vendor/overlay-scroll/jquery.overlayScrollbars.min.js')}}"></script>
		<script src="{{ asset('/TemplateDashboard/design/assets/vendor/overlay-scroll/custom-scrollbar.js')}}"></script>

		<!-- News ticker -->
		<script src="{{ asset('/TemplateDashboard/design/assets/vendor/newsticker/newsTicker.min.js')}}"></script>
		<script src="{{ asset('/TemplateDashboard/design/assets/vendor/newsticker/custom-newsTicker.js')}}"></script>

		<!-- Apex Charts -->
		<script src="{{ asset('/TemplateDashboard/design/assets/vendor/apex/apexcharts.min.js')}}"></script>
		<script src="{{ asset('/TemplateDashboard/design/assets/vendor/apex/custom/dash2/revenue.js')}}"></script>
		<script src="{{ asset('/TemplateDashboard/design/assets/vendor/apex/custom/dash2/analytics.js')}}"></script>
		<script src="{{ asset('/TemplateDashboard/design/assets/vendor/apex/custom/dash2/sparkline.js')}}"></script>
		<script src="{{ asset('/TemplateDashboard/design/assets/vendor/apex/custom/dash2/sales.js')}}"></script>
		<script src="{{ asset('/TemplateDashboard/design/assets/vendor/apex/custom/dash2/reports.js')}}"></script>

		<!-- Vector Maps -->
		<script src="{{ asset('/TemplateDashboard/design/assets/vendor/jvectormap/jquery-jvectormap-2.0.5.min.js')}}"></script>
		<script src="{{ asset('/TemplateDashboard/design/assets/vendor/jvectormap/world-mill-en.js')}}"></script>
		<script src="{{ asset('/TemplateDashboard/design/assets/vendor/jvectormap/gdp-data.js')}}"></script>
		<script src="{{ asset('/TemplateDashboard/design/assets/vendor/jvectormap/continents-mill.js')}}"></script>
		<script src="{{ asset('/TemplateDashboard/design/assets/vendor/jvectormap/custom/world-map-markers4.js')}}"></script>

		<!-- Rating JS -->
		<script src="{{ asset('/TemplateDashboard/design/assets/vendor/rating/raty.js')}}"></script>
		<script src="{{ asset('/TemplateDashboard/design/assets/vendor/rating/raty-custom.js')}}"></script>
		{{-- dataTable --}}
		<script src="{{ asset('/TemplateDashboard/design/assets/vendor/datatables/dataTables.min.js')}}"></script>
		<script src="{{ asset('/TemplateDashboard/design/assets/vendor/datatables/dataTables.bootstrap.min.js')}}"></script>

		<!-- Main Js Required -->
		<script src="{{ asset('/TemplateDashboard/design/assets/js/main.js')}}"></script>
		<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
		@include('sweetalert::alert')
        @yield('js')
	</body>

</html>