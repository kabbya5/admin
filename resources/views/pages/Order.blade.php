@extends('layouts.header')
@section('content')
    @include('layouts.navheader')
    @include('layouts.navbar');
    <div class="payment-page">
        <div class="container-fluid">
            <div class="usercart">   
                <div class="row">
                    <!-- left side div -->
                    <div class="col-md-6 col-11 mb-5">
                     {{-- price calculation  biling--}}
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
                      
                        {{-- price calculation and billing end --}}
                    </div>
                    <!-- end left side div -->
                    <!-- right side div -->
                    <div class="cart-table col-11 col-md-6">
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
                                    </div>         
                                  </th>
                                  <td class="qty">
                                    {{$item->qty}}  
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
                    <div class="pament-message pt-5">
                        <div class="row">
                            <div class="col-12 col-md-6 mb-5">
                                <div class="card">
                                    <div class="card-header">
                                        Personal Number 
                                    </div>
                                    <div class="card-body">
                                        <div class="payment-number pb-3 text-center">

                                            @if ($payment_setting->pnumber_two)
                                            <span class="text-success ml-2"> {{$payment_setting->pnumber_one}}</span>
                                            <span class="text-success ml-3"> {{$payment_setting->pnumber_two}}</span>
                                            @else
                                            <span class="text-right"> {{$payment_setting->pnumber_one}}</span> 
                                            @endif
                                        </div>
                                
                                        <p class="card-text p-2">
                                            {{$payment_setting->pnumber_text}}
                                        </p>
                                        <a href="{{$setting->facebook_url}}" class="btn btn-primary"> FaceBook </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 mb-5">
                                <div class="card">
                                    <div class="card-header">
                                        Agent  Number 
                                    </div>
                                    <div class="card-body">
                                        <div class="payment-number pb-3 text-center">
                                            <span class="text-right"> {{$payment_setting->anumber}}</span> 
                                        </div>
                                
                                        <p class="card-text p-2">
                                            {{$payment_setting->anumber_text}}
                                        </p>
                                        <a href="{{$setting->facebook_url}}" class="btn btn-primary"> FaceBook </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end right side div -->

                    {{--         Shipping address right side div      --}}
                    @if ($shipping)
                    <div class="col-md-12 col-lg-6 mx-auto mb-5">
                        <h4 class="text-center text-success text"> Shipping and Bluing Adderss </h4>
                        <form action="{{route('order.create')}}" method="post">
                        @csrf
                            <div class="form-group">
                                <label for="fname">First Name <span class="required"> :*</span> </label>
                                <input type="text" class="form-control @error('fname') is-invalid @enderror" name="fname" value="{{$shipping->fname}}">

                                @error('fname')
                                    <div class="alert alert-danger">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="lname">Last Name <span class="required"> :*</span> </label>
                                <input type="text" class="form-control @error('lname') is-invalid @enderror" name="lname" value="{{$shipping->lname}}">

                                @error('lname')
                                    <div class="alert alert-danger">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="phone"> Phone Number <span class="required"> :*</span> </label>
                                <input type="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{$shipping->phone}}">

                                @error('phone')
                                    <div class="alert alert-danger">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email"> Email <span class="required"> :*</span> </label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$shipping->email}}">

                                @error('email')
                                    <div class="alert alert-danger">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="bkash_number"> Bkash Number <span class="required"> :*</span> </label>
                                <input type="phone" class="form-control @error('bkash_number') is-invalid @enderror" name="bkash_number" value="{{$shipping->bkash_number}}">

                                @error('bkash_number')
                                    <div class="alert alert-danger">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="street_address"> Street Address </label>
                                <input type="text" class="form-control @error('street_address') is-invalid @enderror" name="street_address" value="{{$shipping->street_address}}">

                                @error('street_address')
                                    <div class="alert alert-danger">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="town">Town/ City<span class="required"> :*</span> </label>
                                <select name="town" class="form-control">

                                    <option value="dhaka" {{$shipping->town == 'dhaka' ? 'selected' : ''}}> Dhaka</option>
                                    <option value="chittagong" {{$shipping->town == 'chittagong' ? 'selected' : ''}}> CHittagong</option>
                                    <option value="sylhet" {{$shipping->town === 'sylhet'? 'selected' : ''}} > Sylhet </option>
                                    <option value="rajshahi" {{$shipping->town == ' rajshahi'? 'selected' : ''}} > Rajshahi </option>
                                    <option value="barisal" {{$shipping->town == 'barisal' ? 'selected' : ''}}> Barisal </option>
                                    <option value="comilla"  {{$shipping->town == 'comilla'? 'selected' : ''}}> Commlla </option>
                                    <option value="narayanganj" {{$shipping->town == 'narayanganj'? 'selected' : ''}} > Narayanganj </option>
                                    <option value="gazipur" {{$shipping->town == ' gazipur' ? 'selected' : ''}}> Gazipur </option>

                                </select>
                                
                                @error('town')
                                    <div class="alert alert-danger">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="district"> District <span class="required"> :*</span> </label>
                                <input type="text" class="form-control @error('district') is-invalid @enderror" name="district" value="{{$shipping->district}}">

                                @error('district')
                                    <div class="alert alert-danger">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary w-100 text-center text-uppercase"> Submit</button>
                        </form>
                    </div>  
                    @else
                    <div class="col-md-12 col-lg-6 mx-auto mb-5">
                        <h4 class="text-center text-success text pb-3"> Shipping and Bluing Adderss </h4>
                        <form action="{{route('order.create')}}" method="post">
                        @csrf
                            <div class="form-group">
                                <label for="fname">First Name <span class="required"> :*</span> </label>
                                <input type="text" class="form-control @error('fname') is-invalid @enderror" name="fname" value="{{old('fname')}}">

                                @error('fname')
                                    <div class="alert alert-danger">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="lname">Last Name <span class="required"> :*</span> </label>
                                <input type="text" class="form-control @error('lname') is-invalid @enderror" name="lname" value="{{old('lname')}}">

                                @error('lname')
                                    <div class="alert alert-danger">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="phone"> Phone Number <span class="required"> :*</span> </label>
                                <input type="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{old('phone')}}">

                                @error('phone')
                                    <div class="alert alert-danger">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email"> Email <span class="required"> :*</span> </label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{old('email')}}">

                                @error('email')
                                    <div class="alert alert-danger">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="bkash_number">You Pement Number  <span class="required"> :*</span> </label>
                                <input type="phone" class="form-control @error('bkash_number') is-invalid @enderror" name="bkash_number" value="{{old('bkash_number')}}">

                                @error('bkash_number')
                                    <div class="alert alert-danger">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="street_address"> Street Address </label>
                                <input type="text" class="form-control @error('street_address') is-invalid @enderror" name="street_address" value="{{old('street_address')}}">

                                @error('street_address')
                                    <div class="alert alert-danger">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="town">Town/ City<span class="required"> :*</span> </label>
                                <select name="town" class="form-control">
                                    <option value="dhaka"> Dhaka </option>
                                    <option value="chittagong"> CHittagong</option>
                                    <option value="sylhet"> Sylhet </option>
                                    <option value="rajshahi"> Rajshahi </option>
                                    <option value="mymensingh"> Mymensingh</option>
                                    <option value="barisal"> Barisal </option>
                                    <option value="comilla"> Commlla </option>
                                    <option value="narayanganj"> Narayanganj </option>
                                    <option value="gazipur"> Gazipur </option>
                                </select>
                                
                                @error('town')
                                    <div class="alert alert-danger">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="district"> District <span class="required"> :*</span> </label>
                                <input type="text" class="form-control @error('district') is-invalid @enderror" name="district" value="{{old('district')}}">

                                @error('district')
                                    <div class="alert alert-danger">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary w-100 text-center text-uppercase"> Submit</button>
                        </form>
                    </div>  
                    @endif
                    

                    {{-- Shipping address right side div     --}}


                </div>
            </div>
        </div>
    </div>
    
@include('layouts.footer')
@endsection

