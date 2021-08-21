@extends('layouts.header')
@include('layouts.navheader')
@include('layouts.navbar')


@section('content')
<div class="serch-view">
    @if ($search_products->count() > 0)
    <div class="container">
        <div class="row">
            @foreach ($search_products as $product)
            {{-- deal of this month End --}}
            <div class="col-5 col-md-3 col-lg-2 m-3">
                <div class="product-top">
                    <a href="products/{{$product->slug}}">
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
                    <a href="products/{{$product->slug}}">
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
    </div>
    <div class="paginate mb-4 d-flex justify-content-center">
        {{ $search_products->withQueryString()->links('layouts.paginationlinks') }} 
    </div>
    @else
    <div class="search-message mt-5 mb-5">
        <h4 class="text-center text-danger"> Result for search (0) </h4>     
    </div>  
    <div class="suggest-tag container">
        <h6 class="text-left"> Try this for get quick respons </h6>
        <div class="row">
            <div class="form-group ml-5 col-3 col-md-2">
                <form action="{{route('auto.input')}}" method="GET">
                    @csrf
                    <input type="hidden" value="1" name="product_search">
                    <button type="submit" class="btn btn-success"> Cleck Here  </button>
                </form>
            </div>
        </div>
    </div>
    @endif
   
</div>  

@include('layouts.footer')
@endsection
