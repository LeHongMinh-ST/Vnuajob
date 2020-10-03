$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('#date_public').datepicker();
$('#descriptions').summernote();
$('#content').summernote();

$('#btnAddPost').click(function () {
    // $('#formAddPost')[0].reset();
    // $('#formAddPost').validate().resetForm();
    $('#addPostModal').modal('show');
});



