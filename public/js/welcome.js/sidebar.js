$(document).ready(function(){
  
    $('.togoler-item').hide();
    $('.togoler').click(function(){
        $(this).next('.togoler-item').toggle('slow');
    });
    
    $('.category-header').click(function(){
        $('.catagory-item').toggle('slow');
    });
    // model
    $('#myModal').on('shown.bs.modal', function () {
        $('#myInput').trigger('focus')
      });
});
