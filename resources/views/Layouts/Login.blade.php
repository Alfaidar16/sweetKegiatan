@extends('App')
  @section('content')
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
                                <input type="email" name="email" class="form-control p-2 @error('email') is-invalid @enderror" placeholder="Enter your email" required autofocus value="{{ old('email')}}" />
                                @error('email')
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
   </body>
  @endsection
	
	