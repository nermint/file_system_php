

$(function(){

      $('.add-btn').click(function(){
        $('.add-popup-wrapper').fadeIn();
      });


    // for show file name in the input file
      $('input[type="file"]').change(function(e){
          var fileName = e.target.files[0].name;
          $(this).prev('label').text(fileName);
      });

      //close popups
      $(".close-popup").click(function(){
        $('.rename-popup-wrapper').fadeOut();
        $('.add-popup-wrapper').fadeOut();
      });

      // pagination active link

      // default active link
      var element = document.getElementById("elem");
      element.classList.add("active");

      $('.pagination li a').filter(function(){
        return this.href==location.href;
      }).parent().addClass('active').siblings().removeClass('active');


      // when click next and prev buttons
      $('.next').click(function(){
          
          $('.pagination').find('.page-item.active').next().addClass('active');
          $('.pagination').find('.page-item.active').prev().removeClass('active');
          // hemin linke yonlensin deye
          location.href=$('.pagination li.active a').attr('href');

      });

     
      $('.prev').click(function(){
          $('.pagination').find('.page-item.active').prev().addClass('active');
          $('.pagination').find('.page-item.active').next().removeClass('active');

          location.href=$('.pagination li.active a').attr('href');
      });
    
      
     
});


  