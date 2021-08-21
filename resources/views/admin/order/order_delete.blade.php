@extends('layouts.admin.header')
@section('content')
<div class="content">
    <h5 class="text-info text-center text-bold text-capitalize">
        Delete only 2 Years ago Data
    </h5>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col"> Total </th>
                    <th>  Month </th>
                    <th>  Date </th>
                    <th> Status </th>
                    <th scope="col"> Action </th> 
                </tr>
            </thead>
            <tbody>
              @foreach ($orders as $key => $order)
              <tr>
                    <th scope="row">{{$key +1}}</th>
                    <td>{{$order->subtotal}}</td>
                    <td> {{$order->month}} </td>
                    <td>  {{ \Carbon\Carbon::parse($order->created_at)->diffForhumans()}} </td>
                    <th> <h4><span class="badge badge-primary">New</span></h4> </th>
                    <td>
                        <a href="{{route('order_delete',$order->id)}}" class="btn btn-info"  id='delete'> <i class="fas fa-trash-alt"></i></a>
                    </td>
              </tr>
              @endforeach
            </tbody>
           
        </table>
    </div>  
    <div class="paginate mb-4 d-flex justify-content-center">
        {{ $orders->links('layouts.paginationlinks') }}  
    </div>    
</div>
    
@endsection