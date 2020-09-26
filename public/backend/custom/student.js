$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$('#facuty_id').select2({
    placeholder:'Chọn khoa',
    width:'100%'
});

$('#edit_facuty_id').select2({
    placeholder:'Chọn khoa',
    width:'100%'
})

var studentTable = $('#studentTable').DataTable({
    processing: true,
    serverSide: true,
    searching: true,
    destroy: true,
    responsive: true,
    ajax: {
        url: '/admin/students/get-data',
    },

    language: {
        sProcessing: "Đang xử lý...",
        sLengthMenu: "Xem _MENU_ mục",
        sZeroRecords: "Không tìm thấy dòng nào phù hợp",
        sInfo: "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
        sInfoEmpty: "Đang xem 0 đến 0 trong tổng số 0 mục",
        sInfoFiltered: "(được lọc từ _MAX_ mục)",
        sSearch: 'Tìm kiếm',
        lengthMenu: '_MENU_ bản ghi/trang',
        oPaginate: {
            "sFirst": "Đầu",
            "sPrevious": "Trước",
            "sNext": "Tiếp",
            "sLast": "Cuối"
        }
    },
    columns: [
        {data: 'DT_RowIndex', searchable: false, orderable: false,},
        {data: 'name', name: 'student.name' , orderable: false,},
        {data: 'student_code', name: 'student_code.title' , orderable: false,},
        {data: 'email', name: 'student.email',orderable: false,},
        {data: 'phone', name: 'student.phone', orderable: false,},
        {data: 'home_town', name: 'student.phone', orderable: false,},
        {data: 'class', name: 'student.class', orderable: false,},
        {data: 'facuty_id', name: 'student.facuty_id', orderable: false,},
        {data: 'status', name: 'student.status', orderable: false,},
        {data: 'is_active', name: 'is_active', orderable: false, searchable: false},
        {data: 'action', name: 'action', orderable: false, searchable: false},
    ]
});

$('#formEditStudent').validate({
    rules:{
        name:{
            required:true,
        },
        email:{
            required:true,
        },
        phone:{

        }
    },
    messages:{
        name:{
            required:'Vui lòng nhập họ và tên',
        },
        email:{
            required:'Vui lòng nhập email',
        },
        phone:{

        }
    }
})

$('#btnAddStudent').click(function () {
    $('#formAddStudent')[0].reset();
    $('#formAddStudent').validate().resetForm();
    $('#addStudentModal').modal('show');
});

$('#btnSubmitFormStudent').click(function (e) {
    e.preventDefault();
    if(!$('#formAddStudent').valid()) return false;

    let data = $('#formAddStudent').serialize();

    $.ajax({
        type: 'post',
        url: '/admin/students/store',
        data:data,
        success: function (res) {
            if(!res.error){
                studentTable.ajax.reload();
                $('#addStudentModal').modal('hide');
                toastr.success(res.message)
            }else {
                toastr.error(res.message)
            }
        }
    })
})

$('#studentTable').on('change','.switcher-input',function(){
    let id = $(this).attr('data-id');
    $.ajax({
        type:'put',
        url:'/admin/students/change-status/'+id,
        success:function(res){
            if(!res.error){
                toastr.success(res.message);
            }else{
                toastr.error(res.message);
            }
        }
    });
})

$('#studentTable').on('click','.btn-edit',function(e){
    e.preventDefault();
    $('#formEditStudent').validate().resetForm();
    let id = $(this).attr('data-id');

    $.ajax({
        type:'get',
        url :'/admin/students/'+id+'/edit',
        success:function(res){
            if(!res.error){
                $('#edit_name').val(res.student.name);
                $('#edit_email').val(res.student.email);
                $('#edit_student_code').val(res.student.student_code);
                $('#edit_phone').val(res.student.phone);
                $('#edit_class').val(res.student.class);
                $('#edit_home_town').val(res.student.home_town);
                $('#edit_facuty_id').select2().val(res.student.facuty_id).trigger('change');
                $('#formEditStudent').attr('data-id',res.student.id);
                $('#editStudentModal').modal('show');
            }
        }
    })

});

$('#btnEditFormStudent').click(function (e) {
    e.preventDefault();
    if(!$('#formEditStudent').valid()) return false;
    let id = $('#formEditStudent').attr('data-id');
    let data = $('#formEditStudent').serialize();

    $.ajax({
        type: 'put',
        url: '/admin/students/update/'+id,
        data:data,
        success: function (res) {
            if(!res.error){
                studentTable.ajax.reload();
                $('#editStudentModal').modal('hide');
                toastr.success(res.message)
            }else {
                toastr.error(res.message)
            }
        }
    })
})

$('#studentTable').on('click','.btn-delete',function(e){
    e.preventDefault();
    let id = $(this).attr('data-id');
    Swal.fire({
        title: 'Bạn có chắc chắn muốn xóa ?',
        text: "Dữ liệu không thể phục hồi!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Đồng ý!',
        cancelButtonText: 'Đóng'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type:'delete',
                url:'/admin/students/delete/'+id,
                success:function(res){
                    if(!res.error){
                        studentTable.ajax.reload();
                        toastr.success(res.message)
                    }else{
                        toastr.error(res.message)
                    }
                }
            })
        }else{
            toastr.info('Bạn đã đóng hành động!');
        }
    })
});
