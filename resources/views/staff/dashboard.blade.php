@extends('staff.header')

@section('content')
<div class="container-fluid px-lg-4">                   
    <div class="row">
        <div class="col-md-12 mt-lg-4 mt-4">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        </div>
    </div>
    {{--         Sales Report            --}}
    <div class="col-md-12">
        <div class="row">
            <div class="col-sm-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Sales</h5>
                        <h1 class="display-5 mt-1 mb-3"> {{$today_orders->count()}} </h1>
                        <div class="mb-1">
                            <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> {{$todayPerSales}}% </span>
                            <span class="text-muted">Since last day </span>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="col-sm-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Sales</h5>
                        <h1 class="display-5 mt-1 mb-3">{{$currentWeek_orders->count()}}</h1>
                        <div class="mb-1">
                            <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> {{$weekPerSales}}% </span>
                            <span class="text-muted"> Since last week</span>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="col-sm-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Sales</h5>
                        <h1 class="display-5 mt-1 mb-3">{{$currentMonth_orders->count()}}</h1>
                        <div class="mb-1">
                            <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> {{$monthPerSales}} % </span>
                            <span class="text-muted">Since last Month </span>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="col-sm-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Earnings</h5>
                        <h1 class="display-5 mt-1 mb-3"> TK {{$currentMonth_amount}} </h1>
                        <div class="mb-1">
                            <span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> {{$monthPerAmount}}% </span>
                            <span class="text-muted">Since last Month </span>
                        </div>
                    </div>
                </div>
                
            </div>
                        
                        
        </div>
    </div>

    {{--            User Amd SubAdmin        --}}

    <div class="col-md-12">
        <div class="row">
            <div class="col-sm-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-4"> Total Product </h5>
                        <a href="{{route('all.products')}}">
                            <h1 class="display-5 mt-1 mb-3"> {{$products->count()}} </h1> 
                        </a>
                        <div class="mb-1">
                            <a href="{{route('stock.management')}}">
                                <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> {{$updatePro->count()}} </span>
                                <span class="text-muted"> Products Need Update </span>
                            </a>
                        </div>
                    </div>
                </div>    
            </div>
            <div class="col-sm-3">
                <div class="card">
                    <a href="{{route('all.users')}}">
                        <div class="card-body">
                            <h5 class="card-title mb-4"> Users </h5>
                            <h1 class="display-5 mt-1 mb-3">{{$users}}</h1>
                            <div class="mb-1">
                                <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> {{$newUsers}} </span>
                                <span class="text-muted"> New User In This {{$currentMonth}} </span>
                            </div>
                        </div>
                    </a>
                </div>
                
            </div>
            <div class="col-sm-3">
                <a href="{{route('all.admin')}}">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Admin</h5>
                            <h6 class="display-5 mt-1 mb-3"> For Any Chang kabbya44@gmail.com</h6>
                            <div class="mb-1">
                                <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> {{$admin}}  </span>
        
                            </div>
                        </div>
                   </div>
                </a> 
                
            </div>
            <div class="col-sm-3">
                <a href="{{route('all.seller')}}">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Seller</h5>
                            <h1 class="display-5 mt-1 mb-3"> {{$seller}} </h1>
                            <div class="mb-1">
                                <span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> {{$newSeller}}</span>
                                <span class="text-muted">New Added Seller In {{$currentMonth}} </span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
                        
                        
        </div>
    </div>

    {{--               Today order         --}}

    <div class="col-md-12 mt-4">
        <div class="card">
            <div class="card-body">
            <!-- title -->
            <div class="d-md-flex align-items-center">
                <div>
                    <h4 class="card-title"> Today Orders </h4>
                    <h5 class="card-subtitle"> Overview of Todays Order </h5>
                </div>
            </div>
            <!-- title -->
        </div>
            <div class="table-responsive">
                <table class="table v-middle">
                    <thead>
                        <tr class="bg-light">
                            <th class="border-top-0"> Images </th>
                            <th class="border-top-0"> Product Name</th>
                            <th class="border-top-0"> Qty</th>
                            <th class="border-top-0"> Subtotal </th>
                            <th class="border-top-0"> Stutus </th>
                            <th class="border-top-0"> Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($today_orders as $order )
                                    
                        <tr>
                        
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="m-r-10">
                                        <a href="/products/{{$order->slug}}">
                                            <img src="{{asset($order->main_img)}}" style="display: block; object-fit:cover; width:50px; height:50px; border-radius: 50%; border:2px solid #ff5c23;">
                                        </a>
                                    </div>
                                    <div class="">
                                        <h4 class="m-b-0 font-16">{{$order->product_code}}</h4>
                                    </div>
                                </div>
                            </td>
                            
                            </td>
                            <td>{{$order->product_name}}</td>
                            <td>{{$order->quantity}}</td>
                            <td>
                                TK {{$order->totalprice}}
                            </td>
                            <td> 
                                <a href="{{route('all.order')}}" class="text-dark">
                                    {{\Carbon\Carbon::parse($order->created_at)->diffForHumans()}}
                                    @if ($order->status == 0)
                                    <span class="badge badge-pill badge-danger">
                                        New
                                    </span>
                                    @else
                                    <span class="badge badge-pill badge-success">
                                        Viewed
                                    </span>
                                    @endif
                                </a>
                            </td>
                            <td>  
                                <a href="{{route('all.order')}}" class="btn btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>        
                        @endforeach
                    </tbody>
                </table> 
            </div>
        </div>
    </div>

     <!-- column -->
    <div class="col-md-12 mt-4">
        <div class="card">
            <div class="card-body">
            <!-- title -->
            <div class="d-md-flex align-items-center">
                <div>
                    <h4 class="card-title">Top Selling Products</h4>
                    <h5 class="card-subtitle">Overview of Top Selling Items</h5>
                </div>
                <div class="ml-auto">
                    <div class="dl">
                        <select class="custom-select">
                            <option value="0" selected="">Monthly</option>
                            <option value="1">Daily</option>
                            <option value="2">Weekly</option>
                            <option value="3">Yearly</option>
                        </select>
                    </div>
                </div>
            </div>
            <!-- title -->
        </div>
            <div class="table-responsive">
                <table class="table v-middle">
                    <thead>
                        <tr class="bg-light">
                            <th class="border-top-0"> Images </th>
                            <th class="border-top-0"> Product Name</th>
                            <th class="border-top-0"> Selling Price</th>
                            <th class="border-top-0"> Discount Price </th>
                            <th class="border-top-0"> Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($topsales as $sales )
                                    
                        <tr>
                        
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="m-r-10">
                                        <a href="/products/{{$sales->slug}}">
                                            <img src="{{asset($sales->main_img)}}" style="display: block; object-fit:cover; width:50px; height:50px; border-radius: 50%; border:2px solid #ff5c23;">
                                        </a>
                                    </div>
                                    <div class="">
                                        <h4 class="m-b-0 font-16">{{$sales->product_code}}</h4>
                                    </div>
                                </div>
                            </td>
                            
                            </td>
                            <td>{{$sales->product_name}}</td>
                            <td>{{$sales->selling_price}}</td>
                            <td>
                                TK {{$sales->discount_price}}
                            </td>
 
                            <td>  
                                <a href="{{route('product.view',$sales->id)}}" class="btn btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>        
                        @endforeach
                    </tbody>
                </table>
                </div> 
                <div class="paginate mb-4">
                    {{ $topsales->links('layouts.paginationlinks') }}  
                </div> 
                
             </div>
        </div>
    </div>
    

</div>

@endsection
