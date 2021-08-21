@extends('layouts.admin.header')
@section('content')
<div class="content container">
    <div class="card">
        <div class="card-header">
          Update Brand
        </div>
        <div class="card-body">
            <form class="form" method="post" action="/admin/brand/edit/{{$brand->id}}" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="brand_name" class="for-lable"> Brand Name </label>
      
                    <input type="text" class="form-control @error('brand_name') is-invalid @enderror" name="brand_name" value="{{$brand->brand_name }}">
      
                    @error('brand_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  
                </div>
                <div class="form-group">
                    <label for="fustomFile" class="for-lable"> 
                        Brand Logo <i class="fa fa-file-image-o" aria-hidden="true"></i>
                    </label>
      
                    <input type="file" class="form-control  @error('brand_logo') is-invalid @enderror" name="brand_logo" value="{{ old('brand_logo') }}" id="customFile">
      
                    @error('brand_logo')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  
                
                </div>
                <div class="form-group">
                    <label for="old-logo"> Old Logo</label>
                    <img src="{{asset($brand->brand_logo)}}" alt="" style="width:70px; height: 70px; margin-top:15px;">
                    <input type="hidden" name="old_logo" value="{{$brand->brand_logo}}">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div class="card-footer">
            <a href="{{route('brands')}}"> All Brand </a>
        </div>
        
      </div>
    
</div>
@endsection