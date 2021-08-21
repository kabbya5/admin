@extends('layouts.admin.header')
@section('link')
@section('content')
{{-- product insert page --}}
<div class="product-create">
    <div class="card">
        <div class="card-header">
          <h4 class="text-dark"> Add a Product </h4>
          <a href="{{route('product.auth')}}" style='float:right;'> All Product </a>
        </div>
        <div class="card-body">
            <form method="post" action="/admin/product/store" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="form-group col-md-6 col-11 col-lg-4">
                        <lable class="form-lable" for="product_name"> Product Name: <span class="text-danger ml-2"> * </span></lable>
                        <input type="text" class="form-control @error('product_name') is-invalid @enderror"
                            name="product_name" value="{{old('product_name')}}">

                        @error('product_name')
                            <span class="invalid-feedback" role="alert">
                                <strong> {{$message}}</strong>
                            </span>
                        @enderror
                    
                    </div>
                    <div class="form-group col-md-6 col-11 col-lg-4">
                        
                        <lable class="form-lable" for="product_name"> Product Code:<span class="text-danger ml-2">*</span></lable>
                        <input type="text" class="form-control @error('product_code') is-invalid @enderror"
                            name="product_code" value="{{old('product_code')}}" required>

                        @error('product_code')
                            <span class="invalid-feedback" role="alert">
                                <strong> {{$message}}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6 col-11 col-lg-4">
                       
                        <lable class="form-lable" for="product_quantity"> Product quantity:<span class="text-danger ml-2">*</span></lable>
                        <input type="text" class="form-control @error('product_quantity') is-invalid @enderror"
                            name="product_quantity" value="{{old('product_quantity')}}" >

                        @error('product_quantity')
                            <span class="invalid-feedback" role="alert">
                                <strong> {{$message}}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-11 col-md-6 col-lg-4">
                        <lable class="form-lable" for="category_id">Category Name:<span class="text-danger ml-2">*</span></lable>
                        <select  class="form-control @error('category_id') is-invalid @enderror" 
                        name="category_id" id="category"  required>
                            <option> Select category  </option>
                            @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                            
                        </select>
                        @error('category_id')
                            <span class="invalid-feeback" role="alert">
                                <strong> {{message}} </strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-11 col-md-6 col-lg-4">
                        <lable class="form-lable" for= "subcategory_id"> Subcat Name:<span class="text-danger ml-2">*</span></lable>
                        <select  class="form-control @error('subcategory_id') is-invalid @enderror" 
                        name="subcategory_id" id="subcat" required>
                         
                        </select>
                        @error('subcategory_id')
                            <span class="invalid-feeback" role="alert">
                                <strong> {{message}} </strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-11 col-md-6 col-lg-4">
                        <lable class="form-lable" for="brand_id">Brand Name:<span class="text-danger ml-2">*</span></lable>
                        <select  class="form-control @error('brand_id') is-invalid @enderror" 
                        name="brand_id" required>
                        <option> Select brand  </option>
                        @foreach ($brands as $brand)
                        <option value="{{$brand->id}}">{{$brand->brand_name}}</option>
                        @endforeach
                        </select>
                        @error('brand_id')
                            <span class="invalid-feeback" role="alert">
                                <strong> {{message}} </strong>
                            </span>
                        @enderror
                    </div>
                   

                    <div class="form-group col-11 col-md-6 col-lg-4">
                        <lable class="form-lable" for="product_color"> chosen multi color: <span class="text-danger ml-2">*</span> </lable>
                        <input id="color" type="text" value="{{old('product_color')}}" data-role="tagsinput" class="form-control @error('product_color') is-invalid @enderror" name="product_color">

                        @error('product_color')
                            <span class="invalid-feeback" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-11 col-md-6 col-lg-4">
                        <lable class="form-lable" for="product_size"> chosen multi Size: <span class="text-danger ml-2">*</span> </lable>
                        <input id="color" type="text" value="{{old('product_size')}}" data-role="tagsinput" class="form-control @error('product_size') is-invalid @enderror" name="product_size">

                        @error('product_size')
                            <span class="invalid-feeback" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6 col-11 col-lg-4">
                        <lable class="form-lable" for="selling_price"> Seling Prize: <span class="text-danger ml-2">*</span> </lable>
                        <br>
                        <input type="text" class="form-control @error('selling_price') is-invalid @enderror"
                            name="selling_price" value="{{old('selling_price')}}" required>

                        @error('selling_price')
                            <span class="invalid-feedback" role="alert">
                                <strong> {{$message}}</strong>
                            </span>
                        @enderror
                    
                    </div>
                    <hr>
                    <div class="form-group col-md-12 col-lg-12 col-11 mb-5">
                        <lable class="form-lable" for="product_details"> Porduct Description </lable>
                        <textarea class="form-control pd @error('product_details') is-invalid @enderror"
                            name="product_details" id="tiny" value="{{old('product_details')}}" rows="12"></textarea>
                        
                        @error('product_details')
                            <span class="invalid-feeback" role="alert">
                                <strong>{{$message}} </strong>
                            </span>
                        @enderror
                    </div>
                    <hr>
                    <div class="form-group col-md-6 col-11 col-lg-4">
                        <lable class="form-lable" for="discount_price"> Discount Price: </lable>
                        <input type="text" class="form-control @error('discount_price') is-invalid @enderror"
                            name="discount_price" value="{{old('discount_price')}}">

                        @error('discount_price')
                            <span class="invalid-feedback" role="alert">
                                <strong> {{$message}}</strong>
                            </span>
                        @enderror
                    
                    </div>
                    <div class="form-group col-md-6 col-11 col-lg-4">
                        <lable class="form-lable" for="social_link"> Social_link: <span class="ml-2 text-danger"> 1 </span></lable>
                        <input type="text" class="form-control @error('social_link') is-invalid @enderror"
                            name="social_link" value="{{old('social_link')}}">

                        @error('social_link')
                            <span class="invalid-feedback" role="alert">
                                <strong> {{$message}}</strong>
                            </span>
                        @enderror
                    
                    </div>
                    <div class="form-group col-md-6 col-11 col-lg-4">
                        <lable class="form-lable" for="main_img"> Main img: <span class="ml-2 text-danger">*</span></lable>
                        <input type="file" class="form-control @error('main_img') is-invalid @enderror"
                            name="main_img"  value="{{old('main_img')}}" onchange="readURL(this)"; required>
                            
                        

                        @error('main_img')
                            <span class="invalid-feedback" role="alert">
                                <strong> {{$message}}</strong>
                            </span>
                        @enderror
                        <img src="#" alt="" id='main-img'>
                    </div>
                    <div class="form-group col-md-6 col-11 col-lg-4">
                        <lable class="form-lable" for="img_one"> Img_one:<span class="ml-2 text-danger">*</span></lable>
                        <input type="file" class="form-control @error('img_one') is-invalid @enderror"
                            name="img_one" value="{{old('img_one')}}" onchange="readURL1(this)"; required>

                        @error('img_one')
                            <span class="invalid-feedback" role="alert">
                                <strong> {{$message}}</strong>
                            </span>
                        @enderror
                        <img src="#" alt="" id='one'>
                    </div>
                    <div class="form-group col-md-6 col-11 col-lg-4">
                        <lable class="form-lable" for="img_tow"> Img two: <span class="ml-2 text-danger">*</span></lable>
                        <input type="file" class="form-control @error('img_two') is-invalid @enderror"
                            name="img_two" value="{{old('img_two')}}"onchange="readURL2(this)"; required>

                        @error('img_two')
                            <span class="invalid-feedback" role="alert">
                                <strong> {{$message}}</strong>
                            </span>
                        @enderror
                        <img src="#" alt="" id="two">
                    </div>
                    <div class="form-group col-md-6 col-11 col-lg-4">
                        <lable class="form-lable" for="img_three"> Img Three</lable>
                        <input type="file" class="form-control @error('img_three') is-invalid @enderror"
                            name="img_three" value="{{old('img_three')}}"onchange="readURL3(this)";>

                        @error('img_three')
                            <span class="invalid-feedback" role="alert">
                                <strong> {{$message}}</strong>
                            </span>
                        @enderror
                        <img src="" id="three" alt="">
                    </div>                    
                </div>
                <hr>
                <br>
                <div class="row">
                    <div class="col-6 col-lg-4">
                        <div class="form-check">
                            <input class="form-check-input @error('main_slider') is-invalid @enderror" type="checkbox" 
                            name="main_slider" value="1" >
                            <label class="form-check-lable" for="defaultCheck1" id="check">
                              Main slider
                            </label>
                            @error('main_slider')
                                <span class="invlid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6 col-lg-4">
                        <div class="form-check">
                            <input class="form-check-input @error('hot_deal') is-invalid @enderror" type="checkbox" 
                            name="hot_deal" value="1" >
                            <label class="form-check-lable" for="defaultCheck1" id="check">
                                Hot Deal
                            </label>
                            @error('hot_deal')
                                <span class="invlid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-6 col-lg-4">
                        <div class="form-check">
                            <input class="form-check-input @error('best_rated') is-invalid @enderror" type="checkbox" 
                            name="best_rated" value="1" >
                            <label class="form-check-lable" for="defaultCheck1" id="check">
                              Best Rated
                            </label>
                            @error('best_rated')
                                <span class="invlid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6 col-lg-4">
                        <div class="form-check">
                            <input class="form-check-input @error('hot_new') is-invalid @enderror" type="checkbox" 
                            name="hot_new" value="1" >
                            <label class="form-check-lable" for="defaultCheck1" id="check">
                                Hot New
                            </label>
                            @error('hot_new')
                                <span class="invlid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>
                        
                    </div>
                    <div class="col-6 col-lg-4">
                        <div class="form-check">
                            <input class="form-check-input @error('trend') is-invalid @enderror" type="checkbox" 
                            name="trend" value="1" >
                            <label class="form-check-lable" for="defaultCheck1" id="check">
                               Trend
                            </label>
                            @error('trend')
                                <span class="invlid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    @if(Auth::user()->role_id == 1)
                    <div class="col-sm-6 col-lg-4">
                         <div class="form-check">
                             <input class="form-check-input @error('hot_new') is-invalid @enderror" type="checkbox" 
                             name="mid_slide" value="1"}}>
                             <label class="form-check-label" for="defaultCheck1" id="check">
                                 Mid Slide
                             </label>
                             @error('mid_slide')
                                 <span class="invlid-feedback" role="alert">
                                     <strong>{{$message}}</strong>
                                 </span>
                             @enderror
                         </div>
                     </div>
                     <div class="col-sm-6 col-lg-4">
                         <div class="form-check">
                             <input class="form-check-input @error('print') is-invalid @enderror" type="checkbox" 
                             name="print" value="1" }}>
                             <label class="form-check-label" for="defaultCheck1" id="check">
                                 Print
                             </label>
                             @error('print')
                                 <span class="invlid-feedback" role="alert">
                                     <strong>{{$message}}</strong>
                                 </span>
                             @enderror
                         </div>
                     </div>
 
                    @endif
                </div>

               
                <button type="submit" class="btn btn-primary mt-3 w-100 text-uppercase"> Submit </button>
            </form>
        </div>
        
    </div>
    
</div>
@endsection


@section('script')
<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
<script src="https://cdn.tiny.cloud/1/ig985bs3zdb6vavhd3up71ikml5iplnqyeu2ltyo69pxd1xb/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    
<script>
    $(document).ready(function(){
        $('select[name="category_id"]').on('change',function(){
            var category_id = $(this).val();
            console.log(category_id)
            if (category_id) {
            
                $.ajax({
                    url: "{{ url('/get/subcategory/') }}/"+category_id,
                    type:"GET",
                    dataType:"json",
                    success:function(data) { 
                        
                        $('select[name="sucategory_id"]').empty();
                        $.each(data, function(key, value){
              
                        $('select[name="subcategory_id"]').append('<option value="'+ value.id + '">' + value.category_name + '</option>');
                    });
                },
            });
            }else{
                $('select[name="subcategory_id"]').empty();
            }
        });
    });
    
    tinymce.init({
      selector: '#tiny'
    });
</script> 
<script type="text/javascript">
    function readURL(input){
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          $('#main-img')
          .attr('src', e.target.result)
          .width(80)
          .height(80);
        };
        reader.readAsDataURL(input.files[0]);
      }
    }
  </script>
<script type="text/javascript">
    function readURL1(input){
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          $('#one')
          .attr('src', e.target.result)
          .width(80)
          .height(80);
        };
        reader.readAsDataURL(input.files[0]);
      }
    }
  </script>
  
   <script type="text/javascript">
    function readURL2(input){
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          $('#two')
          .attr('src', e.target.result)
          .width(80)
          .height(80);
        };
        reader.readAsDataURL(input.files[0]);
      }
    }
  </script>
  
  
  
   <script type="text/javascript">
    function readURL3(input){
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          $('#three')
          .attr('src', e.target.result)
          .width(80)
          .height(80);
        };
        reader.readAsDataURL(input.files[0]);
      }
    }
  </script>
@endsection