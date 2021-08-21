<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- Title --}}
    <title style="text-transform: capitalize;">
     {{ $setting->name}}    
    </title>
    <link rel = "icon" href ="{{asset($setting->logo)}}"  type = "image/x-icon">
    <!-- Scripts -->
    <scrip src="{{ asset('js/app.js') }}" defer></scrip>
   <!-- Owl carousel  -->
   <link rel="stylesheet" href="{{asset('/css/plugin/OwlCarousel/owl.carousel.min.css')}}">
   <link rel="stylesheet" href="{{asset('/css/plugin/OwlCarousel/owl.theme.default.min.css')}}">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <!-- Styles -->
    
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{-- Toastr  --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" />
    @yield('style')
</head>
<body class="antialiased">
  <div class="content">
    @yield('content') 
  </div>
          
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> --}}
{{-- owl-carousel --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous"></script>
<script src="{{asset('/js/plugin/OwlCarousel/owl.carousel.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.all.min.js"></script>
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
  $(document).ready(function(){
    $('.quick-view').on('click',function(){
      var id = $(this).data('id');
      $.ajax({
        url:"{{url('/product/quickview/')}}/"+id,
        type:"GET",
        dataType:"json",
        success:function(data){
          $('#main_img').attr("src",'/'+ data[0].main_img);
          $('#img_one').attr("src", '/'+  data[0].img_one);  
          $('#img_two').attr("src", '/'+  data[0].img_two); 
          if(data[0].img_three === null){   
            $('#sliderItem4').hide();  
          }else{
            $('#img_three').attr("src", '/'+ data[0].img_three);
            $('#sliderItem4').show();
          }
          $('#product_name').html(data[0].product_name);
          $('#category').html(data[4].name);
          
          if(data[0].discount_price === null){
            $('#discount-price').html(data[0].selling_price);
          }else{
            $('#selling-price').html(data[0].selling_price);
            $('#discount-price').html(data[0].discount_price);
          }
          if(data[5].category_name === null){
            $('#subcat').hide();   
          }else{
            $('#subcat').html(data[5].category_name);
          }
          if(data[0].product_color === null){
            $('#modal-color').hide();
            }else{
              $('#modal-color').show();
              $('select[name="color"]').empty();
              $.each(data[1], function(key, value){         
                $('select[name="color"]').append('<option value="'+ value + '">' + value + '</option>');
              });
          }
          if(data[0].product_size === null){
            $('#modal-size').hide();
          }else{
            $('#modal-size').show();
            $('select[name="size"]').empty();
            $.each(data[2], function(key, value){         
              $('select[name="size"]').append('<option value="'+ value + '">' + value + '</option>');
            });
          } 
          //modal form
          $('#modal-form').attr('action','/cart/product/add/'+data[0].id);
        },

        error: function (xhr, status, error) {
            alert ('Something is Rong Prees View Button');
        }
      });
    });
  });
</script>
<script type="text/javascript">
    $(document).ready(function(){
      $('.addwishlish').on('click',function(){
        var id = $(this).data('id');
        if(id){
          $.ajax({
            url:"{{url('add/wishlist/')}}/"+id,
            type:"GET",
            dataType:"json",
            success:function(data){
              const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                onOpen: (toast) => {
                  toast.addEventListener('mouseenter', Swal.stopTimer)
                  toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
              })
              if($.isEmptyObject(data.error)){
                  Toast.fire({
                  icon: 'success',
                  title:data.success
                })
              }else{
                Toast.fire({
                  icon: 'error',
                  title: data.error
                })
              }           
            },
          });
        }else{
          alert('danger')
        }
      });
    });
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $('.addcart').on('click',function(){
      var id = $(this).data('id');
      if(id){
        $.ajax({
          url:"{{url('add/cart/')}}/"+id,
          type:"GET",
          dataType:"json",
          success:function(data){
            const Toast = Swal.mixin({
              toast: true,
              position: 'top-end',
              showConfirmButton: false,
              timer: 3000,
              timerProgressBar: true,
              onOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
              }
            })
            if($.isEmptyObject(data.error)){
                Toast.fire({
                icon: 'success',
                title: data.success
              })
            }else{
              Toast.fire({
                icon: 'error',
                title: data.error
              })
            }           
          },
        });
      }else{
        allert('danger')
      }
    });
  });
</script>




@yield('script')


</body>
</html>