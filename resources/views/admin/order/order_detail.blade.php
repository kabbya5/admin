@extends('layouts.admin.header')

@section('content')
<div class="container my-3">
    
    <div class="card">
        <div class="card-header">
           
            <h4 class="text-center text-center bg-success py-2  text-white text-uppercase"> Product Details 
                @if($order->status == 0)
                <h3 class="float-right"> 
                    <span class="badge badge-warning">Panding</span>
                </h3>
                @elseif($order->status == 1)
                <h3 class="text-right"> <span class="badge badge-primary">Accept Order</span> </h3>
                @elseif($order->status == 2)
                <h3 class="text-right"><span class="badge badge-info"> Process </span>  </h3>
                @elseif($order->status == 3)
                <h3 class="text-right"> <span class="badge badge-success"> Delivered </span> </h3>
                @elseif($order->status == 4)
                <h3 class="text-right"> <span class="badge badge-danger"> Cnacle </span></h3>
                @endif
            </h4>
                      
        </div>
        <div class="col-sm-11 mx-auto p-3">
            <table class="table table-bordered">
                   
                <thead>       
                    <tr>
                        <th>  Code  </th>
                        <th>  Name  </th>
                        <th>  Img   </th>                          
                        <th>  Color </th>     
                        <th>  Size  </th>                         
                        <th>  Qut   </th>
                        <th>  Price  </th>
                        <th>  SubTotal </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($details as $row)
                    <tr>
                        <td>{{ $row->product_code }}</td>
                        <td>{{ $row->product_name }}</td>
        
                        <td> <img src="{{ asset($row->main_img) }}" height="50px;" width="50px;"> </td>                            
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
                    </tr>
                    @endforeach
                    
                </tbody>
                    
            </table>
        </div>
            
        <div class="d-flex flex-row-reverse ">
            @if($order->status == 0)
            <a href="{{ url('admin/accept/order/'.$order->id) }}" class="btn btn-info text-center">Order Accept </a> 
            <a href="{{ url('admin/cancel/order/'.$order->id) }}" class="btn btn-danger">Order Cancel </a>
            @elseif($order->status == 1)
            <a href="{{ url('admin/delevery/process/'.$order->id) }}" class="btn btn-info">Process Delevery </a>
            @elseif($order->status == 2)
            <a href="{{ url('admin/delevery/done/'.$order->id) }}" class="btn btn-success">Delevery Done </a>
            @elseif($order->status == 4)
            <strong class="text-danger text-center"> This order are not valid  </strong>
            @else
            <strong class="text-success text-center p-4">This product are successfuly Deleverd  </strong>
            @endif
        </div> 
       
    </div>
    
    <div class="card p-2">
        <div class="card-body ">
            <div class="row bg-white">
                {{-- left side div // payment amount --}}
                <div class="col-sm-6">
                    <h3> Payment Detail </h3>
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

                  
                <div class="col-sm-6">
                    {{-- right side div //shipping detali --}}
                    <h3> Shipping Address</h3>
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


 



 @endsection