@extends('layouts.admin.header');
@section('content')
<div class="content container">
    <div class="card">
        <div class="card-header">
          Update Category
        </div>
        <div class="card-body">
            <form class="form" method="post" action="/admin/category/edit/{{$category->id}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name" class="for-lable"> Category Name  </label>
   
                    <input id="text" type="text" 
                        class="form-control @error('name') is-invalid @enderror" 
                        name="name" value="{{ $category->name}}">

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  
                </div>
                <div class="form-group">
                    <label for="fustomFile" class="for-lable"> 
                        Category Image <i class="fa fa-file-image-o" aria-hidden="true"></i>
                    </label>
      
                    <input type="file" class="form-control  @error('category_logo') is-invalid @enderror" name="category_logo" value="{{ old('category_logo') }}" id="customFile">
      
                    @error('category_logo')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  
                
                </div>
                <div class="form-group">
                    <label for="old-logo"> Old Image</label>
                    <img src="{{asset($category->category_logo)}}" alt="" style="width:70px; height: 70px; margin-top:15px;">
                    <input type="hidden" name="old_logo" value="{{$category->category_logo}}">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div class="card-footer">
            <a href="{{route('categories')}}"> All Category </a>
        </div>
        
      </div>
    
</div>
@endsection