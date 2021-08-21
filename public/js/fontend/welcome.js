$(document).ready(function(){
    // category section
     $('.togoler-item').hide();
     $('.togoler').click(function(){
         $(this).next('.togoler-item').toggle('slow');
     });

     $('.category-header').click(function(){
         $('.catagory-item').toggle('slow');
     });


     //New and hot Section

     $('.trend-item').hide();
     $('.best-item').hide();

   
     $('.trend').click(function(){
       $('.trend-item').show();
       $('.best-item').hide();
       $('.fuautured-item').hide();

     });
     $('.best-rated').click(function(){
       $('.best-item').show();
       $('.fuautured-item').hide();
       $('.trend-item').hide();

     });
     $('.futured').click(function(){
       $('.fuautured-item').show();
       $('.best-item').hide();
       $('.trend-item').hide();

     });

    // Product Carousel
    $('.feautured').owlCarousel({
        slideSpeed : 300,
        paginationSpeed : 400,
        singleItem:true,
        responsiveClass:true,
        autoplay: true,
        autoPlaySpeed: 5000,
        autoPlayTimeout: 5000,
        autoplayHoverPause: true,
        responsive:{
            0:{
                items:1,
            },
            600:{
                items:1,
                
            },
            1000:{
                items:1,
            }
        }
    });

    // Month of the deal


    $('.month-deals').owlCarousel({
        loop:true,
        margin:10,
        nav:true,
        responsiveClass:true,
        responsive:{
            0:{
                items:2,
                nav:true,
            },
            600:{
                items:3,
                nav:true,
            },
            1000:{
                items:5,
                nav:true,
                loop:true,
            }
        }
    });
    // category carousel
    $('.carousel-category').owlCarousel({
        slideSpeed : 300,
        singleItem:true,
        responsiveClass:true,
        autoplay: true,
        autoPlaySpeed: 5000,
        autoPlayTimeout: 5000,
        autoplayHoverPause: true,
        responsiveClass:true,
        responsive:{
          0:{
              items:2,
          },
          600:{
              items:3,
        paginationSpeed : 400,
              
          },
          1000:{
              items:5,
              loop:true,
          }
        }
    });

    // mid slider
    $('.mid-slider').owlCarousel({
        slideSpeed : 300,
        paginationSpeed : 400,
        singleItem:true,
        responsiveClass:true,
        autoplay: true,
        autoPlaySpeed: 5000,
        autoPlayTimeout: 5000,
        autoplayHoverPause: true,
        responsive:{
              0:{
                items:1,
              },
              600:{
                items:1,
                  
              },
              1000:{
                items:1,
            }
        }
    });
});