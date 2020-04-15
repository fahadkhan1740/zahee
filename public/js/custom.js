(function($) {
    'use strict';

})(jQuery)

AOS.init();

$(window).on('load', function() {
    $(".loader").delay(1500).fadeOut("slow");
})
$(document).ready(function() {
    setTimeout(function() {
        $("body,html").removeClass("loader-body");
    }, 2000);


    $(".h-slick").slick({
        dots: false,
        vertical: false,
        centerMode: false,
        slidesToShow: 1,
        slidesToScroll: 1
    });




    // upload file
    $('.file[type="file"]').change(function(){
        //here we take the file extension and set an array of valid extensions
            var res=$('#fileup').val();
            var arr = res.split("\\");
            var filename=arr.slice(-1)[0];
            filextension=filename.split(".");
            filext="."+filextension.slice(-1)[0];
            valid=[".avi",".mov ",".mkv ",".mp4",".avchp",".flv",".swf"];
        //if file is not valid we show the error icon, the red alert, and hide the submit button
            if (valid.indexOf(filext.toLowerCase())==-1){
                $( ".imgupload" ).hide("slow");
                $( ".imgupload.ok" ).hide("slow");
                $( ".imgupload.stop" ).show("slow");
              
                $('.namefile').css({"color":"red","font-weight":700});
                $('.namefile').html("File "+filename+" is not  video!");
                $('#btnup').html('Change Video');
                $('.namefile').addClass('after-no');
                $( "#submitbtn" ).hide();
                $( "#fakebtn" ).show(); 
            }else{
                //if file is valid we show the green alert and show the valid submit
                $( ".imgupload" ).hide("slow");
                $( ".imgupload.stop" ).hide("slow");
                $( ".imgupload.ok" ).show("slow");
              
                $('.namefile').css({"color":"green","font-weight":700});
                $('.namefile').addClass('after-no');
                $('.namefile').html(filename);
                $('#btnup').html('Change Video');
                
              
                $( "#submitbtn" ).show();
                $( "#fakebtn" ).hide();
            }
        });

})

var btn = jQuery('#top_arrow');

$(window).scroll(function() {
    if ($(window).scrollTop() > 100) {
        btn.addClass('show');
    } else {
        btn.removeClass('show');
    }
});

btn.on('click', function(e) {
    e.preventDefault();
    jQuery('html, body').animate({ scrollTop: 0 }, '300');
});



$('#search-btnn').click(function() {
    $('#search-window').toggleClass('active');
});
$('#close-search').click(function() {
    $('#search-window').removeClass('active');
});


//  Product upload

$(document).ready(function() {

    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('.profile-pic').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $(".file-upload").on('change', function() {
        readURL(this);
    });

    $(".upload-button").on('click', function() {
        $(".file-upload").click();
    });



// cart card payment

$("input[type=radio]").change(function(){
   
   if ( $('input#card-payment[type=radio]').is(":checked") ){
      $('#card-payment-data').show();
    }
   else
   {
    $('#card-payment-data').hide();
   }
 });


// cart card payment


$(".custom_radio_tab input[type=radio]").change(function(){ 

    if ( $('.custom_radio_tab input#tab-1[type=radio]').is(":checked") ){

       $('div#tab-1').show();
       $('div#tab-2').hide();
     }
    else
    {
     $('div#tab-1').hide();
     $('div#tab-2').show();
    }
  });
 





    // slider 

    $('.variable-slider.categories-slider').slick({
        dots: false,
        infinite: false,
        speed: 1000,
        slidesToShow: 9,
        slidesToScroll: 1,
        rewind:true,
        autoplay: true,
        autoplaySpeed: 3000
    });


    $('.product-slider').slick({
        dots: false,
        infinite: false,
        rewind:true,
        speed: 1000,
        slidesToShow: 6,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3000
    });




  

});

  // product slider


  $('.pro-full-slider').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    fade: false,
    asNavFor: '.pro-thubnail-slider'
  });
  $('.pro-thubnail-slider').slick({
    slidesToShow: 3,
    slidesToScroll: 1, 
    asNavFor: '.pro-full-slider',
    dots: false,
    centerMode: true,
    focusOnSelect: true
  });


// Header Smooth Scroll

var didScroll;
var lastScrollTop = 0;
var delta = 5;
var navbarHeight = $('header').outerHeight();

$(window).scroll(function(event) {
    didScroll = true;
});

setInterval(function() {
    if (didScroll) {
        hasScrolled();
        didScroll = false;
    }
}, 250);

function hasScrolled() {
    var st = $(this).scrollTop();

    if (Math.abs(lastScrollTop - st) <= delta)
        return;
    if (st < 150) {
        $('header').removeClass('nav-background');
    } else {
        $('navbar').addClass('nav-background');
    }
    if (st > lastScrollTop && st > navbarHeight) {

        $('header').removeClass('nav-down').addClass('nav-up');
    } else {

        if (st + $(window).height() < $(document).height()) {
            $('header').removeClass('nav-up').addClass('nav-down');
        }
    }
    lastScrollTop = st;
}


// select flag

$(function() {
    $('.selectpicker').selectpicker();
});



// input qty

function increaseValue() {
    var value = parseInt(document.getElementById('number').value, 10);
    value = isNaN(value) ? 0 : value;
    value++;
    document.getElementById('number').value = value;
  }
  
  function decreaseValue() {
    var value = parseInt(document.getElementById('number').value, 10);
    value = isNaN(value) ? 0 : value;
    value < 1 ? value = 1 : '';
    value--;
    document.getElementById('number').value = value;
  }




//   avtar

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#imagePreview').css('background-image', 'url('+e.target.result +')');
            $('#imagePreview').hide();
            $('#imagePreview').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#imageUpload").change(function() {
    readURL(this);
});




// timer

$( document ).ready(function() {
    setInterval(function time(){
    var d = new Date();
    var hours = 24 - d.getHours();
    var min = 60 - d.getMinutes();
    if((min + '').length == 1){
      min = '0' + min;
    }
    var sec = 60 - d.getSeconds();
    if((sec + '').length == 1){
          sec = '0' + sec;
    }
    jQuery('#countdown .hour').html(hours);
    jQuery('#countdown .min').html(min);
    jQuery('#countdown .sec').html(sec);
  }, 1000);



//   hide show

$('.action-wrap  .view-btnn').each(function(){
   $(this).click(function(){
    $(this).parents('.post-list-wraper').hide();
    $('.product-detail-wrraper').show();
   });
});


});





// Scrollbar.initAll({

//     // Momentum reduction damping factor, a float value between (0, 1)
//     damping: .05,
  
//     // Minimal size for scrollbar thumb.
//     thumbMinSize: 20,
  
//     // Render scrolling by integer pixels
//     renderByPixels: true,
  
//     // Whether allow upper scrollable content to continue scrolling when current scrollbar reaches edge. 
//     // When set to 'auto', it will be enabled on nested scrollbars, and disabled on first-class scrollbars.
//     continuousScrolling: 'auto',
  
//     // Keep scrollbar tracks always visible.
//     alwaysShowTracks: false,
  
//     // Element to be used as a listener for mouse wheel scroll events. 
//     // By default, the container element is used.
//     wheelEventTarget: null,
  
//     // plugins
//     plugins: {}
    
//   });