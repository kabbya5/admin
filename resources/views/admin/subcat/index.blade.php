@extends('layouts.admin.header')
@section('style')

   
@endsection
@section('content')


<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"> Add Sub Category </h5>
        <a href="{{route('categories')}}">
            <i class="fas fa-plus fa-3x"></i>
        </a>
      </div>
      <div class="modal-body">
        <form class="form" method="post" action="{{route('sub_category.store')}}">
          @csrf
      
          <div class="form-group">
              <label for="category_name" class="for-lable"> Sub  Category Name </label>

              <input type="text" class="form-control @error('category_name') is-invalid @enderror" name="category_name" value="{{ old('category_name') }}">

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
      <div class="modal-footer">
        <a href="{{route('categories')}}">
            <button class="btn btn-primary"> Create Category </button> 
        </a>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
    
</div>
<div class="content container">
    <div class="card">
        <div class="card-header">
          Sub Category
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
                    <th scope="col"> Categoy Name</th>
                    <th>  Sub Category Name</th>
                    <th scope="col"> Action </th>
                   
                  </tr>
                </thead>
                <tbody>
                  @foreach ($subcats as $key => $subcat)
                  <tr>
                    <th scope="row">{{$key +1}}</th>
                    <td>{{$subcat->name}}</td>
                    <td>{{$subcat->category_name}}</td>
                    <td>

                      <a href="/admin/sub_category/edit/{{$subcat->id}}" class="btn btn-info"> <i class="fas fa-edit"></i></a>
          
                      <a href="/admin/sub_category/delete/{{$subcat->id}}" class="btn btn-danger" id='delete'> <i class="fas fa-trash"></i></a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
               
            </table>
        </div>       
      </div>
      <!-- Modal -->
     <!-- Button trigger modal -->


@endsection
