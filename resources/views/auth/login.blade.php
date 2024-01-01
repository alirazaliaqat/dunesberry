@extends('layouts.app')

@section('content')
                <div class="d-flex flex-column flex-root bg-dark text-white db-auth-pages" id="kt_app_root">
                  
                    <div class="d-flex flex-column-reverse flex-lg-row flex-column-fluid">
                       
                        <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 px-1 py-10 p-lg-10 order-2 order-lg-1">  
                            <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                                @if (session('error'))
                                <div class="alert alert-danger" role="alert"> {{session('error')}} 
                                </div>
                                @endif
                                @if($errors->has('error'))
    <div class="alert alert-danger">
        {{ $errors->first('error') }}
    </div>
@endif
                              <div class="p-8 w-100 w-lg-500px p-lg-10">
                                <div class="text-center"><a href="/" class="mb-12">
                                    @php
            $settings = App\Models\SiteSetting::first()
            @endphp
            @if (isset($settings->logo)) 
            <img alt="Logo"
                src="{{ asset('storage/images/' .$settings->logo) }} "
                class="h-150px" />
                @else 
                <h3 class="text-white">Dunesberry</h3>
                @endif
                                   
                                   </a>
                                </div>
                                        <form class="form w-100 mt-10" method="POST" action="{{ route('login') }}">
                                            @csrf
                                    
                                        {{-- <h1 class="text-center mb-5  login-main-heading">Sign in</h1> --}}
                                       
                                        <div class="fv-row">
                                            <label for="email" class="col-form-label text-white">{{  __('Email Address') }}</label>

                                            <input id="email" type="email" class="form-control rounded-0 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                        </div>
                                       
                                        <div class="fv-row mb-3">
                                            <label for="password" class="col-form-label text-white">{{  __('Password') }}</label>

                                           
                                                <input id="password" type="password" class="form-control rounded-0 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror                             
                                        </div>

                                        <div class="row mb-3 justify-content-center">
                                            <div class="col-md-12">
                                                <div class="d-flex justify-content-between">
                                                <div class="form-check my-auto">
                                                    <input class="form-check-input rounded-0 " type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                
                                                    <label class="form-check-label text-white" for="remember">
                                                        {{  __('Remember Me') }}
                                                    </label>
                                                </div>
                                                <div class="">
                                                    @if (Route::has('password.request'))
                                                    <a class="btn btn-link pe-0 text-white" href="{{ route('password.request') }}">
                                                        {{  __('Forgot Your Password') }}
                                                    </a>
                                                @endif
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                       
                                        <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
                                            <div></div>
                                         
                                        </div>
                                       
                                        <div class="d-grid mb-10">
                                            <button type="submit" id="kt_sign_in_submit" class="btn btn-primary" style="background-color: #D21E48!important;">
                                              
                                                <span class="indicator-label">{{  __('Login') }} </span>
                                               
                                                <span class="indicator-progress">Please wait...
                                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                               
                                            </button>
                                        </div>
                                       
                                        <!--<div class="text-gray-500 text-center fw-semibold fs-6">{{  __('Not a Member yet?') }}-->
                                        <!--<a href="{{ route('register') }}" class="btn-link" style="color:#D21E48!important;">{{  __('Register Now') }}</a></div>-->
                                      
                                    </form>
                                </div>
                            </div>
                     
                        </div>
                        <!--end::Aside-->
                    </div>
                </div>
               
    
@endsection
