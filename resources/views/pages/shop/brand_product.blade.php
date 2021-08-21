@extends('layouts.header')
@section('title')
 {{$setting->name}}
@endsection
@section('content')
  @include('layouts.navbar')
  <div class="product-view">
    <div class="container">
      <h4 class="text-center text-bold text-uppercase text-dark mt-4"> {{$brand->brand_name}} Total products <span class=" badge rounded-pill bg-warning text-dark"> {{$total_product}} </span> </h4>
      <hr class="bg-secondary tb-3" style="width:400px; height:1px">

      <div class="row">
        @foreach ($products as $product)
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
            <a href="/products/{{$product->slug}}">
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
        {{ $products->links('layouts.paginationlinks') }}  
      </div>  


      {{-- show relative subcat--}}

      <h4 class="text-center text-bold text-uppercase text-dark mt-4"> Shop By Relative Category </h4>
        <div class="shop-by-category mt-2">
          <div class="owl-carousel carousel-category owl-theme">
            @foreach ($categories as $subcat)
            @php
            //get all brand details
            $category = DB::table('categories')->where('id', $subcat->category_id)->first();
            @endphp
            <div class="item">  
              <a href="/category/products/{{$category->id}}/{{$category->name}}/">
                @if ($category->category_logo)
                <img src="{{asset($category->category_logo)}}" alt=" Category Logo" class="category_logo">
                <a> {{$category->name}}  </a>   
                @else
                <a class='category'> {{$category->category_name}}  </a>   
                @endif
              </a> 
            </div> 
            @endforeach
          </div>
        </div>
        
      </div>   

      {{-- end relative brands  --}}
    </div>
  </div>           
{{-- end ajax quick view --}}
@include('layouts.quick_view')
{{-- end ajax quick view --}}
@include('layouts.footer')
@endsection
@section('script')
<script>
$(document).ready(function(){
  $('.carousel-category').owlCarousel({
    slideSpeed : 300,
    singleItem:true,
    responsiveClass:true,
    autoplay: true,
    autoPlaySpeed: 5000,
    autoPlayTimeout: 5000,
    autoplayHoverPause: true,
    responsiveClass:true,
    responsive:{
      0:{
        items:2,
        loop:true,
      },
      600:{
        items:3,
        loop:true,
        paginationSpeed : 400,
              
      },
      1000:{
        items:5,
        loop:true,
      }
    }
  });
});
</script>
 
@endsection
