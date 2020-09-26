@extends('backend.layouts.master')
@section('title')
    Quản lí khoa
@endsection
@section('css')
    <style>
        .table-responsive a{
            color: white !important;
        }
    </style>
@endsection
@section('contents')

    <div class="main-content">
        <div class="section">
            <div class="section-body">
                <h2 class="section-title">Danh sách các khoa</h2>

                <div class="row">

                    <div class="col-12">
                        <div class="card">

                            <div class="card-body">

                                <div class="table-responsive">

                                    <a class="btn btn-success" id="btn-create" style="margin-bottom: 2%">
                                        <i class="fa fa-plus"> </i> Thêm mới</a>
                                    <table class="table table-striped" id="listFacuty">
                                        <thead>
                                        <tr>
                                            <th>
                                                STT
                                            </th>
                                            <th>
                                                Mã khoa
                                            </th>

                                            <th>Tên Khoa</th>
                                            <th>Số sinh viên đang quản lí</th>
                                            <th>Mô tả ngắn</th>
                                            <th>Hành động</th>

                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
{{--@endsection--}}
{{--@section('modal')--}}

    <div class="modal fade" id="modal-create">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Điền vào thông tin khoa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frm-create" >
                        <div class="form-group">
                            <div class="has-clearable" id="validate-name">
                                <label >Mã khoa <abbr title="Bắt buộc">*</abbr></label>
                                <input type="text" class="form-control placeholder-shown" name="facuty_code" placeholder="Mã khoa" value="" id="facuty_code">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class=" has-clearable" id="validate-email">
                                <label >Tên khoa <abbr title="Bắt buộc">*</abbr></label>
                                <input type="text" class="form-control placeholder-shown" value="" placeholder="Tên khoa" name="name" id="name">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class=" has-clearable" id="validate-email">
                                <label >Mô tả ngắn</label>
                                <textarea type="text" class="form-control placeholder-shown" value="" placeholder="Mô tả" name="description" id="description"></textarea>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary modal__btn--dismiss" data-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" id="frmCreate-submit">Thêm</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-edit">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Điền vào thông tin khoa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frm-edit" >
                        <div class="form-group">
                            <div class="has-clearable" id="validate-name">
                                <label >Mã khoa <abbr title="Bắt buộc">*</abbr></label>
                                <input type="text" class="form-control placeholder-shown" name="facuty_code" placeholder="Mã khoa" value="" id="facuty_code_edit">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class=" has-clearable" id="validate-email">
                                <label >Tên khoa <abbr title="Bắt buộc">*</abbr></label>
                                <input type="text" class="form-control placeholder-shown" value="" placeholder="Tên khoa" name="name" id="name_edit">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class=" has-clearable" id="validate-email">
                                <label >Mô tả ngắn</label>
                                <textarea type="text" class="form-control placeholder-shown" value="" placeholder="Mô tả" name="descriptions" id="description_edit"></textarea>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary modal__btn--dismiss" data-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" id="frmEdit-submit">Cập nhật</button>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('scripts')
    <script src="{{asset('backend/assets/javascript/facuty.js')}}"></script>
@endsection
