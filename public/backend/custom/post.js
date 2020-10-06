$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// $('#date_public').datepicker({});
flatpickr("#deadline", {});
flatpickr("#date_public", {});


$('#descriptions').summernote();
$('#content').summernote();

$('#job_nature').select2({
    placeholder:"Chọn loại hình công việc",
    width:'100%'
});
$('#company_id').select2({
    placeholder:"Chọn công ty",
    width:'100%'
});

$('#category_id').select2({
    placeholder:"Chọn danh mục bài viết",
    width:'100%'
});

$('#request_degree').select2({
    minimumResultsForSearch: Infinity,
    placeholder:"Chọn yêu cầu",
    width:'100%'
});

$('#request_experience').select2({
    minimumResultsForSearch: Infinity,
    placeholder:"Chọn yêu cầu",
    width:'100%'
});
$('#request_sex').select2({
    minimumResultsForSearch: Infinity,
    placeholder:"Chọn yêu cầu",
    width:'100%'
});

flatpickr("#edit_deadline", {});
flatpickr("#edit_date_public", {});

$('#edit_descriptions').summernote();
$('#edit_content').summernote();

$('#edit_job_nature').select2({
    placeholder:"Chọn loại hình công việc",
    width:'100%'
});
$('#edit_company_id').select2({
    placeholder:"Chọn công ty",
    width:'100%'
});

$('#edit_category_id').select2({
    placeholder:"Chọn danh mục bài viết",
    width:'100%'
});

$('#edit_request_degree').select2({
    minimumResultsForSearch: Infinity,
    placeholder:"Chọn yêu cầu",
    width:'100%'
});

$('#edit_request_experience').select2({
    minimumResultsForSearch: Infinity,
    placeholder:"Chọn yêu cầu",
    width:'100%'
});
$('#edit_request_sex').select2({
    minimumResultsForSearch: Infinity,
    placeholder:"Chọn yêu cầu",
    width:'100%'
});

var postTable = $('#postTable').DataTable({
    processing: true,
    serverSide: true,
    searching: true,
    destroy: true,
    responsive: true,
    ajax: {
        url: '/admin/post/get-data',
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
        {data: 'title', name: 'post.title' , orderable: false,},
        {data: 'date_public', name: 'post.date_public',orderable: false,},
        {data: 'job_nature', name: 'post.job_nature', orderable: false,},
        {data: 'vacancy', name: 'post.vacancy',orderable: false,},
        {data: 'salary', name: 'post.salary', orderable: false,},
        {data: 'company_id', name: 'post.company_id',orderable: false,},
        {data: 'status', name: 'post.status', orderable: false,},
        {data: 'is_active', name: 'is_active', orderable: false, searchable: false},
        {data: 'action', name: 'action', orderable: false, searchable: false},
    ]
});

$('#formAddPost').validate({
    rules: {
        "title" : {
            required:true ,
        },
        "category_id" : {
            required:true ,
        },
        "descriptions" : {
            required:true ,
        },
        "content" : {
            required:true ,
        },
        "date_public" : {
            required:true ,
        },
        "deadline" : {
            required:true ,
        },
        "vacancy" : {
            required:true ,
        },
        "job_nature" : {
            required:true ,
        },
        "salary" : {
            required:true ,
        },
        "salart_start" : {
            required:true ,
        },
        "salart_end" : {
            required:true ,
        },
        "position" : {
            required:true ,
        },
        "company_id" : {
            required:true ,
        },
        "location" : {
            required:true ,
        },
        "request_degree" : {
            required:true ,
        },
        "request_old" : {
            required:true ,
        },
        "request_experience" : {
            required:true ,
        },
        "request_sex" : {
            required:true ,
        },
    }

})

$('#formEditPost').validate({
    rules: {
        "title" : {
            required:true ,
        },
        "category_id" : {
            required:true ,
        },
        "descriptions" : {
            required:true ,
        },
        "content" : {
            required:true ,
        },
        "date_public" : {
            required:true ,
        },
        "deadline" : {
            required:true ,
        },
        "vacancy" : {
            required:true ,
        },
        "job_nature" : {
            required:true ,
        },
        "salary" : {
            required:true ,
        },
        "salart_start" : {
            required:true ,
        },
        "salart_end" : {
            required:true ,
        },
        "position" : {
            required:true ,
        },
        "company_id" : {
            required:true ,
        },
        "location" : {
            required:true ,
        },
        "request_degree" : {
            required:true ,
        },
        "request_old" : {
            required:true ,
        },
        "request_experience" : {
            required:true ,
        },
        "request_sex" : {
            required:true ,
        },
    }

})

function format_curency(a) {
    a.value = a.value.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
}

$('#btnAddPost').click(function () {
    $('#formAddPost')[0].reset();
    $('#formAddPost').validate().resetForm();
    $('#addPostModal').modal('show');
});

$('#btnSubmitFormPost').click(function (e){
    e.preventDefault();

    if(!$('#formAddPost').valid()) return false;
    let data = $('#formAddPost').serialize();

    $.ajax({
        type:'post',
        url:'/admin/post/store',
        data:data,
        success: function (res){
            if(!res.error){

                postTable.ajax.reload();
                $('#addPostModal').modal('hide');
                toastr.success(res.message);
            }else{
                toastr.error(res.message);
            }
        }
    })
})

$('#btnEditFormPost').click(function (e){
    e.preventDefault();
    if(!$('#formEditPost').valid()) return false;
    let id = $('#formEditPost').attr('data-id');
    let data = $('#formEditPost').serialize();

    $.ajax({
        type:'put',
        url:'/admin/post/update/'+id,
        data:data,
        success: function (res){
            if(!res.error){
                postTable.ajax.reload();
                $('#editPostModal').modal('hide');
                toastr.success(res.message);
            }else{
                toastr.error(res.message);
            }
        }
    })
})

$('#postTable').on('click','.btn-edit',function (e){
    e.preventDefault();
    $('#formEditPost')[0].reset();
    $('#formEditPost').validate().resetForm();
    let id = $(this).attr('data-id');
    $.ajax({
        type:'get',
        url:'/admin/post/'+id+'/edit',
        success:function (res){
            if(!res.error){
                $('#edit_title').val(res.post.title);
                $('#edit_descriptions').val(res.post.descriptions);
                $('#edit_content').val(res.post.content);
                $('#edit_date_public').val(res.post.date_public);
                $('#edit_vacancy').val(res.post.vacancy);
                $('#edit_salary').val(res.post.salary);
                $('#edit_location').val(res.post.location);
                $('#edit_job_nature').val(res.post.job_nature);
                $('#edit_company_id').val(res.post.company_id).trigger('change');
                $('#edit_deadline').val(res.post.deadline);
                $('#edit_category_id').val(res.post.category_id).trigger('change');
                $('#edit_salart_start').val(res.post.salart_start);
                $('#edit_salart_end').val(res.post.salart_end);
                $('#edit_request_degree').val(res.post.request_degree).trigger('change');
                $('#edit_request_old').val(res.post.request_old).trigger('change');
                $('#edit_request_experience').val(res.post.request_experience).trigger('change');
                $('#edit_request_sex').val(res.post.request_sex).trigger('change');
                $('#edit_position').val(res.post.position);
                $('#formEditPost').attr('data-id',id);
            }
        }
    });

    $('#editPostModal').modal('show');
})

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

$('#postTable').on('click','.btn-delete',function(e){
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
                url:'/admin/post/delete/'+id,
                success:function(res){
                    if(!res.error){
                        postTable.ajax.reload();
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

$('#postTable').on('change','.switcher-input',function(){
    let id = $(this).attr('data-id');
    $.ajax({
        type:'put',
        url:'/admin/post/change-status/'+id,
        success:function(res){
            if(!res.error){
                toastr.success(res.message);
            }else{
                toastr.error(res.message);
            }
        }
    });
})

