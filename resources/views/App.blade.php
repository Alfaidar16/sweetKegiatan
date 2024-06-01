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
		<title>Admin Templates - Dashboard Templates - Admin Dashboards</title>

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

		<!-- *************
			************ Vendor Css Files *************
		************ -->

		<!-- Scrollbar CSS -->
		<link rel="stylesheet" href="{{ asset('/TemplateDashboard/design/assets/vendor/overlay-scroll/OverlayScrollbars.min.css')}}" />
	</head>
		

	<body>

	  @yield('content')

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

		<!-- Main Js Required -->
		<script src="{{ asset('/TemplateDashboard/design/assets/js/main.js')}}"></script>
		@include('sweetalert::alert')
        @yield('js')
	</body>

</html>