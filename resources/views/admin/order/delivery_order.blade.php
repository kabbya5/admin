@extends('layouts.admin.header')
@section('content')
<div class="content">
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col"> Order Code </th>
                    <th scope="col"> Coupon Name </th>
                    <th scope="col"> Coupon Discount </th>
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
                    <td>{{$order->order_code}}</td>
                    <td>{{$order->coupon_name}}</td>
                    <td>{{$order->discount}}</td>
                    <td>{{$order->subtotal}}</td>
                    <td> {{$order->month}} </td>
                    <td> {{$order->date}} </td>
                    <th> <h4><span class="badge badge-success"> Deliveried</span></h4> </th>
                    <td>
                        <a href="/admin/view/order/{{$order->id}}" class="btn btn-info"> <i class="fas fa-eye"></i></a>
                    </td>
              </tr>
              @endforeach
            </tbody>
           
        </table>
    </div>    
</div>
    
@endsection