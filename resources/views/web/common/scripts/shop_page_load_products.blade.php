
<script type="text/javascript">
// window.onload = function() {
    jQuery(function(){
        jQuery("#sortbytype").on('change', function(){
   alert("Works");
 })
  
});
// });
    
}
//Display grid/list 3 Column
jQuery(document).ready(function () {

    //sortbytype
    // document.getElementById('sortbytype').addEventListener('change',function(){
    //     alert(1234);
    //     jQuery("#load_products_form").submit();

    // });

//sortbylimit
    // document.getElementById('sortbylimit').addEventListener('change',function(){
    //     jQuery("#load_products_form").submit();

    // });

    jQuery('#sortbytype').on('change', function() {
        alert(1234);
        jQuery("#load_products_form").submit();
    });

    jQuery('#list').on('click', function(){
        
        jQuery( '#swap .col-12' ).removeClass( 'griding' );
        // jQuery( '#swap .col-12' ).removeClass( 'col-lg-3' );
        // jQuery( '#swap .col-12' ).removeClass( 'col-md-6' );
        jQuery( '#swap .col-12' ).addClass( 'listing' );
        jQuery( this ).addClass( 'active' );
        jQuery( '#grid' ).removeClass( 'active' );
        <?php foreach($result['products']['product_data'] as $key=>$products){ ?>

        jQuery( '#cart_button<?php echo $products->products_id; ?>' ).show();
        jQuery( '#view_button<?php echo $products->products_id; ?>' ).show();
        jQuery( '#added_button<?php echo $products->products_id; ?>' ).show();
        jQuery( '#cart_button2<?php echo $products->products_id; ?>' ).show();
        jQuery( '#view_button2<?php echo $products->products_id; ?>' ).show();
        jQuery( '#added_button2<?php echo $products->products_id; ?>' ).show();
        jQuery( '#out_button<?php echo $products->products_id; ?>' ).show();

        <?php }?>
    });
    jQuery('#grid').on('click', function(){
        jQuery( '#swap .col-12' ).removeClass( 'listing' );
        // jQuery( '#swap .col-12' ).addClass( 'col-lg-3' );
        // jQuery( '#swap .col-12' ).addClass( 'col-md-6' );

        jQuery( '#swap .col-12' ).addClass( 'griding' );
        jQuery( this ).addClass( 'active' );
        jQuery( '#list' ).removeClass( 'active' );
        <?php foreach($result['products']['product_data'] as $key=>$products){ ?>

        jQuery( '#cart_button<?php echo $products->products_id; ?>' ).hide();
        jQuery( '#view_button<?php echo $products->products_id; ?>' ).hide();
        jQuery( '#added_button<?php echo $products->products_id; ?>' ).hide();
        jQuery( '#cart_button2<?php echo $products->products_id; ?>' ).hide();
        jQuery( '#view_button2<?php echo $products->products_id; ?>' ).hide();
        jQuery( '#added_button2<?php echo $products->products_id; ?>' ).hide();
        jQuery( '#out_button<?php echo $products->products_id; ?>' ).hide();

        <?php }?>


    });
});

</script>
