@extends('layouts.header')
@section('content')
  @include('layouts.navbar')
 
  <div class="product-view">
      <div class="container">
        <div class="row">
          {{-- product  --}}
            @foreach ($products as $trend)
            <div class="col-md-3 col-6">        
              <div class="product-top">
                <a href="/hello">
                  <img src="{{asset($trend->main_img)}}" class="d-block img-fluid">
                </a>
                <div class="product-label">
                  @if ($trend->discount_price == NULL)
                  <span class="product-discount" style="background-color:blue; color:#fff;"> new </span>              
                  @else
                  <span class="product-discount">   
                    @php
                      $amount = $trend->selling_price - $trend->discount_price;
                      $discount = round($amount / $trend->selling_price * 100);
                    @endphp
                    {{$discount}}%
                    </span>   
                  @endif 
                  <span class="product-sole"> Sole </span>
                </div>
                <div class="overlay">
                  <button type="button" class="btn quick-view" data-id="{{$trend->id}}" data-toggle="modal" data-target="#staticBackdrop">
                    <i class="fa fa-eye"></i>
                  </button>
                  <a href="" class="btn btn-secondary" title="Add to Wishlist"> 
                    <i class="fas fa-heart"></i>
                  </a>
                  <a href="" class="btn btn-secondary" title="Add to Cart"> 
                    <i class="fa fa-shopping-cart"></i>
                  </a>
                </div>
                </div>
                <div class="product-bottom text-center">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                  <h3> {{$trend->product_name}} </h3>
                  @if ($trend->discount_price == NULL)
                  <span class="active-price"> ৳  {{$trend->selling_price}} </span>
                  @else
                  <span class="active-price"> ৳ {{$trend->discount_price}}   </span> 
                  <span class="old-price"> ৳  {{$trend->selling_price}} </span> 
                  @endif        
                </div>
            </div>
            @endforeach  
          {{-- end product   --}}
        </div>
        <div class="paginate">
            {{ $products->links('layouts.paginationlinks') }}  
        </div>  
          {{-- show relative brands --}}
          <div class="brand">
            <h3> Shop By Relative Brand </h3>
            {{-- owl carousel --}}
            <div class="brand-carousel">
              
              <div class="owl-carousel owl-theme">
                @foreach ($brands as $brand)
                @php
                //get all brand details
                $name = DB::table('brands')->where('id', $brand->brand_id)->first();
                @endphp
                <div class="item"> 
                  <div class="brand-details"> 
                    <a href="">
                      <div class="brand-img">
                        <img src="{{asset($name->brand_logo)}}" alt="brand_log" class="img-fluid">
                      </div>
                      <div class="brand-name">
                        <h4>{{$name->brand_name}}</h4>
                      </div>
                    </a> 
                  </div> 
                </div>
                
                @endforeach
              </div>
            </div>
            {{-- end brand carousel --}}
          </div>   
          {{-- end relative brands  --}}
      </div>
  </div>
@endsection
@section('script')
  <script>
$(document).ready(function(){
  $('.owl-carousel').owlCarousel({
    loop:true,
    margin:10,
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
            nav:true
        },
        600:{
            items:3,
            nav:false
        },
        1000:{
            items:5,
            nav:true,
            loop:false
        }
    }
  });
});

  </script>  
@endsection
