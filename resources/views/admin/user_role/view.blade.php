@extends('layouts.admin.header')
@section('content')
<div class="user-view">
    <div class="container">
        <div class="card ">
            <div class="card-header border">
                {{$user->name}} Infomation
                <span class="d-flex justify-content-end">
                    Created Account   
                    {{ \Carbon\Carbon::parse($user->created_at)->diffForHumans() }}
                </span>
            </div>
            <div class="card-body">
                <div class="user-info">
                    <div class="images mb-3">
                        @if ($user->profile_img)
                            <img src="{{asset($user->profile_img)}}"  class="img-fluid" style="width:130px;heignt:130px; border-radius:50%;">
                        @else
                        <i class="fas fa-user fa-3x img pt-1 pl-2" ></i>  
                        @endif
                    </div>
                
                    <h6 class="text-info text-capitalize"> Name: <span class="text-success"> {{$user->name}}</span> </h6>  
                    @if ($user->role_id == 1)
                    <h6 class="text-info text-capitalize"> User Type: <span class="text-success"> Admin</span> </h6> 
                    @elseif ($user->role_id == 2)
                    <h6 class="text-info text-capitalize"> User Type: <span class="text-success"> Seller </span> </h6> 
                    @else
                    <h6 class="text-info text-capitalize"> User Type: <span class="text-success"> User</span> </h6>  
                    @endif
                    <h6 class="text-info text-capitalize"> User Name: <span class="text-success"> {{$user->username}}</span> </h6> 
                    <h6 class="text-info text-capitalize"> Email: <span class="text-success"> {{$user->email}}</span> </h6>
                    @if ($user->email_verified_at == null)
                    <h6 class="text-info text-capitalize"> Verifi Email: <span class="text-success"> Not Verified</span> </h6> 
                    @else
                    <h6 class="text-info text-capitalize"> Verifi Email: <span class="text-success"> True</span> </h6>  
                    <h6 class="text-info text-capitalize"> Phone: <span class="text-success"> {{$user->phone}} </span>  </h6> 
                    @endif 
                    @if (!$totalProduct->count() == 0 && !$userOrder->count() == 0)
                        <h5 class="mt-3 mb-3"> Admin Basic Infomation </h5>
                        <h6 class="text-info text-capitalize"> Total Product: <span class="text-success"> {{$totalProduct->count()}} </span>  </h6>
                        <h6 class="text-info text-capitalize"> Last Product Create: <span class="text-success"> {{$lastProductCreate}} </span>  </h6>   
                        <a href="{{route('user.products',$user->id)}}" class="btn btn-info"> See All Product </a> 

                        <h5 class="mt-3 mb-3"> User Order Infomation </h5>
                        <h6 class="text-info text-capitalize"> Last Order: <span class="text-success"> {{$userLastOrder}} </span>  </h6>
                        <h6 class="text-info text-capitalize"> Total Order: <span class="text-success"> {{$userOrder->count()}} </span>  </h6>  
                        <h6 class="text-info text-capitalize"> Total Amount: <span class="text-success"> {{$totalAmount}} </span>  </h6> 
                        <a href="{{route('user.orders',$user->id)}}" class="btn btn-info"> See All User Orders </a> 
                    @elseif(!$totalProduct->count() == 0)

                        <h5 class="mt-3 mb-3"> Admin Basic Infomation </h5>
                        <h6 class="text-info text-capitalize"> Total Product: <span class="text-success"> {{$totalProduct->count()}} </span>  </h6>
                        <h6 class="text-info text-capitalize"> Last Product Create: <span class="text-success"> {{$lastProductCreate}} </span>  </h6>   
                        <a href="{{route('user.products',$user->id)}}" class="btn btn-info"> See All Product </a> 
                       
                              
                    @elseif(!$userOrder->count() == 0)
                        <h5 class="mt-3 mb-3"> User Order Infomation </h5>
                        <h5 class="mt-3 mb-3"> User Order Infomation </h5>
                        <h6 class="text-info text-capitalize"> Last Order: <span class="text-success"> {{$userLastOrder}} </span>  </h6>
                        <h6 class="text-info text-capitalize"> Total Order: <span class="text-success"> {{$userOrder->count()}} </span>  </h6>  
                        <h6 class="text-info text-capitalize"> Total Amount: <span class="text-success"> {{$totalAmount}} </span>  </h6>

                    @else
                     <h4 class="mb-3 mt-3 text-capitalize text-primary"> New User </h4>
                    @endif
           
                    <div class="action p-5">
                        <div class="btn-group">
                            <a href="{{route('user',$user->id)}}" class="btn btn-info"> Make User </a>
                            <a href="{{route('seller',$user->id)}}" class="btn btn-success"> Make Seller </a>
                            <a href="{{route('admin',$user->id)}}" class="btn btn-danger"> Make Admin </a>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection