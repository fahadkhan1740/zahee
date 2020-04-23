<script>
function myFunction1(lang_id) {
    jQuery.post('{{ URL::to("/change_language")}}', {
        _token: "{{ csrf_token() }}",
        "languages_id":lang_id
    }).done(  function (result) {
        window.location.reload()
    }).fail( function (err) {
        console.log(err);
    });
{{-- jQuery(function ($) {--}}
{{--  jQuery.ajax({--}}
{{--    beforeSend: function (xhr) { // Add this line--}}
{{--            xhr.setRequestHeader('X-CSRF-Token', $('[name="_csrfToken"]').val());--}}
{{--     },--}}
{{--    url: '{{ URL::to("/change_language")}}',--}}
{{--    type: "POST",--}}
{{--    data: {"languages_id":lang_id,"_token": "{{ csrf_token() }}"},--}}
{{--    success: function (res) {--}}
{{--        alert(res);--}}
{{--      window.location.reload();--}}
{{--    },--}}
{{--  });--}}
{{--});--}}
}
</script>
