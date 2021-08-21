@extends('layouts.admin.header');
@section('content')
<div class="content container">
    <div class="card">
        <div class="card-header">
          Update Coupon
        </div>
        <div class="card-body">
            <form class="form" method="post" action="/admin/coupon/edit/{{$coupon->id}}">
                @csrf
                @method('PUT')
                
                
                <div class="form-group">
                    <label for="coupon_name" class="for-lable"> Coupon Code</label>
        
                    <input type="text" class="form-control @error('coupon_name') is-invalid @enderror" name="coupon_name" value="{{ $coupon->coupon_name }}">
        
                    @error('coupon_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    
                </div>
                <div class="form-group">
                    <label for="discount" class="for-lable"> Coupon percentage %</label>
        
                    <input type="text" class="form-control @error('discount') is-invalid @enderror" name="discount" value="{{ $coupon->discount }}">
        
                    @error('discount')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                </form>
               
        </div>
        <div class="card-footer">
            <a href="{{route('categories')}}"> All Coupon </a>
        </div>
        
      </div>
    
</div>
@endsection