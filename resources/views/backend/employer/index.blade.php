@extends('backend.layouts.master')
@section('scripts')
    <script src="{{asset('backend/custom/employer.js')}}"></script>
@endsection
@section('css')
    <style>
        .error{
            color: red;
        }
    </style>
@endsection

@section('contents')
    <div class="wrapper">
        <!-- .page -->
        <div class="page">
            <!-- .page-inner -->
            <div class="page-inner">
                <!-- .page-title-bar -->
                <header class="page-title-bar">
                    <!-- .breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">
                                <a href="#"><i class="breadcrumb-icon fa fa-angle-left mr-2"></i>Tables</a>
                            </li>
                        </ol>
                    </nav><!-- /.breadcrumb -->
                    <!-- title -->
                    <h1 class="page-title"> Quản lý nhà tuyển dụng </h1>

                </header><!-- /.page-title-bar -->
                <!-- .page-section -->
                <div class="page-section">
                    <!-- .card -->
                    <div class="card card-fluid">
                        <div class="card-header">
                            <div>
                                <button class="btn btn-success" id="btnAddEmployer">Thêm mới</button>
                            </div>
                        </div>
                        <!-- .card-body -->
                        <div class="card-body">
                            <!-- .table -->
                            <div id="dt-responsive_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <div class="table-responsive">
                                    <table id="employerTable"
                                           class="table dt-responsive nowrap w-100 dataTable dtr-inline" role="grid"
                                           aria-describedby="dt-responsive_info">
                                        <thead>
                                        <tr role="row">
                                            <th>STT</th>
                                            <th>Họ và tên</th>
                                            <th>Chức vụ</th>
                                            <th>Email</th>
                                            <th>Số điện thoại</th>
                                            <th>Công ty</th>
                                            <th>Trạng thái</th>
                                            <th>Hành đống</th>
                                        </tr>
                                        </thead>
                                        <tfoot>
                                        </tfoot>
                                        <tbody>
                                        <tr class="odd">
                                            <td valign="top" colspan="6" class="dataTables_empty">Loading...</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div><!-- /.table -->
                        </div><!-- /.card-body -->
                    </div><!-- /.card -->
                </div><!-- /.page-section -->
            </div><!-- /.page-inner -->
        </div><!-- /.page -->
    </div>
@endsection

@section('modals')
    <div class="modal fade" id="addEmployerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Thêm mới</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formAddEmployer">
                        <!-- .fieldset -->
                        <fieldset>
                            <div class="form-group">
                                <label for="email">Email</label> <input type="email" class="form-control" id="email" name="email" aria-describedby="tf1Help" placeholder="Nhập vào email">
                            </div><!-- /.form-group -->
                            <!-- .form-group -->
                            <div class="form-group">
                                <label for="name">Họ và tên</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Nhập vào họ tên">
                            </div><!-- /.form-group -->

                            <div class="form-group">
                                <label for="title">Chức vụ</label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="Nhập vào chức vụ">
                            </div><!-- /.form-group -->

                            <div class="form-group">
                                <label for="phone">Số điện thoại</label>
                                <input type="text" class="form-control" id="phone" name="phone"  placeholder="Nhập vào số điện thoại">
                            </div><!-- /.form-group -->

                            <div class="form-group">
                                    <label for="company_id">Chọn công ti</label>
                                    <select name="company_id" id="company_id" class="form-control">
                                        <option value=""></option>
                                        @forelse($companies as $company)
                                            <option value="{{$company->id}}">{{$company->name}}</option>
                                        @empty

                                        @endforelse
                                    </select>
                            </div>

                        </fieldset><!-- /.fieldset -->
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" id="btnSubmitFormEmployer">Tạo mới</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editEmployerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Cập nhật</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formEditEmployer">
                        <!-- .fieldset -->
                        <fieldset>
                            <div class="form-group">
                                <label for="edit_email">Email</label> <input type="email" class="form-control" id="edit_email" name="email" aria-describedby="tf1Help" placeholder="Nhập vào email">
                            </div><!-- /.form-group -->
                            <!-- .form-group -->
                            <div class="form-group">
                                <label for="edit_name">Họ và tên</label>
                                <input type="text" class="form-control" id="edit_name" name="name" placeholder="Nhập vào họ tên">
                            </div><!-- /.form-group -->

                            <div class="form-group">
                                <label for="edit_title">Chức vụ</label>
                                <input type="text" class="form-control" id="edit_title" name="title" placeholder="Nhập vào chức vụ">
                            </div><!-- /.form-group -->

                            <div class="form-group">
                                <label for="edit_phone">Số điện thoại</label>
                                <input type="text" class="form-control" id="edit_phone" name="phone"  placeholder="Nhập vào số điện thoại">
                            </div><!-- /.form-group -->

                            <div class="form-group">
                                <label for="edit_company_id">Chọn công ti</label>
                                <select name="company_id" id="edit_company_id" class="form-control">
                                    <option value=""></option>
                                    @forelse($companies as $company)
                                        <option value="{{$company->id}}">{{$company->name}}</option>
                                    @empty

                                    @endforelse
                                </select>
                            </div>


                        </fieldset><!-- /.fieldset -->
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" id="btnEditFormEmployer">Lưu</button>
                </div>
            </div>
        </div>
    </div>
@endsection
