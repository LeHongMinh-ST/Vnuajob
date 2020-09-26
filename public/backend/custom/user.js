$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

var userTable = $('#userTable').DataTable({
    processing: true,
    serverSide: true,
    searching: true,
    destroy: true,
    responsive: true,
    ajax: {
        url: '/admin/users/get-data',
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
        {data: 'name', name: 'user.name' , orderable: false,},
        {data: 'title', name: 'user.title' , orderable: false,},
        {data: 'email', name: 'user.email',orderable: false,},
        {data: 'phone', name: 'user.phone', orderable: false,},
        {data: 'is_active', name: 'is_active', orderable: false, searchable: false},
        {data: 'action', name: 'action', orderable: false, searchable: false},
    ]
});

$('#formAddUser').validate({
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

$('#formEditUser').validate({
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

$('#btnAddUser').click(function () {
    $('#formAddUser')[0].reset();
    $('#formAddUser').validate().resetForm();
    $('#addUserModal').modal('show');
});

$('#btnSubmitFormUser').click(function (e) {
    e.preventDefault();
    if(!$('#formAddUser').valid()) return false;

    let data = $('#formAddUser').serialize();

    $.ajax({
        type: 'post',
        url: '/admin/users/store',
        data:data,
        success: function (res) {
            if(!res.error){
                userTable.ajax.reload();
                $('#addUserModal').modal('hide');
                toastr.success(res.message)
            }else {
                toastr.error(res.message)
            }
        }
    })
})

$('#userTable').on('change','.switcher-input',function(){
    let id = $(this).attr('data-id');
    $.ajax({
        type:'put',
        url:'/admin/users/change-status/'+id,
        success:function(res){
            if(!res.error){
                toastr.success(res.message);
            }else{
                toastr.error(res.message);
            }
        }
    });
})


$('#userTable').on('click','.btn-edit',function(e){
    e.preventDefault();
    $('#formEditUser').validate().resetForm();
    let id = $(this).attr('data-id');

    $.ajax({
        type:'get',
        url :'/admin/users/'+id+'/edit',
        success:function(res){
            if(!res.error){
                $('#edit_name').val(res.user.name);
                $('#edit_email').val(res.user.email);
                $('#edit_title').val(res.user.title);
                $('#edit_phone').val(res.user.phone);
                $('#formEditUser').attr('data-id',res.user.id);
                $('#editUserModal').modal('show');
            }
        }
    })

});

$('#btnEditFormUser').click(function (e) {
    e.preventDefault();
    if(!$('#formEditUser').valid()) return false;
    let id = $('#formEditUser').attr('data-id');
    let data = $('#formEditUser').serialize();

    $.ajax({
        type: 'put',
        url: '/admin/users/update/'+id,
        data:data,
        success: function (res) {
            if(!res.error){
                userTable.ajax.reload();
                $('#editUserModal').modal('hide');
                toastr.success(res.message)
            }else {
                toastr.error(res.message)
            }
        }
    })
})

$('#userTable').on('click','.btn-delete',function(e){
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
                url:'/admin/users/delete/'+id,
                success:function(res){
                    if(!res.error){
                        userTable.ajax.reload();
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
