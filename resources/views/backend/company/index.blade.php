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

                                    <a class="btn btn-success" id="addCompany" style="margin-bottom: 2%">
                                        <i class="fa fa-plus"> </i> Thêm mới</a>
                                    <table class="table table-striped" id="listCompany">
                                        <thead>
                                        <tr>
                                            <th> STT</th>
                                            <th>Tên công ty</th>
                                            <th>Email</th>
                                            <th>Số điện thoại</th>
                                            <th>Địa chỉ</th>
                                            <th>Logo</th>
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

    <div class="modal fade" id="addCompanyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Tạo mới công ty</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formAddCompany" enctype="multipart/form-data">
                        <!-- .fieldset -->
                        <fieldset>
                            <div class="form-group">
                                <label for="company_name">Tên công ty<abbr title="Required">*</abbr></label> <input type="text" class="form-control" name="name" id="company_name" placeholder="Nhập vào tên công ty" >
                            </div><!-- /.form-group -->

                            <div class="form-group">
                                <label for="company_email">Email<abbr title="Required">*</abbr></label> <input type="email" class="form-control" name="email" id="company_email" placeholder="Nhập vào email công ty" >
                            </div><!-- /.form-group -->

                            <div class="form-group">
                                <label for="company_phone">Số điện thoại<abbr title="Required">*</abbr></label> <input type="text" class="form-control" name="phone" id="company_phone" placeholder="Nhập vào số điện thoại công ty" >
                            </div>

                            <div class="form-group">
                                <label for="company_website">Website<abbr title="Required">*</abbr></label> <input type="text" class="form-control" name="website" id="company_website" placeholder="Nhập vào website công ty" >
                            </div>

                            <div class="form-group">
                                <label for="company_address">Địa chỉ<abbr title="Required">*</abbr></label> <input type="text" class="form-control" name="address" id="company_address" placeholder="Nhập vào địa chỉ công ty" >
                            </div>
                            <div class="form-group">
                                <label for="company_descriptions">Mô tả<abbr title="Required">*</abbr></label> <textarea name="descriptions" class="form-control" id="company_descriptions" rows="5"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="lbl1">Chọn logo<abbr title="Required">*</abbr></label>
                                <div class="custom-file">
                                <span class="btn-file">
                                    <input type="file" name="file" class="custom-file-input" id="fileupload-customInput"> <label class="custom-file-label" for="fileupload-customInput">Choose file</label>
                                </span>
                                </div>
                                <div>
                                    <img id='preview' style="width: 100%"/>
                                </div>
                            </div><!-- /.form-group -->
                            <!-- .form-group -->
                        </fieldset><!-- /.fieldset -->
                    </form><!-- /.form -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" id="btnSubmitAddCompany">Tạo mới</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editCompanyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Tạo mới công ty</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formEditCompany" enctype="multipart/form-data">
                        <!-- .fieldset -->
                        <fieldset>
                            <div class="form-group">
                                <label for="company_name">Tên công ty<abbr title="Required">*</abbr></label> <input type="text" class="form-control" name="name" id="company_name_edit" placeholder="Nhập vào tên công ty" >
                            </div><!-- /.form-group -->

                            <div class="form-group">
                                <label for="company_email">Email<abbr title="Required">*</abbr></label> <input type="email" class="form-control" name="email" id="company_email_edit" placeholder="Nhập vào email công ty" >
                            </div><!-- /.form-group -->

                            <div class="form-group">
                                <label for="company_phone">Số điện thoại<abbr title="Required">*</abbr></label> <input type="text" class="form-control" name="phone" id="company_phone_edit" placeholder="Nhập vào số điện thoại công ty" >
                            </div>

                            <div class="form-group">
                                <label for="company_website">Website<abbr title="Required">*</abbr></label> <input type="text" class="form-control" name="website" id="company_website_edit" placeholder="Nhập vào website công ty" >
                            </div>

                            <div class="form-group">
                                <label for="company_address">Địa chỉ<abbr title="Required">*</abbr></label> <input type="text" class="form-control" name="address" id="company_address_edit" placeholder="Nhập vào địa chỉ công ty" >
                            </div>
                            <div class="form-group">
                                <label for="company_descriptions">Mô tả<abbr title="Required">*</abbr></label> <textarea name="descriptions" class="form-control" id="company_descriptions_edit" rows="5"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="lbl1">Chọn logo<abbr title="Required">*</abbr></label>
                                <div class="custom-file">
                                <span class="btn-file">
                                    <input type="file" name="file" class="custom-file-input" id="fileupload-customInput_edit"> <label class="custom-file-label" for="fileupload-customInput">Choose file</label>
                                </span>
                                </div>
                                <div>
                                    <img id='edit_preview' style="width: 100%"/>
                                </div>
                            </div><!-- /.form-group -->
                            <!-- .form-group -->
                        </fieldset><!-- /.fieldset -->
                    </form><!-- /.form -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" id="btnSubmitEditCompany">Cập nhật</button>
                </div>
            </div>
        </div>
    </div>



@endsection
@section('scripts')
    <script src="{{asset('backend/assets/javascript/company.js')}}"></script>
@endsection
