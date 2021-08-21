@extends('layouts.admin.header')
@section('content')

<div class="pament-stting">
  <div class="col-md-8 mx-auto">
    <div class="card">
      <div class="card-header">
        <h4 class="text-center text-info"> Pamment Setting </h4>
      </div>

      <div class="cad-body mt-3">
        @if ($payment_setting)
        <form class="form" method="post" action="/admin/payment/setting/update/{{$payment_setting->id}}">
          @csrf
          @method('put')
          <div class="form-group">
            <label for="pnumber_one" class="for-lable"> Personal Number One  <span class="required"> : *</span> </label>
    
            <input type="phone" class="form-control @error('pnumber_one') is-invalid @enderror" name="pnumber_one" value="{{ $payment_setting->pnumber_one }}">
    
            @error('pnumber_one')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
                
            </div>
            <div class="form-group">
              <label for="pnumber_two" class="for-lable"> 
                Personal Number Two 
              </label>
    
              <input type="phone" class="form-control  @error('pnumber_two') is-invalid @enderror" name="pnumber_two" value="{{ $payment_setting->pnumber_two }}">
    
              @error('pnumber_two')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
              
            </div>
            <div class="form-group">
              <label for="pnumber_text" class="for-lable"> 
                How custorm can payment <span class="required"> : *</span>
              </label>
  
              <textarea name="pnumber_text" id="" cols="30" rows="3" class="form-control @error('pnumber_text') is-invalid @enderror"> {{$payment_setting->pnumber_text}}</textarea>
  
              @error('pnumber_text')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
        
            </div>
    
            <div class="form-group">
              <label for="anumber" class="for-lable"> 
                Agent or Payment Number <span class="required"> : *</span>
              </label>
              {{-- anumber = Agent number --}}
              <input type="phone" class="form-control  @error('anumber') is-invalid @enderror" name="anumber" value="{{$payment_setting->anumber }}"> 
    
              @error('anumber')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
          
              </div>
       
            <div class="form-group">
              <label for="anumber_text" class="for-lable"> 
                  Other Analytice <span class="required"> : *</span>
              </label>
    
              <textarea name="anumber_text" id="" cols="30" rows="3" class="form-control @error('anumber_text') is-invalid @enderror"> {{$payment_setting->anumber_text }}</textarea>
    
              @error('anumber_text')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            
            </div>
            <button type="submit" class="btn btn-primary w-100 text-center text-uppercase">Update</button>
        </form> 
        @else
        <form class="form" method="post" action="{{route('payment.create')}}">
          @csrf
          <div class="form-group">
            <label for="pnumber_one" class="for-lable"> Personal Number One  <span class="required"> : *</span> </label>
    
            <input type="phone" class="form-control @error('pnumber_one') is-invalid @enderror" name="pnumber_one" value="{{old('pnumber_one')}}">
    
            @error('pnumber_one')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
                
            </div>
            <div class="form-group">
              <label for="pnumber_two" class="for-lable"> 
                Personal Number Two 
              </label>
    
              <input type="phone" class="form-control  @error('pnumber_two') is-invalid @enderror" name="pnumber_two" value="{{old('pnumber_two') }}">
    
              @error('pnumber_two')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
              
            </div>
            <div class="form-group">
              <label for="pnumber_text" class="for-lable"> 
                How custorm can payment <span class="required"> : *</span>
              </label>
  
              <textarea name="pnumber_text" id="" cols="30" rows="3" class="form-control @error('pnumber_text') is-invalid @enderror"> {{old('pnumber_text')}}</textarea>
  
              @error('pnumber_text')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
        
            </div>
    
            <div class="form-group">
              <label for="anumber" class="for-lable"> 
                Agent or Payment Number <span class="required"> : *</span>
              </label>
              {{-- anumber = Agent number --}}
              <input type="phone" class="form-control  @error('anumber') is-invalid @enderror" name="anumber" value="{{old('anumber') }}"> 
    
              @error('anumber')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
          
              </div>
       
            <div class="form-group">
              <label for="anumber_text" class="for-lable"> 
                  Other Analytice <span class="required"> : *</span>
              </label>
    
              <textarea name="anumber_text" id="" cols="30" rows="3" class="form-control @error('anumber_text') is-invalid @enderror"> {{old('anumber_text') }}</textarea>
    
              @error('anumber_text')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            
            </div>
            <button type="submit" class="btn btn-primary w-100 text-center text-uppercase">Create</button>
        </form> 
        @endif
        
      </div>
    </div>
  </div>
</div>

@endsection
