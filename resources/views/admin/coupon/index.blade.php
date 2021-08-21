@extends('layouts.admin.header')
@section('style')

   
@endsection
@section('content')


<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"> Add Coupon </h5>
      </div>
      <div class="modal-body">
        <form class="form" method="post" action="{{route('coupon.store')}}">
          @csrf
      
          <div class="form-group">
              <label for="coupon_name" class="for-lable"> Coupon Code</label>

              <input type="text" class="form-control @error('coupon_name') is-invalid @enderror" name="coupon_name" value="{{ old('coupon_name') }}" required>

              @error('coupon_name')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            
          </div>
          <div class="form-group">
            <label for="discount" class="for-lable"> Coupon percentage %</label>

            <input type="text" class="form-control @error('discount') is-invalid @enderror" name="discount" value="{{ old('discount') }}">

            @error('discount')
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
          Coupons
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
                    <th scope="col"> Coupon Name</th>
                    <th>  Discount percentage </th>
                    <th scope="col"> Action </th>
                   
                  </tr>
                </thead>
                <tbody>
                  @foreach ($coupons as $key => $coupon)
                  <tr>
                    <th scope="row">{{$key +1}}</th>
                    <td>{{$coupon->coupon_name}}</td>
                    <td> {{$coupon->discount}} </td>
                    <td>

                      <a href="/admin/coupon/edit/{{$coupon->id}}" class="btn btn-info"> <i class="fas fa-edit"></i></a>
          
                      <a href="/admin/coupon/delete/{{$coupon->id}}" class="btn btn-danger" id='delete'> <i class="fas fa-trash"></i></a>
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
