@extends('layouts.header')
@include('layouts.navheader')
@include('layouts.navbar')


@section('content')
<div class="container mt-3">
    
    <h5 class="text-center py-1  text-dark text-uppercase"> Order Details 

        @if($order->status == 0)

            <span class="badge badge-warning ml-5 rounded-pill">Panding</span>

        @elseif($order->status == 1)
        <span class="badge badge-primary">Accept Order</span> 
        @elseif($order->status == 2)
        <span class="badge badge-info"> Process </span> 
        @elseif($order->status == 3)
        <span class="badge badge-success"> Delivered </span> 
        @elseif($order->status == 4)
        <span class="badge badge-danger"> Cnacle </span>
        @endif

    </h5>
    <div class="progress">
        @if($order->status == 0)
        <div class="progress-bar bg-danger" role="progressbar" style="width:15%"></div>
        @elseif($order->status == 1)
        <div class="progress-bar bg-danger" role="progressbar" style="width:15%"></div>
        <div class="progress-bar bg-primary" role="progressbar" style="width:20%"></div>
        @elseif($order->status == 2)
        <div class="progress-bar bg-danger" role="progressbar" style="width:15%"></div>
        <div class="progress-bar bg-primary" role="progressbar" style="width:20%"></div>
        <div class="progress-bar bg-info" role="progressbar" style="width:30%"></div>
        @elseif($order->status == 3)
        <div class="progress-bar bg-danger" role="progressbar" style="width:15%"></div>
        <div class="progress-bar bg-primary" role="progressbar" style="width:20%"></div>
        <div class="progress-bar bg-info" role="progressbar" style="width:30%"></div>
        <div class="progress-bar bg-success" role="progressbar" style="width:35%"></div> 
        @elseif($order->status == 4)
        <div class="progress-bar bg-danger" role="progressbar" style="width:100%"></div>
        @endif
       
      
    </div>
           
    <div class="row">
        <dov class="col-sm-12 col-md-6">
            <table class="table table-bordered">
                <thead>       
                    <tr>
                        <th>  Code  </th>
                        <th>  Name  </th>
                        <th>  Img   </th>                          
                       
                    </tr>
                </thead>
                <tbody>
                    @foreach($details as $row)
                    <tr>
                        <td>{{ $row->product_code }}</td>
                        <td>{{ $row->product_name }}</td>
        
                        <td> <img src="{{ asset($row->main_img) }}" height="50px;" width="50px;"> </td>                            
                     
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </dov>
        <dov class="col-sm-12 col-md-6">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>  Color </th>     
                        <th>  Size  </th>                         
                        <th>  Qty   </th>
                        <th>  Price  </th>
                        <th>  SubTotal </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($details  as $row)
                    @if (!$row->color)
                    <td></td> 
                    @else
                    <td> {{$row->color}}</td> 
                    @endif
                    @if (!$row->size)
                    <td></td> 
                    @else
                    <td> {{$row->size}}</td> 
                    @endif                
                    <td>{{ $row->quantity }}</td>
                    <td> ৳ {{ $row->singleprice }}</td>
                    <td> ৳ {{ $row->totalprice }}</td>
                    @endforeach
                </tbody>
            </table>
        </dov>
    </div>
      
    <div class="cancle">
        @if ($order->status == 4)
            <p class="text-center text-danger">
                The Pament is not valid contact   <span class="text-info">{{$setting->phone}}, or {{$setting->email}} </span> After
                1 month the order will be delete.
            </p> 
        @endif
    </div>
            
  
    
    <div class="card p-3 mt-5">
        
        
        <div class="card-body col-md-12">
            <div class="row bg-white">
                {{-- left side div // payment amount --}}
                <div class="col-md-6 ">
                    <h3 class="text-center text-info pb-2 mt-5 "> Payment Detail </h3>
                    <table class="table table-bordered">
                        <tr>
                            <th> Name: </th>
                            <th> {{ $order->name }} </th>		
                        </tr>
    
                        <tr>
                            <th> Email: </th>
                            <th> {{ $order->email }} </th>		
                        </tr>
                        @if($order->coupon_name)
                        <tr>
                            <th> Coupon Name : </th>
                            <th> {{ $order->coupon_name }} </th>		
                        </tr>
                        <tr>
                            <th> Coupont Discount: </th>
                            <th> {{ $order->discount }} ৳ </th>		
                        </tr>
                        @endif
                        <tr>
                            <th> Total : </th>
                            <th> {{ $order->subtotal }} ৳ </th>		
                        </tr>
    
                        <tr>
                            <th> Month: </th>
                            <th> {{ $order->month }} </th>		
                        </tr>
    
                        <tr>
                            <th> Date: </th>
                            <th> {{ $order->date }} </th>		
                        </tr> 
                        <tr>
                            <th> Time: </th>
                            <th> {{ $order->created_at->diffForHumans()}}</th>
                        </tr>
                    </table>
                </div>

                  
                <div class="col-md-6 mt-5">
                    {{-- right side div //shipping detali --}}
                    <h3 class="text-center pb-2 text-info"> Shipping Address</h3>
                    <table class="table table-bordered">
                        <tr>
                            <th> first Name: </th>
                            <th> {{ $shipping->fname }} </th>		
                        </tr>
                        <tr>
                            <th> Last Name: </th>
                            <th> {{ $shipping->lname }} </th>		
                        </tr>
                        <tr>
                            <th> Phone: </th>
                            <th> {{ $shipping->phone }} </th>		
                        </tr>
    
                        <tr>
                            <th> Email: </th>
                            <th> {{ $shipping->email }} </th>		
                        </tr>
                        <tr>
                            <th> bksah or nagad number: </th>
                            <th> {{ $shipping->bkash_number }} </th>		
                        </tr>
                        <tr>
                            <th> Street Address: </th>
                            <th> {{ $shipping->street_address }} </th>		
                        </tr>
    
                        <tr>
                            <th> Town: </th>
                            <th> {{ $shipping->town }} </th>		
                        </tr>
    
                        <tr>
                            <th> District: </th>
                            <th> {{ $shipping->district }} </th>		
                        </tr> 
                    </table>
                </div>

            </div>
        </div>
    
    </div>  
  
</div>


 
@include('layouts.footer')


 @endsection