<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title> {{$setting->name}}</title>
    <link rel="icon" href="{{asset($setting->logo)}}" type="image/x-icon"></link>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script> 
    @yield('link')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <!-- Styles -->
    
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        
       
    {{-- Toastr  --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js" integrity="sha512-7VTiy9AhpazBeKQAlhaLRUk+kAMAb8oczljuyJHPsVPWox/QIXDFOnT9DUk1UC8EbnHKRdQowT7sOBe7LAjajQ==" crossorigin="anonymous"></script>
    @yield('title')
    
   
    @yield('style')
       <style>
        /*---------------------------------
        main-table
        ----------------------*/
        
        
        .m-r-10 {
            margin-right: 10px;
        }
    
        
        .btn-info {
            color: #fff;
            background-color: #2962FF;
            border-color: #2962FF;
        }
        
        .btn-orange {
            color: #212529;
            background-color: #fb8c00;
            border-color: #fb8c00;
        }
        
        .btn-success {
            color: #fff;
            background-color: #36bea6;
            border-color: #36bea6;
        }
        .btn-purple {
            color: #fff;
            background-color: #7460ee;
            border-color: #7460ee;
        }
        
        .card .card-title {
            position: relative;
            font-weight: 600;
            margin-bottom: 10px;
        }
        
        
        .card .card-subtitle {
            font-weight: 300;
            margin-bottom: 10px;
            color: #a1aab2;
              margin-top: -0.375rem;
        }
        
        
        .table td, .table th {
            padding: 1rem;
            font-size:14px;
            color:#333;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }
        
        .table h5{
              font-size: 16px;
              font-weight:600;
              color:#585858;
        }
        
        
        
        /*---------------------------------
        main-table
        ----------------------*/
        
        
        
        
        /*---------------------------------
         footer
        ----------------------*/
        
        footer.footer {
            padding: 1rem .875rem;
            direction: ltr;
            background: #fff;
        }
        
        footer.footer ul {
            margin:0px;
            list-style:none;
        }
        
        .footer ul  li{
         display:inline-block;
         margin:0px 7px;
        }
        
        .text-muted {
            color: #6c757d!important;
            font-size:14px;
        }
         
        
        /*---------------------------------
        footer
        ----------------------*/  
    </style>
</head>
<body class="antialiased">
    <div id="wrapper">
        <div class="overlay">

        </div> 
        <!-- Sidebar -->
        <nav class="fixed-top align-top" id="sidebar-wrapper" role="navigation">
            <div class="simplebar-content" style="padding: 0px;">
                <a class="sidebar-brand" href="{{route('admin.dashboard')}}">
                    <span class="align-middle">{{Str::limit(Auth::user()->username,10)}}</span>
                </a>
     
                <ul class="navbar-nav align-self-stretch">
                    <li class=""> 
                        <a class="nav-link text-left active"  href="{{route('staff.dashboard')}}"
                            <i class="flaticon-bar-chart-1"></i>  Dashboard 
                        </a>
                    </li>

                    {{--    Product   --}}

                    <li class="has-sub"> 
                        <a class="nav-link collapsed text-left togoler">
                            <i class="flaticon-user"></i>  Product
                        </a>
                        <div class="collapse menu mega-dropdown togoler-item ">                            
                            <div class="dropmenu">
                                <div class="container-fluid">
                                    <div class="row" style="background: #222e3c">
                                        <div class="col-lg-12 px-2">
                                            <div class="submenu-box"> 
                                                <ul class="list-unstyled m-0">
                                                    <li><a href="{{route('product.create')}}" class="nav-link"> Add Product  </a> </li>
                                                    <li> <a href="{{route('product.auth')}}" class="nav-link"> My Products  </a> </li>
                                                    <li> <a href="{{route('all.products')}}" class="nav-link"> All Product  </a> </li>
                                                </ul>
                                            </div>
                                        </div>
                                     
                                    </div>
                                </div>
                            </div>
                        </div>                              
                    </li>

                     {{--       End Product        --}}


                    {{-- Category and Brand --}}

                    <li class="has-sub"> 
                        <a class="nav-link collapsed text-left togoler">
                            <i class="flaticon-user"></i>   Category 
                        </a>
                        <div class="collapse menu mega-dropdown togoler-item">
                            <div class="dropmenu">
                                <div class="container-fluid ">
                                    <div class="row" style="background: #222e3c">
                                        <div class="col-lg-12 px-2">
                                            <div class="submenu-box"> 
                                                <ul class="list-unstyled m-0">
                                                    <li> <a href="{{route('categories')}}" class="nav-link"> Catgory  </a> </li>
                                                    <li><a href="{{route('brands')}}" class="nav-link"> Brand  </a> </li>
                                                    <li> <a href="{{route('sub_categories')}}" class="nav-link"> SubCat</a> </li>
                                                    <li> <a href="{{route('coupons')}}" class="nav-link"> Coupon</a> </li>
                                                </ul>
                                            </div>
                                        </div>
                                     
                                    </div>
                                </div>
                            </div>
                        </div>                              
                    </li>
                    {{-- Order  --}}
                    <li class="has-sub"> 
                        <a class="nav-link collapsed text-left togoler">
                            <i class="flaticon-user"></i>   Order 
                        </a>
                        <div class="collapse menu mega-dropdown togoler-item">
                            <div class="dropmenu">
                                <div class="container-fluid ">
                                    <div class="row" style="background: #222e3c">
                                        <div class="col-lg-12 px-2">
                                            <div class="submenu-box"> 
                                                <ul class="list-unstyled m-0">
                                                    <li> <a href="{{route('all.order')}}" class="nav-link"> All order </a></li>
                                                    <li> <a href="{{route('new.order')}}" class="nav-link"> New Order </a> </li>
                                                    <li> <a href="{{route('accept.order')}}" class="nav-link"> Accept Order </a> </li>
                                                    <li> <a href="{{route('process.order')}}" class="nav-link"> Process Order </a> </li>
                                                    <li> <a href="{{route('delivery.order')}}" class="nav-link" > Delivery Order </a> </li>
                                                    <li> <a href="{{route('cancle.order')}}" class="nav-link"> Cancle Order </a> </li>
                                                </ul>
                                            </div>
                                        </div>
                                     
                                    </div>
                                </div>
                            </div>
                        </div>                         
                    </li>

                    {{--              Other         --}}

                    <li class="has-sub"> 
                        <a class="nav-link collapsed text-left togoler">
                            <i class="flaticon-user"></i>   Others 
                        </a>
                        <div class="collapse menu mega-dropdown togoler-item">
                            <div class="dropmenu">
                                <div class="container-fluid ">
                                    <div class="row" style="background: #222e3c">
                                        <div class="col-lg-12 px-2">
                                            <div class="submenu-box"> 
                                                <ul class="list-unstyled m-0">
                                                    <li> <a href="{{route('payment.setting')}}" class="nav-link"> Payment Setting </a> </li>
                                                    <li> <a href="{{route('seo.show')}}" class="nav-link"> SEO Setting  </a> </li>
                                                    <li> <a href="{{route('process.order')}}" class="nav-link"> Process Order </a> </li>
                                                    <li> <a href="{{route('delivery.order')}}" class="nav-link"> Delivery Order </a> </li>
                                                    <li> <a href="{{route('cancle.order')}}" class="nav-link"> Cancle Order </a> </li>
                                                </ul>
                                            </div>
                                        </div>
                                     
                                    </div>
                                </div>
                            </div>
                        </div>                         
                    </li>
                    <li class=""> 
                        <a class="nav-link text-left"  role="button" >
                
                    <li class=""> 
                        <a class="nav-link text-left" href="{{route('all.contact')}}">
                            <i class="flaticon-bar-chart-1"></i> Contact Message
                        </a>
                    </li>
                    <li class=""> 
                        <a class="nav-link text-left" href="{{route('stock.management')}}">
                            <i class="flaticon-bar-chart-1"></i>  Stock Management 
                        </a>
                    </li>
                    <li class=""> 
                        <a class="nav-link text-left" href="{{route('site.setting')}}">
                            <i class="flaticon-bar-chart-1"></i>  Site Setting 
                        </a>
                    </li>
                    <li class="sidebar-header">
                        tools and component
                    </li>
                    
                    <li class=""> 
                        <a class="nav-link text-left" href="{{route('welcome.page')}}" target="blank">
                            <i class="flaticon-bar-chart-1"></i>  User View
                        </a>
                    </li>
                    <li class=""> 
                        <a class="nav-link text-left"  role="button" >
                            <i class="flaticon-bar-chart-1"></i>  ui element 
                        </a>
                    </li>
                
                    <li class=""> 
                        <a class="nav-link text-left"  role="button" >
                            <i class="flaticon-bar-chart-1"></i>  form 
                        </a>
                    </li>
                    <li class=""> 
                        <a class="nav-link text-left"  role="button" >
                            <i class="flaticon-bar-chart-1"></i>  table 
                        </a>
                    </li>
                
                    <li class="sidebar-header">
                        tools and component
                    </li>
                    <li class=""> 
                        <a class="nav-link text-left"  role="button" >
                            <i class="flaticon-bar-chart-1"></i>  chart 
                        </a>
                    </li>
                    <li class=""> 
                        <a class="nav-link text-left"  role="button" >
                            <i class="flaticon-map"></i>   map
                        </a>
                    </li>
                
                </ul>
        
                        
            </div>
                
                
        </nav>             
        <!-- /#sidebar-wrapper -->
     
     
        <!-- Page Content -->
        <div id="page-content-wrapper">            
            <div id="content">
                <div class="container-fluid p-0 px-lg-0 px-md-0">
                    <!-- Topbar -->
                    <nav class="navbar navbar-expand navbar-light my-navbar">
        
                        <!-- Sidebar Toggle (Topbar) -->
                        <div type="button"  id="bar" class="nav-icon1 hamburger animated fadeInLeft is-closed" data-toggle="offcanvas">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                 
     
                        <!-- Topbar Search -->
                        <form class="d-none d-sm-inline-block form-inline navbar-search"  action="{{route('admin.search')}}" method="GET">
                            @csrf
                            <div class="input-group">
                                <input type="text" class="form-control bg-light " placeholder="Search for..." aria-label="Search" name='query'>
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
     
                        <!-- Topbar Navbar -->
                        <ul class="navbar-nav ml-auto">
        
                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                            <li class="nav-item dropdown  d-sm-none">
                
                                <!-- Dropdown - Messages -->
                                <div class="dropdown-menu dropdown-menu-right p-3">
                                    <form class="form-inline mr-auto w-100 navbar-search" action="{{route('admin.search')}}" method="GET">
                                        @csrf

                                        <div class="input-group">
                                            <input type="text" name="query" class="form-control bg-light border-0 small" placeholder="Search for..." >
                                            <div class="input-group-append">
                                                <button type="submit" "btn btn-primary">
                                                    <i class="fas fa-search fa-sm"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </li> 
                            <!-- Nav Item - User Information -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="{{url('home')}}" >
                                    <img class="img-profile rounded-circle" src="{{asset(Auth::user()->profile_img)}}">
                                </a>
                            </li>
     
                        </ul>
                    </nav>
                    <!-- End of Topbar -->
                    <!-- Begin Page Content -->
                    <div class="content pt-5 pb-5">
                        @yield('content')
                    </div>
                </div>
             <!-- /.container-fluid -->
            </div>                     
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                        <div class="col-6 text-left">
                            <p class="mb-0">
                                <a href="index.html" class="text-muted"><strong>Dashboard Vishweb Design </strong></a> &copy
                            </p>
                    </div>
                    <div class="col-6 text-right">
                        <ul class="list-inline">
                            <li class="footer-item">
                                <a class="text-muted" href="#">Support</a>
                            </li>
                            <li class="footer-item">
                                <a class="text-muted" href="#">Help Center</a>
                            </li>
                            <li class="footer-item">
                                <a class="text-muted" href="#">Privacy</a>
                            </li>
                            <li class="footer-item">
                                <a class="text-muted" href="#">Terms</a>
                            </li>
                        </ul>
                    </div>
                </div>
            
            </footer>
                 
        </div>
    </div>
    <!-- /#page-content-wrapper -->
     
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

    {{-- SummerNote js --}}
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
  
    <script src="{{asset('js/backend/sidebar.js')}}" type="text/javascript"> </script>
    <script>
        @if(Session::has('messege'))
          var type="{{Session::get('alert-type','info')}}"
          switch(type){
            case 'info':
                toastr.info("{{ Session::get('messege') }}");
                break;
            case 'success':
                toastr.success("{{ Session::get('messege') }}");
                break;
            case 'warning':
                toastr.warning("{{ Session::get('messege') }}");
                break;
            case 'error':
                toastr.error("{{ Session::get('messege') }}");
                break;
            }
        @endif
       
    </script> 
    
 

    <script>
        $(document).on("click", "#delete", function(e){
            e.preventDefault();
            var link = $(this).attr("href");
            swal({
                title: "Are you Want to Return?",
                text: "It will permanently delete!",
                icon: "info",
                buttons: true,
                showCancelButton: true,
                dangerMode: true,
                confirmButtonText: 'Yes, delete it!',
                html: false,
            })
            .then(function(isConfirm){
                if (isConfirm) {
                window.location.href = link;
                }else {
                    return false;
                    swal.fire("Cancel!");
                }
            });
          
        });
    </script>
     
     <script>
 
        $('#bar').click(function(){
            $(this).toggleClass('open');
            $('#sidebar-wrapper').toggleClass('toggled' );
        
        });
        $('.togoler').click(function(){
                $(this).next('.togoler-item').toggle('slow');
        });
      
    </script>
 
    @yield('script') 
</body>