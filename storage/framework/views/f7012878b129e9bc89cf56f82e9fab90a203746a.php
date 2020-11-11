<script>
function myFunction1(lang_id) {
    jQuery.post('<?php echo e(URL::to("/change_language")); ?>', {
        _token: "<?php echo e(csrf_token()); ?>",
        "languages_id":lang_id
    }).done(  function (result) {
        window.location.reload()
    }).fail( function (err) {
        console.log(err);
    });
}
</script>
<?php /**PATH /Users/fkhan/Projects/freelance/zahee/resources/views/web/common/scripts/changeLanguage.blade.php ENDPATH**/ ?>