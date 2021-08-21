@extends('layouts.header')

@section('content')
@include('layouts.navheader')
@include('layouts.navbar')

{{-- cart section start --}}
<section class="usercart  pb-5">
  <div class="container">
      <h4 class="p-3 mt-4 text-center text-uppercase text-success"> SheckOut Page</h4>
      <div class="cart-table">
        {{-- shiping cart table --}}
        <table class="table table-bordered">                     
            <thead>
              <tr>
                <th scope="col"> Product </th>
                <th scope="col"> Quantity</th>
                <th scope="col"> Price </th>
                <th scope="col"> Total </th>
              </tr>
            </thead>
            <tbody>
              @foreach ($cart as $item)              
                <tr>
                  <th class="product-img" scope="row">
                    <div class="img_div  d-flex justify-content-around align-items-center">
                      <img src=" {{asset($item->options->image)}}" class="img-fluid my-2" alt="product-img">
                      <div class="name">
                        <h5 class="product-name mx-2">{{$item->name}}</h5> 
                        <a href="/remove/cart/{{$item->rowId}}"> <i class="fas fa-trash mt-4 "></i> </a>
                      </div>       
                    </div>         
                  </th>
                  <td class="qty">
                    <form action="{{route('update.cart')}}" class="my-lg-5 m-2" method="POST">
                      @method('put')
                      @csrf
                      <input type="hidden" name="productid" value="{{ $item->rowId }}">
                      <input type="number" name="qty" value="{{$item->qty}}" style="width:60px;" class="form-control">
                      <button type="submit" class="btn btn-success btn-sm">
                        <i class="fas fa-check"></i>
                      </button>
                    </form>
                  </td>
                  <td class="price"> 
                    <span class="text-success text-center"> TK  </span>
                      {{$item->price}} 
                  </td>
                  <td class="total">
                    <span class="text-success text-center"> TK  </span> {{$item->price * $item->qty}} 
                  </td>
                </tr>
              @endforeach
            </tbody>
        </table>
        {{-- shiping cart table end --}}
      </div>  
      {{-- coupon  --}}
      <div class="row coupon-amount">
        @if (Session::has('coupon'))
            <div class="coupon col-11 col-md-5 mx-auto pt-5 pb-5">
              <form action="{{route('apply.coupon')}}" method="post">
                @csrf
                  <div class="form-group">
                      <label for="coupon"> Apply Another Coupon </label>
                      <input type="text" name="coupon" class="form-control" required=""
                      placeholder="Enter Your Coupon">
                  </div>
                <button class="btn btn-success" type="submit"> Apply Coupon</button>  
              </form>
              <h5 class="mt-4 text-center text-success"> Your Get               
                <span> {{Session::get('coupon')['couponPersent']}}% 
                </span>
                Discount 
              </h5>
          </div>
        @else
        <div class="coupon col-6 col-md-5 mx-auto pt-5 pb-5">
          <form action="{{route('apply.coupon')}}" method="post">
            @csrf
              <div class="form-group">
                  <label for="coupon"> Apply Coupon </label>
                  <input type="text" name="coupon" class="form-control" required=""
                  placeholder="Enter Your Coupon">
              </div>
            <button class="btn btn-success" type="submit"> Apply Coupon</button>  
          </form>
          <div class="couponPersent">
          </div>
        </div>
        {{-- coupon end --}}
        @endif   

        {{-- price calculation  biling--}}
        <div class="col-11 col-md-5 mx-auto">
          <ul class="list-group">
              <li class="list-group-item">
                SUBTOTAL: 
                @if (Session::has('coupon'))
                <span class="discount-price ml-2">
                  Tk {{Session::get('coupon')['finalAmount']}} 
                </span> 
                <del class="float-right  ml-3 text-danger">             
                  Tk {{Cart::Subtotal()}} 
                </del>
                
                @else
                <span class="float-right old-price ml-3">             
                  Tk {{Cart::Subtotal()}} 
                </span>
                @endif  
                
              </li>
              <li class="list-group-item"> Coupon :
                @if (Session::has('coupon'))
                ({{Session::get('coupon')['name']}}) 
                <a href="{{route('coupon.remove')}}" class="coupon-remove"> X </a>
                <span class="float-right">
                  Tk {{Session::get('coupon')['discount']}}
                </span>
                @else
                <span class="float-right"> 00.00 </span>
                @endif
            </li>
            <li class="list-group-item"> Shipping Charge: <span class="float-right">Tk {{$shippingCharge}} </span></li>
            <li class="list-group-item"> Vat: <span class="float-right"> Tk {{$vat}} </span></li>
            @if (Session::has('coupon'))
            <li class="list-group-item"> 
              Total :
              <span class="float-right  text-info"> 
                @php
                    $total = round(Session::get('coupon')['finalAmount'] + $vat+ $shippingCharge);
                @endphp
                TK {{$total}}
              </span> 
            </li>
            @else
            @php
            $totalWithoutDiscount = round(Cart::subtotal() + $vat + $shippingCharge);
            @endphp
            <li class="list-group-item"> Total: <span class="float-right text-info"> TK {{$totalWithoutDiscount}} </span> </li>
            @endif
            
          </ul>
        </div>
        {{-- price calculation and billing end --}}
      </div>
      <div class="d-flex justify-content-end checkout mt-5">
        <a href="{{route('cancle.cart')}}" class="btn btn-success mr-3"> Cnacle All </a>
        <a href="{{route('order.page')}}" class="btn btn-primary"> Final Step </a>
      </div>
  </div>
</section> 
@include('layouts.footer')
@endsection