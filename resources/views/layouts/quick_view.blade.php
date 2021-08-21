{{-- ajax-quick view --}}
<div class="quickview">
  <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Quick View Product </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12 col-lg-6 mb-5">
              <div class="img-section">  
                {{-- slider  carousel  --}}
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                  <ol class="carousel-indicators">
                    {{-- if images three is null --}}
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"> 
                    </li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1">
                    </li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2">
                    </li> 
                    {{-- images three is not null --}}
                    <li data-target="#carouselExampleIndicators" data-slide-to="3" id="sliderItem4">
                    </li>                           
                  </ol>
                  <div class="carousel-inner">
                    {{-- if images three is null --}}
                    <div class="carousel-item active">
                      <img src="" class="d-block w-100" id="main_img">
                    </div>
                    <div class="carousel-item">
                      <img src="" class="d-block w-100" id="img_one">                               
                    </div>
                    <div class="carousel-item">
                      <img src="" class="d-block w-100" id="img_two">         
                    </div>                      
                    {{-- images three is not null --}}
                    <div class="carousel-item">
                      <img src="" class="d-block w-100" id="img_three">
                    </div>                         
                  </div>
                </div>
                {{-- end slider carousel --}}
              </div>
            </div>
            {{-- product details --}}
            <div class="col-md-12 col-lg-6 mb-5">
              <div class="catgory">
                <span id="category"> </span> |
                <span id="subcat"> </span>   
              </div>
              <div class="name">
                <h4 id="product_name">  </h4>
                <span id="brand_name">  </span>
              </div>
              <div class="price-section">
                <h3> TK <span id="discount-price"> </span> <span class='text-danger' id="selling-price"></span> </h3>  
              </div>
              <div class="input-section">
                <form action="" method="post" id="modal-form">
                @csrf
                <div class="form-group" id="modal-color">
                  <label for="color"> Select Color </label>
                  <select name="color" id="color" class="form-control">             
                  </select>
                </div>
              
                <div class="form-group" id="modal-size">
                  <label for="size"> Select Size </label>
                  <select name="size" id="size" class="form-control">
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleFormControlSelect1"> Quantity </label>
                    <input class="form-control" type="number" value="1" pattern="[0-9]" name="qty">	
                </div> 
  
                <button class="btn btn-primary" type="submit"> Add to Card </button>
                </form>
              </div>
            </div>
            {{-- end product detail --}}
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>            
      </div>
    </div>
  </div>    
</div>
           
  {{-- end ajax quick view --}}