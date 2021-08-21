@extends('layouts.header')
@section('content')
@include('layouts.navheader')
@include('layouts.navbar')
@include('layouts.sidebar')
<div class="wishlist-product">
  <div class="container">
    @if ($product == null)
    <h4 class="pt-5 text-center text-info mb-5">  Add Some product On WishList  </h4> 
    @else
    <h4 class="pt-5 text-center text-info mb-5"> Your Wishlist Product <span class="badge badge-pill badge-success">{{$total_wishlist->count()}}</span> </h4>
    @foreach ($product as $item)
    <table class="table table-bordered">
        <thead>
          <tr>

            <th scope="col" class="product"> Product </th>
            <th scope="col" class="name"> Name </th>
                  
            <th scope="col" class="action"> Action </th>
          </tr>
        </thead>
        <tbody>     
          <tr>
            <td scope="row" class="product"> 
              <a href="/products/{{$item->slug}}">
                <img src="{{ asset($item->main_img)}}" class="img-fluid" alt="product_main_img">
                <span class="text-center"> {{$item->product_code}}</span>
              </a>
            </td>
            <td> 
              <a href="/products/{{$item->slug}}">
                {{$item->product_name}}
              </a> 
            </td>
            <td> 
              <a href="/products/{{$item->slug}}" class="btn btn-primary"><i class="fas fa-shopping-cart"></i> </a>
              <a href="{{route('wishlist.delete',$item->product_id)}}" class="btn btn-primary"><i class="fas fa-trash-alt"></i> </a>
            </td>
          </tr> 
        </tbody>
    </table>
    @endforeach  
    <div class="paginate mb-4">
      {{ $product->links('layouts.paginationlinks') }}  
  </div>  

  @endif
      
   
  </div>
</div>

  @include('layouts.footer')
@endsection