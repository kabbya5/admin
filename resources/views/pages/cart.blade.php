@extends('layouts.header')
@section('content')
    @include('layouts.navbar')
    {{-- cart section start --}}
    <section class="usercart mb-5">
      <div class="container">
        <h4 class="p-3 mt-4 text-center text-uppercase text-success"> Shoping Cart</h4>
        <div class="cart-table">
          {{-- shiping cart table --}}
          
          <table class="table table-bordered">                     
            <thead>
              <tr>
                <th scope="col"> Product </th>
                <th scope="col"> Quantity </th>
                <th scope="col"> Price  </th>
                <th scope="col"> Total  </th>
              </tr>
            </thead>
            <tbody>
            
              @foreach ($contents as $item)              
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
          
        {{-- total price --}}
        <div class="total-price border border-primary">
          <h4 class="tatal-price float-right text-success"> SubTatal: <span> TK {{Cart::priceTotal()}}</span></h4>
        </div>
        <div class="d-flex justify-content-end checkout mt-5">
          <a href="{{route('cancle.cart')}}" class="btn btn-danger mr-3"> Cnacle All </a>
          <a href="{{route('user.checkout')}}" class="btn btn-primary"> Checkout </a>
        </div>
      </div>
      {{-- @else
      <div class="cart-message">
        <h6 class="text-center text-dark"> Your Cart is empty | Plece Update Your Cart </h6>       <span class="text-center text-info"> </span>
      </div>
      @endif --}}
    </section>
    

    @include('layouts.footer')
@endsection