jQuery( document ).ready(function( $ ) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function css() {
        console.log('css');
        $('#listFacuty_wrapper').addClass('main_table');
        $('#listFacuty_paginate').addClass('pagination');
    }

    function dataTable() {
        var table = $('#listFacuty').DataTable({
            processing: true,
            serverSide: true,
            searching: true,
            destroy: true,
            responsive: true,
            ajax: {
                url: '/admin/facuty/getData',
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
                {data: 'facuty_code', name: 'facuty.facuty_code'},
                {data: 'name', name: 'facuty.name'},
                {data: 'count_student', name: 'count_student'},
                {data: 'descriptions', name: 'facuty.descriptions'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
        css();
    }

    dataTable();

    $('#btn-create').on('click',function (e) {
        console.log('create');
        e.preventDefault();
        $('#frm-create')[0].reset();
        $('#modal-create').modal('show');
    })
    $('#frmCreate-submit').on('click',function(e){
        e.preventDefault();
        $.ajax({
            url: '/admin/facuty/store',
            method: 'post',
            data:{
                facuty_code: $('#facuty_code').val(),
                name: $('#name').val(),
                descriptions: $('#description').val()
            },
            success: function(res){
                if(res.error){
                    $('#modal-create').modal('hide');
                    $('#listFacuty').DataTable().ajax.reload();
                    toastr.success(res.message);
                }
            }
        })
    })

    $('#listFacuty').on('click','.btn-edit', function (e) {
        e.preventDefault();
        let id= $(this).attr('data-id');
        $.ajax({
            url: 'facuty/'+id+'/edit',
            type: 'get',
            success: function(res){
                console.log(res);
                $('#facuty_code_edit').val(res.facuty.facuty_code);
                $('#name_edit').val(res.facuty.name);
                $('#description_edit').val(res.facuty.descriptions);
                $('#frmEdit-submit').attr('data-id', id);
                $('#modal-edit').modal('show');
            }
        })

    })
    $('#frmEdit-submit').on('click',function(e){
        e.preventDefault();
        $.ajax({
            url: 'facuty/update/'+$(this).attr('data-id'),
            method: 'put',
            data:{
                facuty_code: $('#facuty_code_edit').val(),
                name: $('#name_edit').val(),
                descriptions: $('#description_edit').val()
            },
            success: function(res){
                if(res.error){
                    $('#modal-edit').modal('hide');
                    $('#listFacuty').DataTable().ajax.reload();
                    toastr.success(res.message);
                }
            }
        })
    })
    $('#listFacuty').on('click', '.btn-delete', function (event) {
        event.preventDefault();
        let id = $(this).attr('data-id');

        Swal.fire({
            title: 'Xóa khoa này?',
            text: "Bạn có chắc chắn muốn xóa khoa này! Dữ liệu không thể khôi phục",
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
                    url: 'facuty/destroy/' + id,
                    success: function (response) {
                        $('#listFacuty').DataTable().ajax.reload();
                        toastr.success('Bạn đã xóa thành công khoa ' + response.name);
                    }
                });
            }
        })
    });
})
