@extends('layouts.admin.header')

@section('content')
    <div class="view-product container">
        <div class="row bg-white border">
            <div class=" col-11 col-md-5 mx-auto mt-3 mb-3">
                <div class="product-info">
                    <div class="d-flex justify-content-center mb-3">
                        <img src="{{asset($product->main_img)}}" style="width: 250px; height:220px" >
                    </div>
                    <h6 class="name text-center text-danger">
                        Name:: <span class="text-info">{{$product->product_name}} </span> 
                    </h6>
                    <h6 class="name text-center text-danger">Cat::<span class="text-info"> {{$product->name}}</span> </h6>
                    <h6 class="name text-center text-danger">SubCat::<span class="text-info"> {{$product->category_name}}</span> </h6>
                    <h6 class="name text-center text-danger">Brand::<span class="text-info"> {{$product->brand_name}}</span> </h6>
                    <h6 class="name text-center text-danger">Code::<span class="text-info"> {{$product->product_code}}</span> </h6>
                    <h6 class="name text-center text-danger">Color::<span class="text-info"> {{$product->product_color}}</span> </h6>
                    <h6 class="name text-center text-danger">Size::<span class="text-info"> {{$product->name}}</span> </h6>
                    <h6 class="name text-center text-danger">Qty::<span class="text-info"> {{$product->product_quantity}}</span> </h6>
                    <h6 class="name text-center text-danger">Selling Price::<span class="text-info"> TK{{$product->selling_price}}</span> </h6>
                    <h6 class="name text-center text-danger">Discount Price::<span class="text-info"> Tk{{$product->discount_price}}</span> </h6>
                    <h6 class="name text-center text-danger">Product-link::<span class="text-info"> {{$product->social_link}}</span> </h6>
                </div>
            </div>
            <div class="col-11 col-md-5 mx-auto mt-3">
                <div class="product-selling-info">
                    <div class="d-flex justify-content-center mb-3">
                        <img src="{{asset($product->main_img)}}" style="width: 250px; height:220px">
                    </div>
                    <h6 class="name text-center text-danger">
                        Name:: <span class="text-info">{{$product->product_name}} </span> 
                    </h6>
                    <h6 class="name text-center text-danger">
                        Seller Name:: <span class="text-info">{{$product->username}} </span> 
                    </h6>
                    <h6 class="name text-center text-danger">
                        Seller Email:: <span class="text-info">{{$product->email}} </span> 
                    </h6>
                    <h6 class="name text-center text-danger"> Total View::<span class="text-info"> {{$product->view}}</span> </h6>
                    <h6 class="name text-center text-danger"> Total Sales::<span class="text-info"> {{$product_order->count()}}</span> </h6>
                    <h6 class="name text-center text-danger"> Total Earn::<span class="text-info"> Tk {{$total_earn}}</span> </h6>  
                    <h6 class="name text-center text-danger"> Total Earn in {{$month}}::<span class="text-info"> Tk {{$month_earn}}</span> </h6> 
                    @if ($last_sales)
                    <h6 class="name text-center text-danger"> Last Sales ::<span class="text-info">  {{ \Carbon\Carbon::parse($last_sales->created_at)->diffForhumans()}}</span> </h6>           
                    @endif
                   
                </div>
            </div>
        </div>
        <div class="button-group d-flex justify-content-center m-3">
            <a href="/admin/product/edit/{{$product->slug}}/{{$product->id}}" class="btn btn-info ml-2"> <i class="fas fa-edit"></i></a>
            <a href="{{route('product.view',$product->id)}}" class="btn btn-success ml-2"> <i class="fas fa-eye"></i></a>
            <a href="/admin/product/delete/{{$product->slug}}/{{$product->id}}" class="btn btn-danger ml-2" id='delete'> <i class="fas fa-trash"></i></a>
        </div>
    </div>
@endsection
