@extends('layouts.admin.header')
@section('content')

<div class="container-fluid">
  <div class="col-md-12 mt-4">
    <div class="card">
      <div class="card-body">
        <!-- title -->
        <div class="d-md-flex align-items-center">
          <div>
              <h4 class="card-title"> All Products </h4>
              <h5 class="card-subtitle"> Overview new Product </h5>
          </div>
        </div>
        <!-- title -->
      </div>
      <div class="table-responsive">
        <table class="table v-middle">
          <thead>
            <tr class="bg-light">
              <th class="border-top-0"> Images </th>
              <th class="border-top-0"> Product Name</th>
              <th class="border-top-0"> Category </th>
              <th class="border-top-0"> Brand </th>
              <th class="border-top-0"> Quantity </th>
              <th class="border-top-0"> Status </th>
              <th class="border-top-0"> Seller Name </th>
              <th class="border-top-0"> Action </th>
            </tr>
          </thead>
          <tbody>
            @foreach ($products as  $product)                    
            <tr>   
              <td>
                <div class="d-flex align-items-center">
                  <div class="m-r-10">
                    <a href="/products/{{$product->slug}}">
                      <img src="{{asset($product->main_img)}}" style="display: block; object-fit:cover; width:50px; height:50px; border-radius: 50%; border:2px solid #ff5c23;">
                    </a>
                  </div>
                  <div class="">
                    <h4 class="m-b-0 font-16">{{$product->product_code}}</h4>
                  </div>
                </div>
              </td>  
              </td>
              <td>{{$product->product_name}}</td>
              <td>{{$product->name}}</td>
              <td>{{$product->brand_name}}</td>
              <td>
                @if ($product->product_quantity == 0)
                  <span class="badge badge-pill badge-danger"> Update Qty  </span> 
                @else
                    
                @endif
                {{$product->product_quantity}}
              </td>

              <td> 
                @if( Auth::user()->role_id == 1)
                <a href="/admin/product/{{$product->id}}/approve"
                  class="badge {{($product->status==1) ?'badge-danger': 'badge-success'}}">
                  {{($product->status == 1) ? 'Unapprove': 'Approve'}}                      
                </a> 
                @else
                  @if ($product->status ==1)
                      <span class="badge badge-pill badge-success">Active</span>
                  @else
                      <span class="badge badge-pill badge-danger"> Unactive </span>
                  @endif
                @endif
              </td>
              <td> <a href="{{route('user.products',$product->seller_id)}}" class="nav-link"> {{$product->username}} </a></td>
              <td>
                <a href="/admin/product/edit/{{$product->slug}}/{{$product->id}}" class="btn btn-info"> <i class="fas fa-edit"></i></a>
                <a href="{{ route('product.view',$product->id)}}" class="btn btn-info"> <i class="fas fa-eye"></i></a>
                <a href="/admin/product/delete/{{$product->slug}}/{{$product->id}}" class="btn btn-danger" id='delete'> <i class="fas fa-trash"></i></a>
              </td>
            </tr>        
            @endforeach
          </tbody>
        </table>

        <div class="col-8 mx-auto">
          <a href="{{route('product.create')}}" class="btn btn-primary text-uppercase w-100 border mt-5 mb-3">
            Add New Product
          </a> 
        </div>
      
        </div> 
        <div class="paginate mb-4 d-flex justify-content-center">
          {{$products->links('layouts.paginationlinks')}}  
        </div>     
      </div>
    </div>
  </div>    
</div>
@endsection
