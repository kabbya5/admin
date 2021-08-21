@extends('layouts.admin.header')
@section('content')
<div class="content">
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
                    <td> {{$order->date}} </td>
                    <th> <h4><span class="badge badge-primary">New</span></h4> </th>
                    <td>
                        <a href="/admin/view/order/{{$order->id}}/" class="btn btn-info"> <i class="fas fa-eye"></i></a>
                    </td>
              </tr>
              @endforeach
            </tbody>
        </table>
    </div>    
</div>
    
@endsection