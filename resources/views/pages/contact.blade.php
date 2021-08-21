@extends('layouts.header')
@section('content')
@include('layouts.navheader')
    @include('layouts.navbar')
    <div class="contact">
        <div class="container">
            <div class="contact-header">
                <div class="contact-header-text col-10 col-md-10 mx-auto border">
                    <small class="d-flex justify-content-center">
                        Get in Touch 
                    </small>
                    <p class="text-center">
                        Please fill out quick form and we will be in touch with lightening speed.
                    </p>
                </div>
                <div class="row">

                    {{--       Contact Info Start     --}}

                    <div class="address col-8 col-md-5 mx-auto">
                        <div class="d-flex justify-content-left">
                            <div class="icon mt-3">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="contact-info ml-3">
                                <h6> Address</h6>
                                @foreach ($addresses as $address)
                                    <spam class="text-capitalize"> {{$address}},</spam> <br>
                                @endforeach
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-left">
                            <div class="icon">
                                <i class="fas fa-envelope ml-2"></i>
                            </div>
                            <div class="contact-info">
                                <div class="contact- ml-3">
                                    <h6> Email </h6>
                                    <span>{{$setting->email}}</span>
                                </div>
                            </div>
                        </div>
                 
                        <div class="d-flex justify-content-left">
                            <div class="icon mt-2">
                                <i class="fas fa-mobile ml-3"></i>
                            </div>
                            <div class="contact-info ml-3 ">
                                <h6> Phone </h6>
                                <span>{{$setting->phone}}</span> <br>
                                <span>{{$setting->phone2}}</span>
                            </div>
                        </div>
                    </div>

                    {{--          End Contact Info       --}}
                    
                    {{--       Contact Form Start      --}}

                    <div class="contact-form col-11 col-md-6 mx-auto border mb-5">
                        <div class="form-input">
                            <div class="form-header">
                                <small> 
                                    Contact Form
                                </small>
                                <h2 class="text-center">
                                    Sent us a <span> Message </span>
                                </h2>
                            </div>
                            
                            <form action="{{route('contact')}}" class="form" method="POST">
                                @csrf
                                <div class="form-group">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ old('name')}}" placeholder="Full Name">
                                    @error('name')
                                    <div class="alert alert-danger">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="phone" class="form-control @error('phone') is-invalid @enderror" 
                                        name="phone" value="{{ old('phone') }}" placeholder="Phone Number">
                                    @error('phone')
                                    <div class="alert alert-danger">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                      name="email" value="{{ old('email') }}" placeholder="Your Email">
                                    @error('email')
                                    <div class="alert alert-danger">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <textarea name="message" id="" cols="10" rows="4" class="form-control @error('message') is-invalid @enderror" value="{{ old('message') }}" placeholder="Message"></textarea>
                                    @error('message')
                                    <div class="alert alert-danger">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="submit-btn">

                                </div>
                                <button class="btn btn-primary" type="submit"> Submit  </button>
                            </form>

                        </div>
                    </div>

                   {{--          End  Contact Form        --}}


                </div>
            </div> 
        </div>  
    </div>

@include("layouts.footer")   
@endsection