@extends('layouts.header')
@section('content')

@include('layouts.navheader')
@include('layouts.navbar')

{{-- feautured product --}}

<div class="feautured-product mt-3">
    <div class="container">
      <h5 class="text-center text-dark text-uppercase pt-4"> The Available Products <span class=" badge rounded-pill bg-warning text-dark fs-1"> {{$total_product}} </span> </h5>
      <hr class=" bg-success" style="width:300px; height: 2px;">
      <div class="row">
        @foreach ($products as $product)
        <div class="col-5 col-md-3 col-lg-2 m-3">
          <div class="product-top">
            <a href="/products/{{$product->slug}}/">
              <img src="{{asset($product->main_img)}}" class="d-block img-fluid">
            </a>
            <div class="product-label">
              @if ($product->discount_price == NULL)
                <span class="product-discount" style="background-color:blue; color:#fff;"> new </span>              
              @else
              <span class="product-discount">
                
                  @php
                    $amount = $product->selling_price - $product->discount_price;
                    $discount = round($amount / $product->selling_price * 100);
                  @endphp
                  {{$discount}}%
                  </span> 
                  
              @endif
              @if($product->product_quantity == 0)
              <span class="product-sole"> Out Of stock </span>
              @endif
            </div>
            <div class="overlay">
              <!-- Qiick view  Modal Ajax -->
              <button type="button" class="btn quick-view" data-id="{{$product->id}}" data-toggle="modal" data-target="#staticBackdrop">
                <i class="fa fa-eye"></i>
              </button>
              <button class="addwishlish btn" data-id="{{$product->id}}" title="Add to Wishlist"> 
                <i class="fas fa-heart"></i>
              </button>
              <button class="addcart btn" title="Add to Cart" data-id="{{$product->id}}"> 
                <i class="fa fa-shopping-cart"></i>
              </button>
            </div>
          </div>
          <div class="product-bottom text-center">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <a href="/products/{{$product->slug}}/{{$product->id}}">
              <h3> {{$product->product_name}} </h3>
            </a>
            @if ($product->discount_price == NULL)
            <span class="active-price"> TK.{{$product->selling_price}} </span>
            @else
            <span class="active-price"> TK.{{$product->discount_price}} </span> 
            <br>
            <span class="old-price">TK.{{$product->selling_price}} </span> 
            @endif
            
          </div>
        </div>
        @endforeach  
      </div>
      {{--            Top View Product               --}}   
        <h4 class="text-center text-dark text-uppercase pt-4"> Top view Product </h4>
        <hr class=" bg-success" style="width:250px; height: 2px;">
        <div class="row">
            @foreach ($like_product as $product)
            <div class="col-5 col-md-3 col-lg-2 m-3">
              <div class="product-top">
                <a href="/products/{{$product->slug}}">
                  <img src="{{asset($product->main_img)}}" class="d-block img-fluid">
                </a>
                <div class="product-label">
                  @if ($product->discount_price == NULL)
                    <span class="product-discount" style="background-color:blue; color:#fff;"> new </span>              
                  @else
                  <span class="product-discount">
                    
                      @php
                        $amount = $product->selling_price - $product->discount_price;
                        $discount = round($amount / $product->selling_price * 100);
                      @endphp
                      {{$discount}}%
                      </span> 
                      
                  @endif
                  @if($product->product_quantity == 0)
                  <span class="product-sole"> Out Of stock </span>
                  @endif
                </div>
                <div class="overlay">
                  <!-- Qiick view  Modal Ajax -->
                  <button type="button" class="btn quick-view" data-id="{{$product->id}}" data-toggle="modal" data-target="#staticBackdrop">
                    <i class="fa fa-eye"></i>
                  </button>
                  <button class="addwishlish btn" data-id="{{$product->id}}" title="Add to Wishlist"> 
                    <i class="fas fa-heart"></i>
                  </button>
                  <button class="addcart btn" title="Add to Cart" data-id="{{$product->id}}"> 
                    <i class="fa fa-shopping-cart"></i>
                  </button>
                </div>
              </div>
              <div class="product-bottom text-center">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <a href="/products/{{$product->slug}}/{{$product->id}}">
                  <h3> {{$product->product_name}} </h3>
                </a>
                @if ($product->discount_price == NULL)
                <span class="active-price"> TK.{{$product->selling_price}} </span>
                @else
                <span class="active-price"> TK.{{$product->discount_price}} </span> 
                <br>
                <span class="old-price">TK.{{$product->selling_price}} </span> 
                @endif
                
              </div>
            </div>
            @endforeach
          
        </div>
       
        <div class="paginate">
          {{ $like_product->links('layouts.paginationlinks') }}  
        </div> 
        
    </div>
</div>
{{-- end feautured product --}}

@include('layouts.quick_view')

@include('layouts.footer')
    
