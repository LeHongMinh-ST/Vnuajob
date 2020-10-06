jQuery( document ).ready(function( $ ) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#parent_id').select2({
        placeholder:'Chọn danh mục cha',
    });

    function css() {
        console.log('css');
        $('#listCategory_wrapper').addClass('main_table');
        $('#listCategory_paginate').addClass('pagination');
    }

    function dataTable() {
        var table = $('#listCategory').DataTable({
            processing: true,
            serverSide: true,
            searching: true,
            destroy: true,
            responsive: true,
            ajax: {
                url: 'category/getData',
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
                {data: 'DT_RowIndex', searchable: false},
                {data: 'name', name: 'name'},
                {data: 'parent', name: 'parent'},
                {data: 'descriptions', name: 'category.descriptions'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
        css();
    }

    dataTable();

    $('#formAddCompany').validate({
        rules:{
            name:{
                required:true
            },
            email:{
                required:true,
                email:true
            },
            phone:{
                required:true,
            },
            website:{
                required:true,
                url:true
            },
            address:{
                required:true,
            },
            file:{
                required:true,
            }

        },
        messages:{
            name:{
                required:'Vui lòng nhập tên công ty',
            },
            email:{
                required:'Vui lòng nhập email công ty',
                email:'Vui lòng nhập đúng định dạng email'
            },
            phone:{
                required:'Vui lòng nhập số điện thoại',
            },
            website:{
                required:'Vui lòng nhập website công ty',
                url:'Vui lòng nhập đúng định dạng website'
            },
            address:{
                required:'Vui lòng nhập địa chỉ công ty',
            },
            // file:{
            //     required:'Vui lòng chọn logo công ty',
            // }
        },
    })
    $('#formEditCompany').validate({
        rules:{
            name:{
                required:true
            },
            email:{
                required:true,
                email:true
            },
            phone:{
                required:true,
            },
            website:{
                required:true,
                url:true
            },
            address:{
                required:true,
            },
            // file:{
            //     required:true,
            // }

        },
        messages:{
            name:{
                required:'Vui lòng nhập tên công ty',
            },
            email:{
                required:'Vui lòng nhập email công ty',
                email:'Vui lòng nhập đúng định dạng email'
            },
            phone:{
                required:'Vui lòng nhập số điện thoại',
            },
            website:{
                required:'Vui lòng nhập website công ty',
                url:'Vui lòng nhập đúng định dạng website'
            },
            address:{
                required:'Vui lòng nhập địa chỉ công ty',
            },
            // file:{
            //     required:'Vui lòng chọn logo công ty',
            // }
        },
    })

    $('#addCategory').click(function (e) {
        e.preventDefault();

        $.ajax({
            url: 'category/create',
            type: 'get',
            success: function (response) {
                console.log(response)
                $('#formAddCategory')[0].reset();
                $('#parent_id').html(response.options);
                $('#addCategoryModal').modal('show');
            }
        })
    })

    $('#btnSubmitAddCategory').click(function () {
        // if(!$('#formAddCompany').valid()) return false;
        let formData = new FormData($('#formAddCategory')[0]);
        $.ajax({
            type:'post',
            url: 'category/store',
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formData,
            success: function (res) {
                if (!res.error) {
                    $('#listCategory').DataTable().ajax.reload();
                    $('#addCategoryModal').modal('hide');

                    toastr.success(res.message);
                }else{
                    toastr.error(res.message);
                }
            }
        })
    })



    $('#listCategory').on('click','.btn-edit', function (e) {
        e.preventDefault();
        let id= $(this).attr('data-id');
        $.ajax({
            url: 'category/'+id+'/edit',
            type: 'get',
            success: function(res){
                $('#name_edit').val(res.category.name);
                $('#description_edit').val(res.category.descriptions);
                $('#description_edit').val(res.category.descriptions);
                $('#parent_id_edit').html(res.options);
                $('#btnSubmitEditCategory').attr('data-id', id);
                $('#editCategoryModal').modal('show');
            }
        })

    })
    $('#btnSubmitEditCategory').click(function () {
        let id = $(this).attr('data-id');
        console.log(1)
        // if(!$('#formEditCompany').valid()) return false;
        let formData = new FormData($('#formEditCategory')[0]);
        $.ajax({
            type:'post',
            url: 'category/update/' + id,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formData,
            success: function (res) {
                if (!res.error) {
                    console.log(3)
                    $('#listCategory').DataTable().ajax.reload();
                    $('#editCategoryModal').modal('hide');
                    toastr.success(res.message);
                }else{
                    console.log(4)
                    toastr.error(res.message);
                }
            }
        })
    })

    $('#listCategory').on('click', '.btn-delete', function (event) {
        event.preventDefault();
        let id = $(this).attr('data-id');

        Swal.fire({
            title: 'Xóa danh mục này?',
            text: "Danh mục này có thể có các danh mục phụ thuộc. Bạn có chắc chắn muốn xóa danh mục này! Dữ liệu không thể khôi phục",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Đồng ý!',
            cancelButtonText: 'Đóng'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'delete',
                    url: 'category/destroy/' + id,
                    success: function (response) {
                        if(!response.error)
                        {
                            $('#listCategory').DataTable().ajax.reload();
                            toastr.success('Bạn đã xóa thành công');
                        }

                    }
                });
            }
        })
    });

})
