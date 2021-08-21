@extends('layouts.header')
@include('layouts.navheader')
@include('layouts.navbar')
@include('layouts.sidebar')
@section('content')
<div class="container">
    <div class="user-input">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">{{ __('Edit Profile') }}</div>
                    <div class="card-body mt-3">
                        <form method="POST" action="{{ route('update.profile') }}">
                            @method('put')
                            @csrf
    
                            <div class="form-group">
                                <label for="name" class="form-label text-success">{{ __('Name') }}</label>
    
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>
    
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                            </div>
                            <div class="form-group">
                                <label for="username" class="form-label text-success">{{ __('User Name') }}</label>
    
                                <input id="name" type="di" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ $user->username }}" required autocomplete="username" autofocus>
    
                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                            </div>
                            <div class="form-group">
                                <label for="username" class="form-label text-success">{{ __('Phone Number') }}</label>
    
                                <input id="phone" type="di" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $user->phone }}" required autocomplete="phone" autofocus>
    
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                            </div>
                            
                            <button type="submit text-center" class="btn btn-primary">
                                {{ __('Edit Profile') }}
                            </button>
                                
                           
                            <a class="btn pt-2" href="{{route('password.change')}}"> Change Passward  </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>  
</div>


@include('layouts.footer')
@endsection
