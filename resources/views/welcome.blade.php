
@extends('layouts.header')

@section('title')
   OneTech 
@endsection

{{-- //style link for no solution I found in scss --}}
@section('style')
<!-- Important Owl stylesheet -->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.0.0-beta.3/assets/owl.carousel.min.css">
 
<!-- Default Theme -->

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.0.0-beta.3/assets/owl.theme.default.min.css">
@endsection

@section('content')
  @include('layouts.navheader') 
  @include('layouts.navbar')
  

{{-- Main carousel  --}}
<div class="main-slider">
  <div class="owl-carousel owl-theme mid-slider">
      @foreach ($sliders as $product)
      <div class="item col-md-8 mx-auto">
        <div class="product row">
          <div class="slider-content col-4 mx-auto">
            <div class="name">
              <a href="products/{{$product->slug}}">{{$product->product_name}} </a>
              <div class="price">
                @if ($product->discount_price == NULL)
                  <h2>TK. {{$product->selling_price}}</h2>
                @else
                <span> TK.{{$product->discount_price}}</span> <span class="old">TK. {{$product->selling_price}}</span> 
                @endif
                <div class="brand">
                  @if ($product->brand_id)
                  <a href="{{route('brand.products',[$product->brand_id,$product->brand_name])}}">
                    {{$product->brand_name}} </h4>
                  </a>
                  <br>
                  @endif 
                  @if ($product->category_id)
                  <a href="{{route('cat.products',[$product->category_id,$product->name])}}">
                    {{$product->name}} </h4>
                  </a>
                  @endif 
                </div>
              </div>
              <a href="products/{{$product->slug}}" class="btn"> Shop now </a>
            </div>
          </div>
          <div class="product-link col-7 mx-auto">
            <a  href="products/{{$product->slug}}">
              <img src="{{$product->main_img}}" class="img-fluid">
            </a>
          </div>   
        </div>
      </div>
      @endforeach 
  </div> 
</div>
{{-- Main carousel END --}}


{{-- Shop By Brand --}}
<div class="shop-by-category">
  <h3> Shop By Top Brand</h3>
  <div class="container">
    <div class="owl-carousel carousel-category owl-theme">
      @foreach ($brands as $brand)
      <div class="item"> 
        <a href="/brand/product/{{$brand->id}}/{{$brand->brand_name}}">
          @if ($brand->brand_logo)
              <img src="{{asset($brand->brand_logo)}}" alt=" Category Logo" class="category_logo">
              <a> {{$brand->brand_name}}  </a>   
          @else
            <a class='category'> {{$brand->brand_name}}  </a>   
          @endif
           
        </a> 
      
      </div> 
      @endforeach

    </div>
  </div>
</div>
{{-- Shop By Brand End --}}

{{-- top Product slider --}}
<div class="product-slider slider ">
  <div class="container">
    <div class="owl-carousel owl-theme feautured">
      <div class="item">
        <div class="content-header">
          <h3 class="active"> Feautured Product  </h3> <a href="{{route('shop.page')}}" class="float-right" id="shop-link"> <span> View All <i class="fas fa-arrow-right"></i></span></a>
        </div>
        <div class="row">
          @foreach ($trends as $product)
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
      <div class="item">
        <div class="content-header">
          <h3 class="active"> Trend Product  </h3> <a href="{{route('trand.products')}}" class="float-right"> View ALl </a>
        </div>
        <div class="row">
          @foreach ($trends as $product)
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
              <a href="products/{{$product->slug}}/{{$product->id}}">
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
      <div class="item">
        <div class="content-header">
          <h3 class="active"> Best Rated Product  </h3> <a href="{{route('best.rated')}}" class="float-right"> View ALl </a>
        </div>
        <div class="row">
          @foreach ($bests as $product)
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
              <a href="products/{{$product->slug}}/{{$product->id}}">
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
    </div>
  </div> 
</div>
{{-- end top product slider --}}

{{-- deal of this month --}}
<div class="deal">
  <div class="container">
    <h3 class="deal-header"> Best Deals of The Month </h3>
    <a href="{{route('deal.products')}}" class="float-right" id="shop-link"><span> Shop All <i class="fas fa-arrow-right"></i></span></a>
    <div class="row">
      @foreach ($hots as $product)
      {{-- deal of this month End --}}
      <div class="col-5 col-md-3 col-lg-2 m-3">
        <div class="product-top">
          <a href="products/{{$product->slug}}">
            <img src="{{$product->main_img}}" class="d-block img-fluid">
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
          <a href="products/{{$product->slug}}/{{$product->id}}">
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
</div>
{{--  End deal of this month End --}}



{{-- Shop By Category --}}
<div class="shop-by-category">
  <h3> Shop By Top Category</h3>
  <div class="container">
    <div class="owl-carousel carousel-category owl-theme">
      @foreach ($category as $cat)
      <div class="item"> 
        <a href="">
          @if ($cat->category_logo)
              <img src="{{asset($cat->category_logo)}}" alt=" Category Logo" class="category_logo">
              <a> {{$cat->name}}  </a>   
          @else
            <a class='category'> {{$cat->name}}  </a>   
          @endif
           
        </a> 
      
      </div> 
      @endforeach

    </div>
  </div>
</div>
{{-- Shop By Category End --}}

{{-- Mid Slider --}}
<div class="main-slider">
  <div class="owl-carousel owl-theme mid-slider">
      @foreach ($mid_slider as $product)
      <div class="item col-md-8 mx-auto">
        <div class="product row">
          <div class="slider-content col-4 mx-auto">
            <div class="name">
              <a href="products/{{$product->slug}}">{{$product->product_name}} </a>
              <div class="price">
                @if ($product->discount_price == NULL)
                  <h2>TK. {{$product->selling_price}}</h2>
                @else
                <span> TK.{{$product->discount_price}}</span> <span class="old">TK. {{$product->selling_price}}</span> 
                @endif
                <div class="brand">
                  @if ($product->brand_id)
                    <h3> {{$product->brand_name}} </h3>
                  @endif  
                </div>
              </div>
              <a href="products/{{$product->slug}}" class="btn btn-primary"> Shop now </a>
            </div>
          </div>
          <div class="product-link col-7 mx-auto">
            <a  href="products/{{$product->slug}}">
              <img src="{{$product->main_img}}" class="img-fluid">
            </a>
          </div>   
        </div>
      </div>
      @endforeach 
  </div> 
</div>

{{-- End mid slider --}}


{{-- print section --}}


<div class="deal">
  <div class="container">
    <h3 class="deal-header"> Print Your Own T-shart  </h3>
    <a href="{{$setting->facebook_url}}" target="blank" class="float-right" id="shop-link"><span> Contact Now <i class="fas fa-arrow-right"></i></span></a>
    <div class="row">
      @foreach ($print as $product)
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
          <a href="products/{{$product->slug}}/{{$product->id}}">
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
</div>

{{-- End print section --}}

{{-- ajax-quick view --}}

@include('layouts.quick_view')           
    
{{-- end ajax quick view --}}


@include('layouts.footer') 
@endsection
@section('script')
<!-- Include js plugin -->


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
{{-- carousel --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.0.0-beta.3/owl.carousel.min.js"></script>
<script src="{{asset('js/fontend/welcome.js')}}"></script>

<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

@endsection
