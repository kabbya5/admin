<footer class="page-footer bg-dark">
    <div class="bg-info">
      <div class="container">
        <div class="row py-4 d-flex align-items-center">
          <div class="col-md-12 text-center image">
            <img src="{{asset($setting->logo)}}" alt="">
          </div>
        </div>
      </div>
    </div>
  
    <div class="container text-center text-md-left mt-5">
      <div class="row bg-dark">
        <div class="col-md-4 col-lg-3 mx-auto mb-4">
          <h6 class="text-uppercase text-white font-weight-bold"> Contract Info </h6>
          <hr class="bg-success mb-4 mt-0 d-inline-block mx-auto" style="width: 120px; height: 2px">
          <ul class="list-unstyled text-white">
            <li class="my-2"> <i class="fas fa-home mr-2"></i> 
              @foreach ($addresses as $address)
              <spam class="text-capitalize"> {{$address}},</spam> <br>
              @endforeach
            </li>
            <li class="my-2"> <i class="fas fa-envelope mr-2"></i> {{$setting->email}}</li>
            <li class="my-2"> <i class="fas fa-phone mr-2"> </i> {{$setting->phone}} </li>
            @if ($setting->phone2)
            <li class="my-2"> <i class="fas fa-phone mr-2"> </i> {{$setting->phone2}} </li>
            @endif
            
  
          </ul>
        </div>
        <div class="col-md-4 col-lg-3 mx-auto mb-4">
          <h6 class="text-uppercase text-white  font-weight-bold"> Pages </h6>
          <hr class="bg-success mb-4 mt-0 d-inline-block mx-auto" style="width: 75px; height: 2px">
          <ul class="list-unstyled">
            <li class="my-2"> <a href="{{route('welcome.page')}}" class="text-white"> Home </a></li>
            <li class="my-2"> <a href="{{route('shop.page')}}" class="text-white"> Shop </a></li>
            <li class="my-2"> <a href="{{route('contact')}}" class="text-white"> Contact </a></li>
            <li class="my-2"> <a href="{{route('register')}}" class="text-white"> Sign Up  </a></li>
            <li class="my-2"> <a href="{{route('login')}}" class="text-white"> Log In  </a></li>
          </ul>
        </div>
        <div class="col-md-4 col-lg-3 mx-auto mb-4">
          <h6 class="text-uppercase text-white font-weight-bold"> User Section </h6>
          <hr class="bg-success mb-4 mt-0 d-inline-block mx-auto" style="width: 120px; height: 2px">
          <ul class="list-unstyled">
            <li class="my-2"> <a href="{{ url('/home') }}" class="text-white"> Profile </a></li>
            <li class="my-2"> <a href="{{route('cart')}}" class="text-white"> Shoppin Cart  </a></li>
            <li class="my-2"> <a href="{{route('wishlist')}}" class="text-white"> Wish list </a></li>
          </ul>
        </div>
        <div class="col-md-4 col-lg-3 mx-auto mb-4" style="display: none" >
            <h6 class="text-uppercase text-white font-weight-bold"> Newsletter </h6>
            <hr class="bg-success mb-4 mt-0 d-inline-block mx-auto" style="width: 120px; height: 2px">
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="text" placeholder="Enter Your Email " name="subcribe">
                <button class="btn btn-outline-success mt-3 btn-sm" type="submit">Subcribe</button>
                <a href="{{$setting->facebook_url}}" class="mt-3 ml-2 text-white">
                  <i class="fab fa-facebook fa-4x"></i>
                </a>
            </form>       
          </div>
      </div>
    </div>
  </footer>