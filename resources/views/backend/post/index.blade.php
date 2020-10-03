@extends('backend.layouts.master')
@section('scripts')
    <script src="{{asset('backend/custom/post.js')}}"></script>
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
                    <h1 class="page-title"> Quản lý người dùng </h1>

                </header><!-- /.page-title-bar -->
                <!-- .page-section -->
                <div class="page-section">
                    <!-- .card -->
                    <div class="card card-fluid">
                        <div class="card-header">
                            <div>
                                <button class="btn btn-success" id="btnAddPost">Thêm mới</button>
                            </div>
                        </div>
                        <!-- .card-body -->
                        <div class="card-body">
                            <!-- .table -->
                            <div id="dt-responsive_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <div class="table-responsive">
                                    <table id="postTable"
                                           class="table dt-responsive nowrap w-100 dataTable dtr-inline" role="grid"
                                           aria-describedby="dt-responsive_info">
                                        <thead>
                                        <tr role="row">
                                            <th>STT</th>
                                            <th>Tiêu đề</th>
                                            <th>Ngày tuyển dụng</th>
                                            <th>Loại hình công việc</th>
                                            <th>Số lượng</th>
                                            <th>Mức lương</th>
                                            <th>Người đăng</th>
                                            <th>Công ty</th>
                                            <th>Trang thái tuyển dụng</th>
                                            <th>Trạng thái việc làm</th>
                                            <th>Trạng thái</th>
                                            <th>Hành động</th>
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
    <div class="modal fade" id="addPostModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Thêm mới</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formAddPost">
                        <!-- .fieldset -->
                        <fieldset>
                            <div class="form-group">
                                <label for="title">title</label> <input type="text" class="form-control" id="title" name="title" aria-describedby="tf1Help" placeholder="Nhập vào email">
                            </div><!-- /.form-group -->
                            <!-- .form-group -->
                            <div class="form-group">
                                <label for="descriptions">Mô tả</label>
                                <textarea name="descriptions" id="descriptions" rows="5" placeholder="Nhập vào mô tả"></textarea>
                            </div><!-- /.form-group -->

                            <div class="form-group">
                                <label for="content">Nội dung</label>
                                <textarea name="content" id="content" cols="30" rows="10" placeholder="Nhập vào mô tả"></textarea>
                            </div><!-- /.form-group -->

                            <div class="row">
                                <div class="form-group col-4">
                                    <label for="date_public">Ngày tuyển dụng</label>
                                    <input type="text" class="form-control" id="date_public" name="date_public"  placeholder="Nhập vào ngày tuyển dụng">
                                </div><!-- /.form-group -->

                                <div class="form-group col-4">
                                    <label for="vacancy">Số lượng tuyển dụng</label>
                                    <input type="number" class="form-control" id="vacancy" name="vacancy"  placeholder="Nhập vào số lượng tuyển dụng">
                                </div><!-- /.form-group -->

                                <div class="form-group col-4">
                                    <label for="salary">Mức lương</label>
                                    <input type="text" class="form-control" id="salary" name="salary"  placeholder="Nhập vào số lượng tuyển dụng">
                                </div><!-- /.form-group -->
                            </div>

                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="location">Địa chỉ nơi làm việc</label>
                                    <input type="text" class="form-control" id="location" name="location"  placeholder="Nhập vào lớp">
                                </div><!-- /.form-group -->

                                <div class="form-group col-6">
                                    <label for="job_nature">Loại hình công việc</label>
                                    <select name="job_nature" id="job_nature" class="form-control">
                                        <option value=""></option>
                                        <option value="1">Full time</option>
                                        <option value="1">Part time</option>

                                    </select>
                                </div>


                                <div class="form-group col-6">
                                    <label for="company_id">Chọn công ty</label>
                                    <select name="company_id" id="company_id" class="form-control">
                                        <option value=""></option>
                                        @forelse($companies as $company)
                                            <option value="{{$company->id}}">{{$company->name}}</option>
                                        @empty

                                        @endforelse
                                    </select>
                                </div>
                            </div>


                        </fieldset><!-- /.fieldset -->
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" id="btnSubmitFormPost">Tạo mới</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editPostModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Cập nhật</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formEditPost">
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
                                <label for="edit_student_code">Mã sinh viên</label>
                                <input type="text" class="form-control" id="edit_student_code" name="student_code" placeholder="Nhập vào chức vụ">
                            </div><!-- /.form-group -->

                            <div class="form-group">
                                <label for="edit_phone">Số điện thoại</label>
                                <input type="text" class="form-control" id="edit_phone" name="phone"  placeholder="Nhập vào số điện thoại">
                            </div><!-- /.form-group -->

                            <div class="form-group">
                                <label for="edit_home_town">Quê quán</label>
                                <input type="text" class="form-control" id="edit_home_town" name="home_town"  placeholder="Nhập vào số điện thoại">
                            </div><!-- /.form-group -->

                            <div class="form-group">
                                <label for="edit_class">Lớp</label>
                                <input type="text" class="form-control" id="edit_class" name="class"  placeholder="Nhập vào số điện thoại">
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
                    <button type="button" class="btn btn-primary" id="btnEditFormPost">Lưu</button>
                </div>
            </div>
        </div>
    </div>
@endsection
