@extends('layouts.header')
@section('content')
@include('layouts.navheader')
@include('layouts.navbar')     
<section class="product-details mt-5"> 
  <div class="container-fluid">
    <div class="row">

      {{-- product-img slider --}}
      <div class="col-md-12 col-lg-6">
        <a href="{{ URL::previous() }}" class="back-link"> <i class="fas fa-chevron-left"> </i> Go Back</a>   
        <div class="img-section">                
          <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              @if (!$product->img_three)
              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active">
                  <img src="{{asset($product->main_img)}}">
              </li>
              <li data-target="#carouselExampleIndicators" data-slide-to="1">
                <img src="{{asset($product->img_one)}}">
              </li>
              <li data-target="#carouselExampleIndicators" data-slide-to="2">
                <img src="{{asset($product->img_two)}}">
              </li> 
              @else
              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active">
                <img src="{{asset($product->main_img)}}">
              </li>
              <li data-target="#carouselExampleIndicators" data-slide-to="1">
                <img src="{{asset($product->img_one)}}"> 
              </li> 
              <li data-target="#carouselExampleIndicators" data-slide-to="2">
                <img src="{{asset($product->img_two)}}">
              </li>
              <li data-target="#carouselExampleIndicators" data-slide-to="3">
                <img src="{{asset($product->img_three)}}">
              </li> 
              @endif                       
              </ol>
              <div class="carousel-inner">
                @if (!$product->img_three)
                  <div class="carousel-item active">
                    <img src="{{asset($product->main_img)}}" class="d-block w-100" alt="...">
                  </div>
                  <div class="carousel-item">
                    <img src="{{asset($product->img_one)}}" class="d-block w-100">                               
                  </div>
                  <div class="carousel-item">
                    <img src="{{asset($product->img_two)}}" class="d-block w-100" alt="...">         
                  </div>               
                @else
                  <div class="carousel-item active">
                    <img src="{{asset($product->main_img)}}" class="d-block w-100" alt="..."> 
                  </div>
                  <div class="carousel-item">
                    <img src="{{asset($product->img_one)}}" class="d-block w-100"> 
                  </div>
                  <div class="carousel-item">
                    <img src="{{asset($product->img_two)}}" class="d-block w-100" alt="...">                          
                  </div>
                  <div class="carousel-item">
                    <img src="{{asset($product->img_three)}}" class="d-block w-100" alt="...">
                  </div>  
                @endif                           
              </div>
          </div>
        </div>
      </div>
      {{-- end Product -img slider --}}

      {{-- product detail --}}
      <div class="col-md-12 col-lg-6">
        @if(!$product->subcategory_id)
        <div class="row link">
          <a href="/category/products/{{$productcat->id}}/{{$productcat->name}}/">
            <h5 class="">{{$productcat->name}} <i class="fas fa-greater-than"></i> </h5>
          </a>   
          <a href="/brand/product/{{$brand->id}}/{{$brand->brand_name}}/">
            <h5> {{$brand->brand_name}} <i class="fas fa-greater-than"></i> </h5>
          </a> 
        </div>    
        @else
        <div class="row link">
          <a href="/category/products/{{$productcat->id}}/{{$productcat->name}}/">
            <h5 class="">{{$productcat->name}} <i class="fas fa-greater-than"></i> </h5>
          </a> 
          <a href="/subcat/products/{{$productsubcat->id}}/{{$productsubcat->category_name}}/">
            <h5>{{$productsubcat->category_name}} <i class="fas fa-greater-than"></i></h5>   
          </a> 
          <a href="/brand/product/{{$brand->id}}/{{$brand->brand_name}}/">
            <h5> {{$brand->brand_name}} <i class="fas fa-greater-than"></i> </h5>
          </a>
        </div>
        @endif 
        
        <div class="name pt-3 border">
          <h4 class=" pb-2">{{$product->product_name}}</h4>
          <div class="price">
            @if ($product->discount_price == NULL)
            <span class="active-price"> TK{{$product->selling_price}} </span>
            @else
            <span class="active-price"> TK {{$product->discount_price}} </span> 
            <span class="old-price text-danger"> <del>Tk {{$product->selling_price}} </del> </span> 
            @endif
          </div>
        </div>
        <div class="input-section pt-3">
          <form action="/cart/product/add/{{$product->id}}" method="post" class="product-form">
          @csrf
            <div class="row">
              <div class="col-4">
                @if ($product->product_color)
                <div class="form-group">
                  <label for="color"> Select Color </label>
                  <select name="color" id="color" class="form-control">
                    @foreach ($product_color as $color)
                        <option value="{{$color}}"> {{$color}}</option>
                    @endforeach
                  </select>
                </div>
                @endif
              </div>
              @if ($product->product_size)
              <div class="col-4">        
                  <div class="form-group">
                    <label for="size"> Select Size </label>
                    <select name="size" id="size" class="form-control">
                      @foreach ($product_size as $size)
                          <option value="{{$size}}"> {{$size}}</option>
                      @endforeach
                    </select>
                  </div>          
              </div>
              @endif
              <div class="col-4">
                <div class="form-group">
                  <label for="exampleFormControlSelect1">Quantity</label>
                    <input class="form-control" type="number" value="1" pattern="[0-9]" name="qty">	
                </div> 
              </div>
            </div>
            <button type="submit" class="btn btn-primary"> 
              Add To Cart
            </button>
            
          </form>
          
        
        </div>
      </div>
      {{-- end product detail --}}
 

      {{--           related product   --}}

      <div class="container mt-5">
        <h4 class="text-center text-dark pt-4"> Related Product  
        </h4>
        <a href="{{route('subcat.product',[$productsubcat->id,$productsubcat->category_name])}}" class="float-right" id="shop-link"> <span> View All <i class="fas fa-arrow-right"></i></span></a>
        <hr class=" bg-info" style="width:200px; height: 2px;">
      
        <div class="related-product">
            <div class="row">
                @foreach ($related_products as $products)
                <div class="col-5 col-md-3 col-lg-2 m-3">
                  <div class="product-top">
                    <a href="/products/{{$products->slug}}">
                      <img src="{{asset($products->main_img)}}" class="d-block img-fluid">
                    </a>
                    <div class="product-label">
                      @if ($product->discount_price == NULL)
                        <span class="product-discount" style="background-color:blue; color:#fff;"> new </span>              
                      @else
                      <span class="product-discount">
                        
                          @php
                            $amount = $products->selling_price - $products->discount_price;
                            $discount = round($amount / $products->selling_price * 100);
                          @endphp
                          {{$discount}}%
                          </span> 
                          
                      @endif
                      @if($products->product_quantity == 0)
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
                    <a href="products/{{$products->slug}}/{{$product->id}}">
                      <h3> {{$products->product_name}} </h3>
                    </a>
                    @if ($products->discount_price == NULL)
                    <span class="active-price"> TK.{{$products->selling_price}} </span>
                    @else
                    <span class="active-price"> TK.{{$products->discount_price}} </span> 
                    <br>
                    <span class="old-price">TK.{{$products->selling_price}} </span> 
                    @endif
                    
                  </div>
                </div>
                @endforeach
              
            </div>
        </div>
      </div>
    </div>

    {{-- footer-nav --}}
      
    <div class="col-12 product-footer mt-5">
      <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">
            Review
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">
            Description
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false"> Contact-Info </a>
        </li>
      </ul>
      
      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

          <!-- Start comment-sec Area -->

          <section class="comment-sec-area pt-80 pb-80">
            <div class="container">
              <div class="row flex-column">
                <h5 class="text-uppercase pb-80">{{$product->comments->count()}} Comments</h5>
                <br />

                <!-- Start commentform Area -->

                <section class="commentform-area pb-120 pt-80 mb-100">
                
                  <div class="container">
                    <div class="col-lg-9 col-11 border mx-auto">
                        <div class="form-group ">
                            <form action="{{route('comment.store', $product->id)}}" method="POST">
                            @csrf
                            <label for="comment"> Comment Here</label>
                            <textarea
                              class="form-control"
                              name="message"
                              placeholder="Messege"
                            ></textarea>
                            <button type="submit" class="btn btn-info  mt-3 text-uppercase ml-3">Comment</button>
                        </form>
                        </div>
                    </div>
                  </div>

                </section>
                <!-- End commentform Area -->


              <!-- Start comment-sec Area -->
              @foreach ($product->comments as $comment)
              <div class="comment mt-5 ">
                <div class="comment-list border">
                  <div class="single-comment justify-content-between d-flex">
                    <div class="user justify-content-between d-flex">
                      <div class="thumb">
                        @if ($comment->user->profile_img)
                        <img class="img" src="{{asset($comment->user->profile_img)}}" alt="{{$comment->user->profile_img}}">
                        @else
                        <i class="fas fa-user fa-3x img pt-1 pl-2" ></i>
                        @endif 
                        
                      </div>
                      <div class="desc">
                        <h5 class="text-info">{{$comment->user->name}} 
                          <span> 
                            {{ \Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}
                          </span>
                        </h5>
                        <p class="comment">
                          {{$comment->message}}
                        </p>
                      </div>
                    </div>
                    <div class="">
                      <button class="btn btn btn-primary showhidereply" data-id="{{ $comment->id }}">
                        <span class="fa fa-reply"></span>
                    </button>
                    </div>
                  </div>
                </div>
                  @if($comment->replies->count() > 0)
                    @foreach ($comment->replies as $reply)

                    {{-- fomment-form --}}
                    <div class="comment-list left-padding reply-form" id="replycomment-{{ $comment->id }}">
                      <div class="single-comment justify-content-between d-flex">


                        <div class="user justify-content-between d-flex">
                          @auth
                          <div class="thumb">
                            <img src="{{asset(Auth::user()->profile_img)}}" alt="{{Auth::user()->image}}" width="50px"/>
                          </div>
                          <div class="desc">
                            
                            <h5><a href="#">{{Auth::user()->name}}</a></h5>
                            
                            <span class="date">{{date('D, d M Y H:i')}}</span>
                          @endauth
                            <div class="row flex-row d-flex">
                              <form action="{{route('reply.store',$comment->id)}}" method="POST">
                              @csrf
                                <div class="col-lg-12">
                                  <textarea
                                    
                                    cols="60"
                                    rows="2"
                                    class="form-control mb-10"
                                    name="message"
                                    placeholder="Messege"
                                  ></textarea>
                                </div>
                                <button type="submit" class="btn btn-info  mt-3 text-uppercase ml-3">Reply</button>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    {{-- end-comment-form --}}

                    <div class="comment-list left-padding pt-3 border">
                      <div class="single-comment justify-content-between d-flex">
                        <div class="user justify-content-between d-flex ml-5 ">
                          <div class="thumb">
                            @if ($reply->user->profile_img)
                            <img class="img" src="{{asset($reply->user->profile_img)}}" alt="{{$reply->user->profile_img}}">
                            @else
                            <i class="fas fa-user fa-3x img pt-1 pl-2" ></i>
                            @endif 
                            
                          </div>
                          <div class="desc">
                            <h5 class="text-info">{{$reply->user->name}} 
                              <span> 
                                {{ \Carbon\Carbon::parse($reply->created_at)->diffForHumans() }}
                              </span>
                            </h5>
                            <p class="comment">
                              {{$reply->message}}
                            </p>
                          </div>
                        </div>
                        <div class="">
                          <button class="btn btn-info  text-uppercase showhidereply" data-id="{{ $comment->id }}"
                            onclick="showReplyForm('{{$comment->id}}','{{$reply->user->name}}')">reply</button
                          >
                        </div>
                      </div>
                    </div>
                    @endforeach
                  
                  @else
                    {{-- fomment-form --}}
                    <div class="comment-list left-padding reply-form" id="replycomment-{{ $comment->id }}">
                      <div class="single-comment justify-content-between d-flex">


                        <div class="user justify-content-between d-flex">
                          @auth
                          <div class="thumb">
                            <img src="{{asset(Auth::user()->profile_img)}}" alt="{{Auth::user()->image}}" width="50px"/>
                          </div>
                          <div class="desc">
                            
                            <h5><a href="#">{{Auth::user()->name}}</a></h5>
                            
                            <span class="date">{{date('D, d M Y H:i')}}</span>
                          @endauth
                            <div class="row flex-row d-flex">
                              <form action="{{route('reply.store',$comment->id)}}" method="POST">
                              @csrf
                                <div class="col-lg-12">
                                  <textarea
                                    
                                    cols="60"
                                    rows="2"
                                    class="form-control mb-10"
                                    name="message"
                                    placeholder="Messege"
                                  ></textarea>
                                </div>
                                <button type="submit" class="btn btn-info text-uppercase ml-3">Reply</button>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    {{-- end-comment-form --}}
                  
                    
                @endif
                {{-- When user login show reply fourm --}}
                  
              </div>
              @endforeach
              </div>
            </div>
          </section>

          <!-- End comment-sec Area -->
            
          
        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
      
          <div class="d-flex justify-content-center m-4">
            {!!$product->product_details!!}
            </div>
    
        </div>
        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
      </div>
    </div>  
    {{-- footer nav end --}}
    
  </div>
</section>
@include('layouts.quick_view')
@include('layouts.footer')
@endsection

@section('script')


<script>
  $(document).ready(function(){
      // change the selector to use a class
      $(".showhidereply").click(function(){
          // this will query for the clicked toggle
          var $toggle = $(this); 

          // build the target form id
          var id = "#replycomment-" + $toggle.data('id'); 

          $( id ).toggle();
      });
  });
</script>
@endsection