@extends('layouts.admin.header')
@section('content')
    <div class="container">
        <h5 class="text-center text-info">
            User Infomation 
            <span class="badge badge-pill badge-success ">
                {{ \Carbon\Carbon::parse($message->created_at)->diffForhumans()}} 
            </span>
        </h5>
        <div class="row">
            <div class="col-11 col-md-6 mx-auto mb-3">
                <div class="contact-info bg-white border">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"> Name:: {{$message->name}}</li>
                        <li class="list-group-item"> PhoneNumber::{{$message->phone}}</li>
                        <li class="list-group-item">Emai::{{$message->email}}</li>
                    </ul>
                </div>
            </div>
            <div class="col-11 col-md-6 mx-auto">
                <div class="contact-message border pt-3">
                    <div class="message-header">
                        <h5 class="text-center text-info"> User Message </h5>
                    </div>
                    <p class="text-justify mt-3 p-2"> {{$message->message}}</p>
                </div>
            </div>
        </div>
    </div>
@endsection