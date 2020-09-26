jQuery( document ).ready(function( $ ) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function css() {
        console.log('css');
        $('#listCompany_wrapper').addClass('main_table');
        $('#listCompany_paginate').addClass('pagination');
    }

    function dataTable() {
        var table = $('#listCompany').DataTable({
            processing: true,
            serverSide: true,
            searching: true,
            destroy: true,
            responsive: true,
            ajax: {
                url: '/admin/company/getData',
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
                {data: 'name', name: 'company.name'},
                {data: 'email', name: 'company.email'},
                {data: 'phone', name: 'company.phone'},
                {data: 'address', name: 'company.address'},
                {data: 'logo', name: 'logo'},
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
            file:{
                required:'Vui lòng chọn logo công ty',
            }
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
            file:{
                required:'Vui lòng chọn logo công ty',
            }
        },
    })

    $('#addCompany').click(function (e) {
        e.preventDefault();
        $('#formAddCompany')[0].reset();
        $('#formAddCompany').validate().resetForm();
        $('#preview').attr('src',null);
        $('#addCompanyModal').modal('show');
    })

    $('#btnSubmitAddCompany').click(function () {
        if(!$('#formAddCompany').valid()) return false;
        let formData = new FormData($('#formAddCompany')[0]);
        $.ajax({
            type:'post',
            url: '/employers/companies/store',
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formData,
            success: function (res) {
                if (!res.error) {
                    $('#listCompany').DataTable().ajax.reload();
                    $('#addCompanyModal').modal('hide');

                    toastr.success(res.message);
                }else{
                    toastr.error(res.message);
                }
            }
        })
    })



    $('#listCompany').on('click','.btn-edit', function (e) {
        e.preventDefault();
        let id= $(this).attr('data-id');
        $.ajax({
            url: 'company/'+id+'/edit',
            type: 'get',
            success: function(res){
                console.log(res);
                $('#company_name_edit').val(res.company.name);
                $('#company_email_edit').val(res.company.email);
                $('#company_phone_edit').val(res.company.phone);
                $('#company_website_edit').val(res.company.website);
                $('#company_address_edit').val(res.company.address);
                $('#company_descriptions_edit').val(res.company.descriptions);
                $('#edit_preview').attr('src','/storage/'+res.company.logo);
                $('#btnSubmitEditCompany').attr('data-id', id)
                $('#editCompanyModal').modal('show');
            }
        })

    })
    $('#btnSubmitEditCompany').click(function () {
        let id = $(this).attr('data-id');
        if(!$('#formEditCompany').valid()) return false;
        let formData = new FormData($('#formEditCompany')[0]);
        $.ajax({
            type:'post',
            url: '/employers/company/update/' + id,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formData,
            success: function (res) {
                if (!res.error) {
                    $('#listCompany').DataTable().ajax.reload();
                    $('#editCompanyModal').modal('hide');
                    toastr.success(res.message);
                }else{
                    toastr.error(res.message);
                }
            }
        })
    })

    $('#listCompany').on('click', '.btn-delete', function (event) {
        event.preventDefault();
        let id = $(this).attr('data-id');

        Swal.fire({
            title: 'Xóa Công ty này?',
            text: "Bạn có chắc chắn muốn xóa Công ty này! Dữ liệu không thể khôi phục",
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
                    url: 'company/destroy/' + id,
                    success: function (response) {
                        $('#listCompany').DataTable().ajax.reload();
                        toastr.success('Bạn đã xóa thành công công ty ' + response.name);
                    }
                });
            }
        })
    });

    $(document).on("click", ".btn-file", function() {
        var file = $(this).parents().find(".file");
        file.trigger("click");
    });

    $('input[type="file"]').change(function(e) {
        var fileName = e.target.files[0].name;
        $("#file").val(fileName);

        var reader = new FileReader();
        reader.onload = function(e) {
            // get loaded data and render thumbnail.
            document.getElementById("preview").src = e.target.result;
            document.getElementById("edit_preview").src = e.target.result;
        };
        // read the image file as a data URL.
        reader.readAsDataURL(this.files[0]);
    });
})
