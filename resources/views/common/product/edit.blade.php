@extends('layouts.admin.header')
@section('link')

@section('content')

{{-- product insert page --}}
<div class="product-create">
    <div class="card">
        <div class="card-header">
          <h4>Update Product  </h4>
          <a href="{{route('product.auth')}}" style='float:right;'> ALL probuct </a>
        </div>
        <div class="card-body">
            <form class="form" method="post" action="/admin/product/update/{{$product->id}}" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="row">
                    <div class="form-group col-md-6 col-11 col-lg-4">
                        <lable class="form-lable" for="product_name"> Product Name: <span>*</span></lable>
                        <input type="text" class="form-control @error('product_name') is-invalid @enderror"
                            name="product_name" value="{{$product->product_name}}">

                        @error('product_name')
                            <span class="invalid-feedback" role="alert">
                                <strong> {{$message}}</strong>
                            </span>
                        @enderror
                    
                    </div>
                    <div class="form-group col-md-6 col-11 col-lg-4">
                        
                        <lable class="form-lable" for="product_name"> Product Code:<span>*</span></lable>
                        <input type="text" class="form-control @error('product_code') is-invalid @enderror"
                            name="product_code" value="{{$product->product_code}}">

                        @error('product_code')
                            <span class="invalid-feedback" role="alert">
                                <strong> {{$message}}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6 col-11 col-lg-4">
                       
                        <lable class="form-lable" for="product_quantity"> Product quantity:<span>*</span></lable>
                        <input type="text" class="form-control @error('product_quantity') is-invalid @enderror"
                            name="product_quantity" value="{{$product->product_quantity}}">

                        @error('product_quantity')
                            <span class="invalid-feedback" role="alert">
                                <strong> {{$message}}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-11 col-md-6 col-lg-4">
                        <lable class="form-lable" for="category_id">Category Name:<span>*</span></lable>
                        <select  class="form-control @error('category_id') is-invalid @enderror" 
                        name="category_id" id="category">
                            <option>  </option>
                            @foreach ($categories as $category)
                            <option value="{{$category->id}}" {{$category->id == old('category_id',$product->category_id) ? 'selected' : ''}}>{{$category->name}}</option>
                            @endforeach
                            
                        </select>
                        @error('category_id')
                            <span class="invalid-feeback" role="alert">
                                <strong> {{message}} </strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-11 col-md-6 col-lg-4">
                        <lable class="form-lable" for= "subcategory_id"> Subcat Name:<span>*</span></lable>
                        <select  class="form-control @error('subcategory_id') is-invalid @enderror" 
                        name="subcategory_id" id="subcat">
                        @foreach ($subcats as $subcat)
                        <option value="{{$subcat->id}}" {{old('$subcat_id',$product->subcategory_id) == $subcat->id ? 'selected': ''}}>{{$subcat->category_name}}</option> 
                        @endforeach
                         
                        </select>
                        @error('subcategory_id')
                            <span class="invalid-feeback" role="alert">
                                <strong> {{message}} </strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-11 col-md-6 col-lg-4">
                        <lable class="form-lable" for="brand_id">Brand Name:<span>*</span></lable>
                        <select  class="form-control @error('brand_id') is-invalid @enderror" 
                        name="brand_id">
                        @foreach ($brands as $brand)
                        <option value="{{$brand->id}}" {{old('$brand->id',$product->brand_id)==$brand->id ? 'selected': ''}}> {{$brand->brand_name}} </option>
                        @endforeach
                        </select>
                        @error('brand_id')
                            <span class="invalid-feeback" role="alert">
                                <strong> {{message}} </strong>
                            </span>
                        @enderror
                    </div>
                   
                    <div class="form-group col-11 col-md-6 col-lg-4">
                        <lable class="form-label" for="product_color"> chosen multi color: <span>*</span> </lable>
                        <input id="color" type="text" value="{{$product->product_color}}" data-role="tagsinput" class="form-control @error('product_color') is-invalid @enderror" name="product_color">

                        @error('product_color')
                            <span class="invalid-feeback" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-11 col-md-6 col-lg-4">
                        <lable class="form-label" for="product_size"> chosen multi Size: <span>*</span> </lable>
                        <input id="color" type="text" value="{{$product->product_size}}" data-role="tagsinput" class="form-control @error('product_size') is-invalid @enderror" name="product_size">

                        @error('product_size')
                            <span class="invalid-feeback" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6 col-11 col-lg-4">
                        <lable class="form-lable" for="selling_price"> Seling Prize: <span>*</span></lable>
                        <input type="text" class="form-control @error('selling_price') is-invalid @enderror"
                            name="selling_price" value="{{$product->selling_price}}">

                        @error('selling_price')
                            <span class="invalid-feedback" role="alert">
                                <strong> {{$message}}</strong>
                            </span>
                        @enderror
                    
                    </div>
                    <hr>
                    

                    <div class="form-group col-12 w-100 mb-5">
                        
                        <lable class="form-lable" for="product_details"> Porduct Description </lable>
                        <textarea class="form-control pd  @error('product_details') is-invalid @enderror"
                            name="product_details" id="tiny" value="{{old('product_details')}}" rows="12"> {{$product->product_details}}</textarea>
                        
                        @error('product_details')
                            <span class="invalid-feeback" role="alert">
                                <strong>{{$message}} </strong>
                            </span>
                        @enderror
                    </div>

                    <hr>

                    <div class="form-group col-md-6 col-11 col-lg-4">
                        <lable class="form-lable" for="discount_price"> Discount Price: <span>1</span></lable>
                        <input type="text" class="form-control @error('discount_price') is-invalid @enderror"
                            name="discount_price" value="{{$product->discount_price}}">

                        @error('discount_price')
                            <span class="invalid-feedback" role="alert">
                                <strong> {{$message}}</strong>
                            </span>
                        @enderror
                    
                    </div>
                    <div class="form-group col-md-8 col-11 col-lg-8">
                        <lable class="form-lable" for="social_link"> Social_link: <span>1</span></lable>
                        <input type="text" class="form-control @error('social_link') is-invalid @enderror"
                            name="social_link" value="{{$product->social_link}}">

                        @error('social_link')
                            <span class="invalid-feedback" role="alert">
                                <strong> {{$message}}</strong>
                            </span>
                        @enderror
                    
                    </div>
                    <div class="form-group col-md-6 col-11 col-lg-6">
                        <lable class="form-lable" for="main_img"> Main img: <span>*</span></lable>
                        <img src="{{asset($product->main_img)}}" alt="" style="width:80px;height:60px; margin: 10px 10px;">
                        <input type="file" class="form-control @error('main_img') is-invalid @enderror"
                            name="main_img"  value="{{$product->main_img}}" onchange="readURL(this)";>
                            
                            <input type="hidden" name="old_main_img" value="{{$product->main_img}}">        

                        @error('main_img')
                            <span class="invalid-feedback" role="alert">
                                <strong> {{$message}}</strong>
                            </span>
                        @enderror
                        
                        <img src="#" id='main-img' style="width: 50px; height:50px; margin: 10px 10px;">
                    </div>
                    <div class="form-group col-md-6 col-11 col-lg-6">
                        <lable class="form-lable" for="img_one"> Img_one: <span>*</span></lable>
                        <img src="{{asset($product->img_one)}}" alt="" style="width:80px;height:60px; margin: 10px 10px;">
                        <input type="file" class="form-control @error('img_one') is-invalid @enderror"
                            name="img_one" value="{{$product->img_one}}" onchange="readURL1(this)";>

                            <input type="hidden" name="old_img_one" value="{{$product->img_one}}">
                        @error('img_one')
                            <span class="invalid-feedback" role="alert">
                                <strong> {{$message}}</strong>
                            </span>
                        @enderror
                        <img src="#" alt="" id='one' style="width: 50px; height:50px; margin: 10px 10px;">
                    </div>
                    <div class="form-group col-md-6 col-11 col-lg-6">
                        <lable class="form-lable" for="img_two"> Img Two: <span>*</span></lable>
                        <img src="{{asset($product->img_two)}}" alt="" style="width:80px;height:60px; margin: 10px 10px;">
                        <input type="file" class="form-control @error('img_two') is-invalid @enderror"
                            name="img_two" value="{{$product->img_two}}"onchange="readURL2(this)";>

                       <input type="hidden" name="old_img_two" value="{{$product->img_two}}">  

                        @error('img_two')
                            <span class="invalid-feedback" role="alert">
                                <strong> {{$message}}</strong>
                            </span>
                        @enderror
                        <img src="#" alt="" id="two" style="width: 50px; height:50px; margin: 10px 10px;">
                    </div>
                    <div class="form-group col-md-6 col-11 col-lg-6">
                        <lable class="form-lable" for="img_three"> Img Three
                        <img src="{{asset($product->img_three)}}" alt="" style="width:80px;height:60px; margin: 10px 10px; ">
                        @if (!$product->img_three)
                            <a href="/admin/image_4/{{$product->id}}"  style="float:right;margin:10px 20px;">
                                <i class="fas fa-plus"></i>
                            </a> 
                        @endif

                        <input type="file" class="form-control @error('img_three') is-invalid @enderror"
                            name="img_three" value="{{old('$product->img_three')}}"onchange="readURL3(this)";>


                        <input type="hidden" name="old_img_three" value="{{$product->img_three}}"> 
                       

                        @error('img_three')
                            <span class="invalid-feedback" role="alert">
                                <strong> {{$message}}</strong>
                            </span>
                        @enderror
                        <img src="" id="three" alt="" style="width: 50px; height:50px; margin: 10px 10px;">
                    </div>
                    
                </div>
                <hr>
                <br>
                <div class="row">
                    <div class="col-sm-6 col-lg-4">
                        <div class="form-check">
                            <input class="form-check-input @error('main_slider') is-invalid @enderror" type="checkbox" 
                            name="main_slider" value="1" {{$product->main_slider == 1? 'checked': 0}} >
                            <label class="form-check-label" for="defaultCheck1" id="check">
                              Main slider
                            </label>
                            @error('main_slider')
                                <span class="invlid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="form-check">
                            <input class="form-check-input @error('hot_deal') is-invalid @enderror" type="checkbox" 
                            name="hot_deal" value="1"{{$product->hot_deal == 1 ? 'checked': 0}} >
                            <label class="form-check-label" for="defaultCheck1" id="check">
                                Hot Deal
                            </label>
                            @error('hot_deal')
                                <span class="invlid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-4">
                        <div class="form-check">
                            <input class="form-check-input @error('best_rated') is-invalid @enderror" type="checkbox" 
                            name="best_rated" value="1" {{$product->best_rated == 1 ? 'checked' : 0}} >
                            <label class="form-check-label" for="defaultCheck1" id="check">
                              Best Rated
                            </label>
                            @error('best_rated')
                                <span class="invlid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="form-check">
                            <input class="form-check-input @error('trend') is-invalid @enderror" type="checkbox" 
                            name="trend" value="1" {{$product->trend == 1? 'checked' : 0}} >
                            <label class="form-check-label" for="defaultCheck1" id="check">
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
                            name="mid_slide" value="1" {{$product->mid_slide == 1 ? 'checked':0}}>
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
                            name="print" value="1" {{$product->print == 1 ? 'checked':0}}>
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

               
                <button type="submit" class="btn btn-primary w-100 text-uppercase mt-5"> Submit </button>
            </form>
        </div>
        <div class="card-footer">
            {{-- <a href="{{route('view.product',$product->id)}}"> All Brand </a> --}}
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

