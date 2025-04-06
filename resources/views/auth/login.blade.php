@extends('layouts.master-without-nav')
@section('title')
@lang('translation.Login')
@endsection
@section('content')

<div class="auth-page">
    <div class="container-fluid p-0">
        <div class="row g-0">
            
            <div class="col-xxl-12 col-lg-12 col-md-12">
                <div class="auth-bg" style="height: 100vh;">
                    <div class="bg-overlay"></div>
                    <ul class="bg-bubbles">
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                    </ul>
                    {{-- <div style="position: absolute; top: 20; " class="w-100"> --}}

                        <div class="row h-100 p-4 justify-content-center">
                            <div class="col-lg-5 col-sm-8 my-auto">
                                <div class="auth-full-page-content d-flex p-sm-5 p-4 rounded">

                                    <div class="w-100">
                                        <div class="d-flex flex-column">
                                            <div class="mb-3 mb-md-3 text-center">
                                                <a href="{{ url('/') }}" class="d-block auth-logo">
                                                    <img src="{{ URL::asset('images/logo.png') }}" alt="" height="28"> <span class="logo-txt">ICDL ATC</span>
                                                </a>
                                            </div>
                                            <div class="auth-content">
                                                <div class="text-center">
                                                    <h5 class="mb-0">Welcome Back !</h5>
                                                    <p class="text-muted mt-2">Sign in to continue to IBBU ICDL ATC.</p>
                                                </div>
                                                <form class="pt-2" action="{{ route('login') }}" method="POST">
                                                    @csrf
                                                    <div class="form-floating form-floating-custom mb-4">
                                                        <input type="text" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" id="input-username" placeholder="Enter User Name" name="email">
                                                        @error('email')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                        <label for="input-username">Username</label>
                                                        <div class="form-floating-icon">
                                                        <i data-feather="users"></i>
                                                        </div>
                                                    </div>
                
                                                    <div class="form-floating form-floating-custom mb-4 auth-pass-inputgroup">
                                                        <input type="password" class="form-control pe-5 @error('password') is-invalid @enderror" name="password" id="password-input" placeholder="Enter Password" value="">
                                                        @error('password')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                        <button type="button" class="btn btn-link position-absolute h-100 end-0 top-0" id="password-addon">
                                                            <i class="mdi mdi-eye-outline font-size-18 text-muted"></i>
                                                        </button>
                                                        <label for="input-password">Password</label>
                                                        <div class="form-floating-icon">
                                                            <i data-feather="lock"></i>
                                                        </div>
                                                    </div>
                
                                                    <div class="row mb-4">
                                                        <div class="col">
                                                            <div class="form-check font-size-15">
                                                                <input class="form-check-input " type="checkbox" id="remember-check">
                                                                <label class="form-check-label font-size-13" for="remember-check">
                                                                    Remember me
                                                                </label>
                                                            </div>
                                                        </div>
                
                                                    </div>
                                                    <div class="mb-3">
                                                        <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Log In</button>
                                                    </div>
                                                </form>
                
                                              
                                            </div>
                                        
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    {{-- </div> --}}
                  
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container fluid -->
</div>
@endsection
@section('script')
    <script src="{{ URL::asset('assets/js/pages/pass-addon.init.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/feather-icon.init.js') }}"></script>
@endsection

