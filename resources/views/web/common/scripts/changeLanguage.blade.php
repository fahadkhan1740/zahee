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
}
</script>
