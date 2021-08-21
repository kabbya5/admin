@extends('layouts.admin.header')

@section('content')
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title" id="exampleModalLongTitle"> Add Brand </h1>
      </div>
      <div class="modal-body">
        <form class="form" method="post" action="{{route('brand.store')}}" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
              <label for="brand_name" class="for-lable"> Brand Name </label>

              <input type="text" class="form-control @error('brand_name') is-invalid @enderror" name="brand_name" value="{{ old('brand_name') }}">

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
<div class="content container">
  <div class="card">
    <div class="card-header">
      Brand List
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
        <table class="table table-bordered ">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Brand Name</th>
                <th scope="col">Brand Loge </th>
                <th scope="col"> Action </th>
                
              </tr>
            </thead>
            <tbody>
              @foreach ($brands as $key => $brand)
              <tr>
                <th scope="row">{{$key +1}}</th>
                <td>{{$brand->brand_name}}</td>
                <td> 
                  @if(($brand->brand_logo))
                  <img src="{{asset($brand->brand_logo)}}" alt="brand logo" style="width:80px;height:70px; ">
                  @else 
                  <h2> Upload Brand Images </h2>
                  @endif
                </td>
                <td>

                  <a href="/admin/brand/edit/{{$brand->id}}" class="btn btn-info"> <i class="fas fa-edit"></i></a>
      
                  <a href="/admin/brand/delete/{{$brand->id}}" class="btn btn-danger" id='delete'> <i class="fas fa-trash"></i></a>
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
