<div id="wrapper">
    <div class="overlay">

    </div>
     
    <!-- Sidebar -->
    <nav class="fixed-top align-top" id="sidebar-wrapper" role="navigation">
        <div class="simplebar-content" style="padding: 0px;">
            <a class="sidebar-brand" href="{{ url('/home') }}">
                <span class="align-middle text-capitalize">{{Str::limit(Auth::user()->username,10)}}</span>
            </a>
 
            <ul class="navbar-nav align-self-stretch">
                <li class="sidebar-header">
                    @if(Auth::user()->profile_img)
                    <img src="{{asset(Auth::user()->profile_img)}}">
                    <button type="button" class="btn btn-primary text-right text-white" data-toggle="modal" data-target="#exampleModalCenter" style="float:right;">
                        Upload Images
                    </button>
                    @else
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModalCenter" style="float:right;">
                        Upload Images
                    </button>
                    @endif
                </li>
                <li class=""> 
                    <a class="nav-link text-left active"  role="button" 
                        aria-haspopup="true" aria-expanded="false">
                        <i class="flaticon-bar-chart-1"></i>  Dashboard 
                    </a>
                </li>
                
                <li class=""> 
                    <a class="nav-link text-left" href="{{ url('/home') }}">
                         Profile
                    </a>
                </li>
                <li> 
                    <a class="nav-link  text-left"  href="{{ route('wishlist') }}">
                         WishList Items
                    <a/>                     
                </li>
                <li class=""> 
                    <a class="nav-link collapsed text-left" href="{{ route('edit.profile') }}">
                        Edit Profile 
                    </a>                     
                </li>
                <li class=""> 
                    <a class="nav-link  text-left" href="{{route('password.change')}}">
                        Change Password 
                    </a>                     
                </li>
                <li class=""> 
                    <a class="nav-link  text-left" href="{{route('user.logout')}}">
                        LogOut
                    </a>                     
                </li>
               
            
            </ul>
    
                    
        </div>
            
            
    </nav>           
      
    <!-- /#sidebar-wrapper -->
 
 
 
 
 
 
 
 
 
 
    <!-- Page Content -->
    <div id="page-content-wrapper" class="mt-5">            
        <div id="content">
            <div class="container-fluid p-0 px-lg-0 px-md-0">
            <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light my-navbar">
    
                    <!-- Sidebar Toggle (Topbar) -->
                    <div type="button"  id="bar" class="nav-icon1 hamburger animated fadeInLeft is-closed" data-toggle="offcanvas">
                        <h2> Profile </h2>
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
             
 
                    <!-- Topbar Search -->
 
                    <!-- Topbar Navbar -->
                </nav>
                <!-- End of Topbar -->
 
              
                
 
            </div>
         <!-- /.container-fluid -->
 
        </div>
             
             
             
    </div>
</div>

@section('script')
<script>
    $(document).ready(function(){
        
        $('.togoler').click(function(){
            $(this).next('.togoler-item').toggle('slow');
        });
    });
</script>
<script>
 
    $('#bar').click(function(){
        $(this).toggleClass('open');
        $('#page-content-wrapper ,#sidebar-wrapper').toggleClass('toggled' );
    
    });
</script>
@endsection