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

		<!-- *************
			************ Vendor Css Files *************
		************ -->

		<!-- Scrollbar CSS -->
		<link rel="stylesheet" href="{{ asset('/TemplateDashboard/design/assets/vendor/overlay-scroll/OverlayScrollbars.min.css')}}" />
	</head>
		


   <body class="login-container">
    <div class="container">
       <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card">
                <form action="{{ route('auth.login')}}" method="Post">
                    @csrf
                    <div class="login-box rounded-2 p-3">
                        <div class="login-form">
                            <h5 class="mb-5 text-center mt-3" style="color: black;">Selamat Datang</h5>
                            <div class="mb-3">
                                <label class="form-label">Your Email</label>
                                <input type="text" name="nip" class="form-control p-2 @error('nip') is-invalid @enderror" placeholder="Enter your nip" required autofocus value="{{ old('nip')}}" />
                                @error('nip')
                                    <strong class="text-danger invalid-feedback">{{$message}}</strong>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Your Password</label>
                                <input type="password" name="password" class="form-control p-2" placeholder="Enter password" required />
                            </div>
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="form-check m-0">
                                    <input class="form-check-input" type="checkbox" value="" id="rememberPassword" />
                                    <label class="form-check-label" for="rememberPassword">Remember</label>
                                </div>
                                {{-- <a href="forgot-password.html" class="text-blue text-decoration-underline">Lost password?</a> --}}
                            </div>
                            <div class="d-grid py-3">
                                <button type="submit" class="btn btn-lg btn-primary">
                                    Login
                                </button>
                            </div>
                            {{-- <div class="text-center py-3">or login with</div>
                            <div class="d-flex gap-2 justify-content-center">
                                <button type="submit" class="btn btn-outline-light">
                                    <img src="assets/images/google.svg" class="login-icon" alt="Login with Google" />
                                </button>
                                <button type="submit" class="btn btn-outline-light">
                                    <img src="assets/images/facebook.svg" class="login-icon" alt="Login with Facebook" />
                                </button>
                            </div> --}}
                            {{-- <div class="text-center pt-3">
                                <span>Not registered?</span>
                                <a href="signup.html" class="text-blue text-decoration-underline ms-2">
                                    Create an account</a>
                            </div> --}}
                        </div>
                    </div>
                </form>
            </div>
        </div>
       </div>
    </div>
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

	