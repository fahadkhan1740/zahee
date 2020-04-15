<script>
function myFunction3(product_id) {
 jQuery(function ($) {
  jQuery.ajax({
    beforeSend: function (xhr) { // Add this line
            xhr.setRequestHeader('X-CSRF-Token', $('[name="_csrfToken"]').val());
     },
    url: '<?php echo e(URL::to("/addToCompare")); ?>',
    type: "POST",
    data: {"product_id":product_id,"_token": "<?php echo e(csrf_token()); ?>"},
    success: function (res) {
      var obj = JSON.parse(res);
      var message = obj.message;

      if(obj.success==0){
        jQuery('#alert-login-first').show();
        setTimeout(function() {
          jQuery('#alert-login-first').hide();
        }, 3000);
       $('#like_count').html(obj.total_likes);
       $('#wishlist_count').html(obj.total_likes);

     }else{
       jQuery('#alert-compare').show();
       setTimeout(function() {
         jQuery('#alert-compare').hide();
       }, 3000);
      $('#compare').html(res);
      message = "<?php echo app('translator')->get('website.Product is ready to compare!'); ?>";
      notification(message);
    }
    },
  });
});
}
</script>
<?php /**PATH /var/www/html/zaheeecomm/resources/views/web/common/scripts/addToCompare.blade.php ENDPATH**/ ?>