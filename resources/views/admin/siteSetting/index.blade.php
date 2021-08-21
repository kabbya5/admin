@extends('layouts.admin.header')
@section('content')
<div class="content container m-3">
  <div class="card">
    <div class="card-header">
        @if (!$setting)
            Create Site Settign
        @else
            Update site Setting 
        @endif
    </div>
    <div class="card-body">
        @if (!$setting)
        <form class="form" method="post" action="{{route('setting.create')}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="vat" class="for-lable"> Product Vat <span class="required"> : *</span> </label>
                <input type="text" class="form-control @error('vat') is-invalid @enderror" name="vat" value="{{ old('vat') }}">
                @error('vat')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="shipping_charge" class="for-lable"> Shipping Charge   <span class="required"> : *</span> </label>
                <input type="text" class="form-control @error('shipping_charge') is-invalid @enderror" name="shipping_charge" value="{{ old('shipping_charge') }}">
                @error('shipping_charge')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="name" class="for-lable"> Website Name  <span class="required"> : *</span> </label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}">
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="email" class="for-lable"> Contact Email  <span class="required"> : *</span> </label>
                <input type="email" class="form-control @error('name') is-invalid @enderror" name="email" value="{{ old('email') }}">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for= " Phone" class="for-lable"> 
                    Contract Number
                </label>
                <input type="phone" class="form-control  @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}">
                @error('phone')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                @enderror
            </div>

            <div class="form-group">
                <label for=" phone" class="for-lable"> 
                   2nd  Contract Number 
                </label>
                <input type="phone" class="form-control  @error('phone2') is-invalid @enderror" name="phone2" value="{{ old('phone2') }}">
  
                @error('phone2')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="address" class="for-lable"> 
                  Office Address  <span class="required"> : *</span>
                </label>
                <input type="text" class="form-control  @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}"> 
                @error('address')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
           
            <div class="form-group">
                <label for="link" class="for-lable"> 
                  Facebook Url  <span class="required"> : FaceBook Page </span>
                </label>
                <input type="text" class="form-control  @error('facebook_url') is-invalid @enderror" name="facebook_url" value="{{ old('facebook_url') }}"> 
                @error('facebook_url')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="link" class="for-lable"> 
                  Website logo  
                </label>
                <input type="file" class="form-control  @error('logo') is-invalid @enderror" name="logo" value="{{ old('logo') }}"> 
                @error('logo')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
       
            
    

            <button type="submit" class="btn btn-primary">Submit</button>
        </form> 
        @else
        <form class="form" method="post" action="/admin/site/setting/update/{{$setting->id}}/" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="form-group">
                <label for="vat" class="for-lable"> Product Vat TK. <span class="required"> : *</span> </label>
                <input type="text" class="form-control @error('vat') is-invalid @enderror" name="vat" value="{{ $setting->vat }}">
                @error('vat')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="shipping_charge" class="for-lable"> Shipping Charge TK.  <span class="required"> : *</span> </label>
                <input type="text" class="form-control @error('shipping_charge') is-invalid @enderror" name="shipping_charge" value="{{ $setting->shipping_charge }}">
                @error('shipping_charge')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="name" class="for-lable"> Website Name  <span class="required"> : *</span> </label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $setting->name }}">
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="email" class="for-lable"> Contact Email  <span class="required"> : *</span> </label>
                <input type="email" class="form-control @error('name') is-invalid @enderror" name="email" value="{{ $setting->email }}">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="" class="for-lable"> 
                    Contract Number
                </label>
                <input type="phone" class="form-control  @error('pnumber_two') is-invalid @enderror" name="phone" value="{{ $setting->phone }}">
                @error('phone')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                @enderror
            </div>

            <div class="form-group">
                <label for=" phone" class="for-lable"> 
                   2nd  Contract Number 
                </label>
                <input type="phone" class="form-control  @error('phone2') is-invalid @enderror" name="phone2" value="{{ $setting->phone2 }}">
  
                @error('phone2')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="address" class="for-lable"> 
                  Office Address  <span class="required"> : *</span>
                </label>
                <input type="text" class="form-control  @error('address') is-invalid @enderror" name="address" value="{{ $setting->address }}"> 
                @error('address')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="link" class="for-lable"> 
                  Facebook Url  <span class="required"> : FaceBook Page </span>
                </label>
                <input type="text" class="form-control  @error('facebook_url') is-invalid @enderror" name="facebook_url" value="{{ $setting->facebook_url}}"> 
                @error('facebook_url')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="link" class="for-lable"> 
                  Website logo  
                </label>
                <input type="file" class="form-control  @error('logo') is-invalid @enderror" name="logo" value="{{$setting->logo}}"> 
                @error('logo')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="old-logo"> Old Image</label> <br>
                <img src="{{asset($setting->logo)}}" alt="" style="width:70px; height: 70px; margin-top:15px;">
                <input type="hidden" name="old_logo" value="{{$setting->logo}}">
            </div>

            <button type="submit" class="btn btn-primary"> Update </button>
        </form> 
        @endif
    </div>        
  </div>
</div>
@endsection
