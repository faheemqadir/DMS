
@extends('layouts.app_login')

@section('content')
<div class="container">
    <div class="auth-box login-box">
        <!-- Start row -->
        <div class="row no-gutters align-items-center justify-content-center">
            <!-- Start col -->
            <div class="col-md-6 col-lg-5">
                <!-- Start Auth Box -->
                <div class="auth-box-right">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('login') }}">
                            @csrf
                                <div class="form-head">
                                    <a href="{{url('/')}}" class="logo"><img src="{{asset('assets/images/logo.svg')}}" class="img-fluid" alt="logo"></a>
                                </div>                                        
                                <h4 class="text-primary my-4">Log in !</h4>
                                <div class="form-group">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-row mb-3">
                                    <div class="col-sm-6">
                                        <div class="custom-control custom-checkbox text-left">
                                          <input type="checkbox" class="custom-control-input" id="rememberme">
                                          <label class="custom-control-label font-14" for="rememberme">Remember Me</label>
                                        </div>                                
                                    </div>
                                    <div class="col-sm-6">
                                      <div class="forgot-psw"> 
                                        <a id="forgot-psw" href="{{url('/user-forgotpsw')}}" class="font-14">Forgot Password?</a>
                                      </div>
                                    </div>
                                </div>                          
                              <button type="submit" class="btn btn-success btn-lg btn-block font-18">Log in</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- End Auth Box -->
            </div>
            <!-- End col -->
        </div>
        <!-- End row -->
    </div>
</div>
@endsection
