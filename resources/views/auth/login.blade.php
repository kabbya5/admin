@extends('layouts.header')

@section('content')
@include('layouts.navheader')
@include('layouts.navbar')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">
                    <i class="far fa-user"></i>
                    <p> LOGIN </p>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group">
                            <label for="email" class="for-lable"> {{ __('E-Mail Address') }}</label>

                            
                            <input id="email" type="email" class="form-control @error('name') is-invalid @enderror" name="email" value="{{ old('email') }}">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          
                        </div>

                        <div class="form-group">
                            <label for="password" class="form-lable">{{ __('Password') }}</label>

                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong >{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="text-center text-danger" id="error" style="display: none"> Eamil or Passwoed Dosen't Match </div>
                        <div class="form-group mt-3">
                            <div class="d-flex justify-content-center">
                                <div class="form-chec mx-3">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                   
                                </div>
                                <div class="form-group mr-3">
                                    <div class="">
                                        <button type="submit" class="btn btn-primary" id="submit">
                                            {{ __('Login') }}
                                        </button>                            
                                    </div>
                                </div>
                            </div>
                        </div>

                    
                    </form>
                    <div class="d-flex justify-content-around">
                        <div class="reset">
                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
                        <div class="register">
                            <a href=" /register"> Create Account </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')
@endsection

@section('script')
<script>
    $(document).ready(function(){
        $('#submit').click( function(){
            $('#error').toggle();
        });
    });
</script>

    
@endsection
