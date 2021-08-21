{{-- Nvabar Start --}}
<div class="header_nav">
  <div class="container-fluid">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="{{route('welcome.page')}}">{{$setting->name}}</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item ">
            <a class="nav-link {{Request::is('/') ? 'active': ''}}" href="{{route('welcome.page')}}">Home</a>
          </li>
         
          <li class="nav-item">
            <a class="nav-link {{Request::is('contact') ? 'active': ''}}" href="{{route('contact')}}"> Contact</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Category
            </a>           
            <ul class="dropdown-menu col-5 mx-auto">
              @foreach ($category as $cat)
                <li class="dropdown-sub">         
                    <a href="/category/products/{{$cat->id}}/{{$cat->name}}/" class="dropdown-item" target='_self'> 
                      {{$cat->name}}  
                    </a>                   
                      <ul class="dropdown-submenu">
                        @php
                        $subcategory = DB::table('sub_categories')->where('category_id',$cat->id)->get();
                        @endphp
                        @foreach ($subcategory as $subcat)
                          <li class="nav-item">
                              <a class="dropdown-item sub-link" href="/subcat/products/{{$subcat->id}}/{{$subcat->category_name}}/" target='_self'>
                                {{$subcat->category_name}}
                              </a>
                          </li>
                        @endforeach
                      </ul>
                </li>
                @endforeach
            </ul>
          </li>
          <li class="nav-item ">
            <a class="nav-link {{Request::is('shop.page') ? 'active' : ''}}" href="{{route('shop.page')}}"> Shop </a>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0" action="{{route('auto.input')}}" method="GET">
          @csrf
          <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search" name='product_search' id="search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </nav> 
  </div>
</div>


{{-- Nvabar End --}}