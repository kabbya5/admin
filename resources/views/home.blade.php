@extends('layouts.header')
@section('content')
@include('layouts.navheader')
@include('layouts.navbar')
@include('layouts.sidebar')

{{--          User Model Upload Phote   --}}


<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title" id="exampleModalLongTitle"> Upload  Photo </h1>
        </div>
        <div class="modal-body">
          <form class="form" method="post" action="{{route('profileImg.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="fustomFile" class="for-lable"> 
                Profile Image <i class="fa fa-file-image-o" aria-hidden="true"></i>
              </label>
  
              <input type="file" class="form-control @error('profile_img') is-invalid @enderror" 
                            name="profile_img" value="{{old('profile_img')}}"  onchange="readURLImage(this)";>
  
              @error('profile_img')
                  <span class="invalid-feedback" role="alert">
                      {{ $message }}
                  </span>
              @enderror
              <img src="" id="profile_img" alt="">
            
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


{{--          User Model Upload Phote        --}}

{{--              Order  Table                 --}}

<div class="content ">
  <div class="card-body" style="overflow: auto">
    @if($orders->count() > 0)
    <table class="table table-bordered">
      <thead>
        <tr>
          <th scope="col">Sl No </th>
          <th> Order Code </th>
          <th scope="col"> Total </th>
          <th>  Month </th>
          <th>  Activity </th>
          <th> Status </th>
          <th scope="col"> Action </th> 
        </tr>
        </thead>
        <tbody>
        @foreach ($orders as $key => $order)
        <tr>
          <th scope="row">{{$key +1}}</th>
          <th scope="row">{{$order->order_code}}</th>
          <td class="text-info"> TK {{$order->subtotal}}</td>
          <td> {{$order->month}} </td>
          <td> {{ \Carbon\Carbon::parse($order->updated_at)->diffForhumans()}} </td>
          <th> 
            @if($order->status == 0)
            <h4 class=""> 
                <span class="badge badge-warning">Panding</span>
            </h4>
            @elseif($order->status == 1)
            <h4 class=""> <span class="badge badge-primary">Accept Order</span> </h4>
            @elseif($order->status == 2)
            <h4 class=""><span class="badge badge-info"> Process </span>  </h4>
            @elseif($order->status == 3)
            <h4 class=""> <span class="badge badge-success"> Delivered </span> </h4>
            @elseif($order->status == 4)
            <h4 class=""> <span class="badge badge-danger"> Cnacle </span></h4>
            @endif
          </th>
          <td>
              <a href="/orders/{{$order->id}}/{{$order->slug}}/" class="btn btn-info"> <i class="fas fa-eye"></i></a>
          </td>
          </tr>
          @endforeach
          </tbody> 
      </table>
      <div class="paginate mb-4">
        {{ $orders->links('layouts.paginationlinks') }}  
      </div>
    @else
    <div class="no-order">
      <h5 class="text-uppercase text-info text-center mt-3 border p-2" > Order Not Found Thank you for register </h5>
    </div>
    @endif
  </div>    
</div>

{{--                 End Order Table            --}}



@include('layouts.footer')
@endsection
@section('script')
<script>

   
</script>  
@endsection
