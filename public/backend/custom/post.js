$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('#date_public').datepicker();
$('#deadline').datepicker();

$('#descriptions').summernote();
$('#content').summernote();

$('#job_nature').select2({
    placeholder:"Chọn loại hình công việc"
});
$('#company_id').select2({
    placeholder:"Chọn công ty"
});
function format_curency(a) {
    a.value = a.value.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
}

$('#btnAddPost').click(function () {
    $('#addPostModal').modal('show');
});
$('#company_id').on('change', function (e) {
    e.preventDefault();
    let id = $(this).val();
    $.ajax({
        url: 'get-address/'+id,
        type: 'post',
        success: function (res) {
            $('#location').val(res.address);
        }
    })
})

