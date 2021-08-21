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
            <th> Order Code </th>
            <th> Activity </th>
            <th> Status </th>
            <th scope="col"> Action </th> 
          </tr>
          </thead>
          <tbody>
          @foreach ($userOrder as $key => $order)
          <tr>
            <th scope="row">{{$key +1}}</th>
            <td class="text-info"> TK {{$order->subtotal}}</td>
            <td> {{$order->month}} </td>
            <td> {{$order->order_code}} </td>
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
          {{ $userOrder->links('layouts.paginationlinks') }}  
        </div>
    </div>    
</div>
@endsection