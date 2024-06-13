
<!DOCTYPE html>

<html lang="en">
	<!--begin::Head-->
	<head>
<base href="../../../" />
		<title>Sistem Informasi Weekly Report Prov. Sulsel</title>
		<meta charset="utf-8" />
		
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta property="og:locale" content="en_US" />
		<meta property="og:type" content="article" />
		<link rel="shortcut icon" href="{{ asset('/TemplateLogin/logosulsel.png') }}" />
		<!--begin::Fonts(mandatory for all pages)-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
		<link href="{{ asset('/TemplateLogin/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('/TemplateLogin/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
		<!--end::Global Stylesheets Bundle-->
		<script>// Frame-busting to prevent site from being loaded within a frame without permission (click-jacking) if (window.top != window.self) { window.top.location.replace(window.self.location.href); }</script>
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="app-blank">
		<!--begin::Theme mode setup on page load-->
		<script>var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-bs-theme-mode")) { themeMode = document.documentElement.getAttribute("data-bs-theme-mode"); } else { if ( localStorage.getItem("data-bs-theme") !== null ) { themeMode = localStorage.getItem("data-bs-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-bs-theme", themeMode); }</script>
		<!--end::Theme mode setup on page load-->
		<!--begin::Root-->
        
		<div class="d-flex flex-column flex-root" id="kt_app_root">
			<div class="d-flex flex-column flex-lg-row flex-column-fluid bghp">
				<a href="index.html" class="d-block d-lg-none mx-auto py-20">
					<img alt="Logo" src="{{ asset('/TemplateLogin/lgoosweet.png') }}" class="theme-light-show h-100px" />
					<img alt="Logo" src="{{ asset('/TemplateLogin/assets/media/logos/default-dark.svg') }}" class="theme-dark-show h-25px" />
				</a>
			
				<div class="d-flex flex-column flex-column-fluid flex-center w-lg-50 p-10 bg1"  >

					<div class="d-flex  flex-column-fluid flex-column w-100 mw-450px">
						
						<div class="d-flex flex-stack py-2 hilang">
							
							<div class="me-2 hiddenbtn pt-15 mb-15">
								<a href="#" class="btn btn-icon bg-light rounded-circle">
									<i class="ki-outline ki-black-left fs-2 text-gray-800"></i>
								</a>
							</div>
						
							<div class="m-0">
								
							</div>
						
						</div>
					
                        <div class="text-start gambar1">
                            <img src="{{ asset('/TemplateLogin/lgoosweet.png') }}" alt="" style="width: 60%;">
                        </div>
						<div class="py-20">
							
							<form class="form w-100"   action="{{ route('auth.login') }}" method="POST">
                                @csrf
							
								<div class="text-start mb-4">
								
									<h1 class="text-gray-1000 mb-3 fs-3x" data-kt-translate="sign-up-title">Selamat Datang</h1>
								
									<div class="text-gray-600 fw-semibold fs-4" data-kt-translate="general-desc"></div>
									
								</div>
							
								<div class="row fv-row mb-7">
									
									
								</div>
								
								<div class="fv-row mb-10">
									<input class="form-control form-control-lg form-control-solid" type="text" placeholder="Masukkan NIP..." name="nip" autocomplete="off" data-kt-translate="sign-up-input-email" />
								</div>
							
								<div class="fv-row mb-10" data-kt-password-meter="true">
									<div class="mb-1">
										<div class="position-relative mb-3">
											<input class="form-control form-control-lg form-control-solid" type="password" placeholder="Masukkan Password..." name="password" autocomplete="off" data-kt-translate="sign-up-input-password" />
											<span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
												<i class="ki-outline ki-eye-slash fs-2"></i>
												<i class="ki-outline ki-eye fs-2 d-none"></i>
											</span>
										</div>
										
										
									</div>
								
								</div>
							
								<div class="d-flex flex-stack">
									
									<button type="submit"  class="btn btn-primary" data-kt-translate="sign-up-submit">
										
										<span class="indicator-label">Masuk</span>
									
										<span class="indicator-progress">Please wait... 
										<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
									
									</button>
								
								</div>
							</form>
						</div>
						<div class="m-0">
							
						</div>
					
					</div>
					
				</div>
			
				<div class="d-none d-lg-flex flex-lg-row-fluid w-50 bgi-size-cover bgi-position-y-center bgi-position-x-start bgi-no-repeat" style="background-image: url(/TemplateLogin/bg1ok.png)"></div>
			
			</div>
		
		</div>
	
		<script>var hostUrl = "assets/";</script>
	
		<script src="{{ asset('/TemplateLogin/assets/plugins/global/plugins.bundle.js') }}"></script>
		<script src="{{ asset('/TemplateLogin/assets/js/scripts.bundle.js') }}"></script>
		
		<script src="{{ asset('/TemplateLogin/assets/js/custom/authentication/sign-up/general.js') }}"></script>
		<script src="{{ asset('/TemplateLogin/assets/js/custom/authentication/sign-in/i18n.js') }}"></script>
	
	</body>
	<!--end::Body-->
</html>