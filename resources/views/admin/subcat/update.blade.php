@extends('layouts.admin.header')
@section('content')
<div class="content container">
    <div class="card">
        <div class="card-header">
          Update Subcategory
        </div>
        <div class="card-body">
            <form class="form" method="post" action="/admin/sub_category/edit/{{$subcat->id}}">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="category_name" class="for-lable"> Sub  Category Name </label>
      
                    <input type="text" class="form-control @error('category_name') is-invalid @enderror" name="category_name" value="{{ $subcat->category_name }}">
      
                    @error('category_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  
                </div>
                <div class="form-group">
                  <label for="category_name" class="for-lable"> Select Category Name </label>
                  <select class="form-control @error('category_id') is-invalid @enderror" name="category_id">
                      @foreach ($categories as $category)
                          <option value="{{$category->id}}"> {{$category->name}}</option>  
                      @endforeach
                  
                  </select>
      
                  @error('category_name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                
              </div> 
              <button type="submit" class="btn btn-primary">Submit</button>
              
            </form>
        </div>
        <div class="card-footer">
            <a href="{{route('sub_categories')}}"> Sub Categories </a>
        </div>
        
      </div>
    
</div>
@endsection