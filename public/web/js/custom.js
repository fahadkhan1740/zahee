(function($) {
    'use strict';

})(jQuery)

//AOS.init();

jQuery(window).on('load', function() {
    jQuery(".loader").delay(1500).fadeOut("slow");
})
jQuery(document).ready(function() {
    // setTimeout(function() {
    //     $("body,html").removeClass("loader-body");
    // }, 2000);


    jQuery(".h-slick").slick({
        dots: false,
        vertical: false,
        centerMode: false,
        slidesToShow: 1,
        slidesToScroll: 1
    });




    // upload file
    jQuery('.file[type="file"]').change(function(){
        //here we take the file extension and set an array of valid extensions
            var res= jQuery('#fileup').val();
            var arr = res.split("\\");
            var filename=arr.slice(-1)[0];
            filextension=filename.split(".");
            filext="."+filextension.slice(-1)[0];
            valid=[".avi",".mov ",".mkv ",".mp4",".avchp",".flv",".swf"];
        //if file is not valid we show the error icon, the red alert, and hide the submit button
            if (valid.indexOf(filext.toLowerCase())==-1){
                jQuery( ".imgupload" ).hide("slow");
                jQuery( ".imgupload.ok" ).hide("slow");
                jQuery( ".imgupload.stop" ).show("slow");

                jQuery('.namefile').css({"color":"red","font-weight":700});
                jQuery('.namefile').html("File "+filename+" is not  video!");
                jQuery('#btnup').html('Change Video');
                jQuery('.namefile').addClass('after-no');
                jQuery( "#submitbtn" ).hide();
                jQuery( "#fakebtn" ).show();
            }else{
                //if file is valid we show the green alert and show the valid submit
                jQuery( ".imgupload" ).hide("slow");
                jQuery( ".imgupload.stop" ).hide("slow");
                jQuery( ".imgupload.ok" ).show("slow");

                jQuery('.namefile').css({"color":"green","font-weight":700});
                jQuery('.namefile').addClass('after-no');
                jQuery('.namefile').html(filename);
                jQuery('#btnup').html('Change Video');


                jQuery( "#submitbtn" ).show();
                jQuery( "#fakebtn" ).hide();
            }
        });

})

var btn = jQuery('#top_arrow');

jQuery(window).scroll(function() {
    if (jQuery(window).scrollTop() > 100) {
        btn.addClass('show');
    } else {
        btn.removeClass('show');
    }
});

btn.on('click', function(e) {
    e.preventDefault();
    jQuery('html, body').animate({ scrollTop: 0 }, '300');
});



jQuery('#search-btnn').click(function() {
    jQuery('#search-window').toggleClass('active');
});
jQuery('#close-search').click(function() {
    jQuery('#search-window').removeClass('active');
});


//  Product upload

jQuery(document).ready(function() {

    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                jQuery('.profile-pic').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    jQuery(".file-upload").on('change', function() {
        readURL(this);
    });

    jQuery(".upload-button").on('click', function() {
        jQuery(".file-upload").click();
    });



// cart card payment

    jQuery("input[type=radio]").change(function(){
   
   if ( jQuery('input#card-payment[type=radio]').is(":checked") ){
       jQuery('#card-payment-data').show();
    }
   else
   {
       jQuery('#card-payment-data').hide();
   }
 });


// cart card payment


    jQuery(".custom_radio_tab input[type=radio]").change(function(){

    if ( jQuery('.custom_radio_tab input#tab-1[type=radio]').is(":checked") ){

        jQuery('div#tab-1').show();
        jQuery('div#tab-2').hide();
     }
    else
    {
        jQuery('div#tab-1').hide();
        jQuery('div#tab-2').show();
    }
  });
 





    // slider 

    jQuery('.variable-slider.categories-slider').slick({
        dots: false,
        infinite: false,
        speed: 1000,
        slidesToShow: 9,
        slidesToScroll: 1,
        rewind:true,
        autoplay: true,
        autoplaySpeed: 3000
    });


    jQuery('.product-slider').slick({
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


jQuery('.pro-full-slider').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    fade: false,
    asNavFor: '.pro-thubnail-slider'
  });
jQuery('.pro-thubnail-slider').slick({
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
var navbarHeight = jQuery('header').outerHeight();

jQuery(window).scroll(function(event) {
    didScroll = true;
});

setInterval(function() {
    if (didScroll) {
        hasScrolled();
        didScroll = false;
    }
}, 250);

function hasScrolled() {
    var st = jQuery(this).scrollTop();

    if (Math.abs(lastScrollTop - st) <= delta)
        return;
    if (st < 150) {
        jQuery('header').removeClass('nav-background');
    } else {
        jQuery('navbar').addClass('nav-background');
    }
    if (st > lastScrollTop && st > navbarHeight) {

        jQuery('header').removeClass('nav-down').addClass('nav-up');
    } else {

        if (st + jQuery(window).height() < jQuery(document).height()) {
            jQuery('header').removeClass('nav-up').addClass('nav-down');
        }
    }
    lastScrollTop = st;
}


// select flag

// $(function() {
//     $('.selectpicker').selectpicker();
// });



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
            jQuery('#imagePreview').css('background-image', 'url('+e.target.result +')');
            jQuery('#imagePreview').hide();
            jQuery('#imagePreview').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
jQuery("#imageUpload").change(function() {
    readURL(this);
});




// timer

jQuery( document ).ready(function() {
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

    jQuery('.action-wrap  .view-btnn').each(function(){
        jQuery(this).click(function(){
            jQuery(this).parents('.post-list-wraper').hide();
            jQuery('.product-detail-wrraper').show();
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
