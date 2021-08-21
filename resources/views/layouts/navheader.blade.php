       
<div class="fontainer-fluid main-nav ">
    <div class="container-fluid">
        <nav class="navbar navbar-expand">
            <div class="contact-email">
                <a class="ml-1" href="tel:+088{{$setting->phone}}"> <i class="fas fa-phone-volume mr-2">  </i>  {{$setting->phone}}</a>
                <a class="ml-1" href="mailto:{{$setting->email}}"> <i class="fas fa-envelope-open-text"> </i> {{$setting->email}} </a>
            </div>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item cart">
                    <a href="{{ url('/cart/show') }}" class="nav-link cart-nav"><i class="fas fa-shopping-cart cart-icon"></i><span class="cart-amount float-right"> ৳ {{Cart::priceTotal()}}</span>  <span class="cart-item"> {{Cart::count()}} </span>  </a>
                </li>
                @if (Route::has('login'))
                    @auth
                        @php

                            $wishlist = DB::table('wishlists')->where('user_id',Auth::id())->get();
                        @endphp
                          
                            <li class="nav-item">
                                <a href="{{ route('wishlist') }}" class="nav-link"><i class="fas fa-heart cart-icon"></i> <span class="cart-item cart-items">{{count($wishlist)}}</span>  </a>
                            </li>
                            <li class="nav-item profile">
                                @if (Auth::user()->role_id = 1)
                                <a href="{{ route('admin.dashboard') }}" class="nav-link"></i> <span class="profile"> My profile</span>  </a>
                                @elseif(Auth::user()->role_id = 2)
                                <a href="{{route('staff.dashboard') }}" class="nav-link"></i> <span class="profile"> My profile</span>  </a>
                                @else
                                <a href="{{ url('/home') }}" class="nav-link"></i> <span class="profile"> My profile</span>  </a>
                                @endif
                            </li> 
                       
                        
                    @else
                        <li class="nav-item login">
                            <a href="{{ route('login') }}" class="nav-link"> <span> Log in </span> </a>
                        </li>

                        @if (Route::has('register'))
                            <li class="nav-item register">
                                <a href="{{ route('register') }}" class="nav-link"> <span>Register</span> </a>
                            </li>
                        @endif

                    @endauth
                @endif

            </ul>

        </nav>
    </div>
</div>

