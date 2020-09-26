$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('#company_id').select2({
    placeholder:'Chọn công ty',
    width:'100%'
});

$('#edit_company_id').select2({
    placeholder:'Chọn công ty',
    width:'100%'
})

var employerTable = $('#employerTable').DataTable({
    processing: true,
    serverSide: true,
    searching: true,
    destroy: true,
    responsive: true,
    ajax: {
        url: '/admin/employers/get-data',
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
        {data: 'name', name: 'employer.name' , orderable: false,},
        {data: 'title', name: 'employer.title' , orderable: false,},
        {data: 'email', name: 'employer.email',orderable: false,},
        {data: 'phone', name: 'employer.phone', orderable: false,},
        {data: 'company_id', name: 'employer.company', orderable: false,},
        {data: 'is_active', name: 'is_active', orderable: false, searchable: false},
        {data: 'action', name: 'action', orderable: false, searchable: false},
    ]
});


$('#formAddEmployer').validate({
    rules:{
        name:{
            required:true,
        },
        email:{
            required:true,
        },
        phone:{

        },
        title:{
            required:true,
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

        },
        title:{
            required:'Vui lòng nhập chức vụ',
        }
    }
})

$('#formEditEmployer').validate({
    rules:{
        name:{
            required:true,
        },
        email:{
            required:true,
        },
        phone:{

        },
        title:{
            required:true,
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

        },
        title:{
            required:'Vui lòng nhập chức vụ',
        }
    }
})

$('#btnAddEmployer').click(function () {
    $('#formAddEmployer')[0].reset();
    $('#formAddEmployer').validate().resetForm();
    $('#addEmployerModal').modal('show');
});

$('#btnSubmitFormEmployer').click(function (e) {
    e.preventDefault();
    if(!$('#formAddEmployer').valid()) return false;

    let data = $('#formAddEmployer').serialize();

    $.ajax({
        type: 'post',
        url: '/admin/employers/store',
        data:data,
        success: function (res) {
            if(!res.error){
                employerTable.ajax.reload();
                $('#addEmployerModal').modal('hide');
                toastr.success(res.message)
            }else {
                toastr.error(res.message)
            }
        }
    })
})

$('#employerTable').on('change','.switcher-input',function(){
    let id = $(this).attr('data-id');
    $.ajax({
        type:'put',
        url:'/admin/employers/change-status/'+id,
        success:function(res){
            if(!res.error){
                toastr.success(res.message);
            }else{
                toastr.error(res.message);
            }
        }
    });
})

$('#employerTable').on('click','.btn-edit',function(e){
    e.preventDefault();
    $('#formEditEmployer').validate().resetForm();
    let id = $(this).attr('data-id');

    $.ajax({
        type:'get',
        url :'/admin/employers/'+id+'/edit',
        success:function(res){
            if(!res.error){
                $('#edit_name').val(res.employer.name);
                $('#edit_email').val(res.employer.email);
                $('#edit_title').val(res.employer.title);
                $('#edit_phone').val(res.employer.phone);
                $('#edit_company_id').select2().val(res.employer.company_id).trigger('change');
                $('#formEditEmployer').attr('data-id',res.employer.id);
                $('#editEmployerModal').modal('show');
            }
        }
    })

});

$('#btnEditFormEmployer').click(function (e) {
    e.preventDefault();
    if(!$('#formEditEmployer').valid()) return false;
    let id = $('#formEditEmployer').attr('data-id');
    let data = $('#formEditEmployer').serialize();

    $.ajax({
        type: 'put',
        url: '/admin/employers/update/'+id,
        data:data,
        success: function (res) {
            if(!res.error){
                employerTable.ajax.reload();
                $('#editEmployerModal').modal('hide');
                toastr.success(res.message)
            }else {
                toastr.error(res.message)
            }
        }
    })
})

$('#employerTable').on('click','.btn-delete',function(e){
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
                url:'/admin/employers/delete/'+id,
                success:function(res){
                    if(!res.error){
                        employerTable.ajax.reload();
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
