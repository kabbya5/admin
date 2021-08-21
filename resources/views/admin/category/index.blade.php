@extends('layouts.admin.header')
@section('style')

   
@endsection
@section('content')


<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title" id="exampleModalLongTitle"> Add Category </h1>
      </div>
      <div class="modal-body">
        <form class="form" method="post" action="{{route('store.category')}}" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
              <label for="name" class="for-lable"> Category Name </label>

              <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}">

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
          <button type="submit" class="btn btn-primary">Submit</button>
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
    
</div>
<div class="content col-lg-10 mx-auto">
  <div class="card">
    <div class="card-header">
      Category List
      @if($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
              <li>{{$error}}</li>
          @endforeach
        </ul>
      </div>
      @endif
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary text-right" data-toggle="modal" data-target="#exampleModalCenter" style="float:right;">
        <i class="fas fa-plus fa-3x"></i>
      </button>
      
    </div>
    <div class="card-body">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Category Name</th>
            <th scope="col">Category Images </th>
            <th scope="col"> Action </th>
            
          </tr>
        </thead>
        <tbody>
          @foreach ($categories as $key => $category)
          <tr>
            <th scope="row">{{$key +1}}</th>
            <td>{{$category->name}}</td>
            <td> 
              @if(($category->category_logo))
              <img src="{{asset($category->category_logo)}}" alt="categpry_logo" style="width:80px;height:70px; ">
              @else 
              <h2> Upload Category Images </h2>
              @endif
            </td>
            <td>

              <a href="/admin/category/edit/{{$category->id}}" class="btn btn-info"> <i class="fas fa-edit"></i></a>
  
              <a href="/admin/category/delete/{{$category->id}}" class="btn btn-danger" id='delete'> <i class="fas fa-trash"></i></a>
            </td>
          </tr>
          @endforeach
        </tbody>
          
      </table>
    </div>        
  </div>
</div>
      <!-- Modal -->
     <!-- Button trigger modal -->


@endsection
