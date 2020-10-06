@extends('backend.layouts.master')
@section('title')
    Quản lí danh mục
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
                <h2 class="section-title">Danh sách các danh mục</h2>

                <div class="row">

                    <div class="col-12">
                        <div class="card">

                            <div class="card-body">

                                <div class="table-responsive">

                                    <a class="btn btn-success" id="addCategory" style="margin-bottom: 2%">
                                        <i class="fa fa-plus"> </i> Thêm mới</a>
                                    <table class="table table-striped" id="listCategory">
                                        <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Tên danh mục</th>
                                            <th>Danh mục chứa</th>
                                            <th>Mô tả</th>
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


    <div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Tạo mới một danh mục</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form  id="formAddCategory">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">Tên danh mục<abbr title="Required">*</abbr></label>
                                <input type="text" class="form-control name_category_at_form_create" placeholder="Nhập tên danh mục ..." name="name" id="name" required>
                                <p style="color: red" class="error errorName"></p>
                            </div>

                            <div class="form-group">
                                <label for="parent_id">Danh mục chứa</label>
                                <select name="parent_id" class="form-control parent_id_category_at_form_create" id="parent_id">
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="descriptions">Mô tả</label>
                                <textarea type="text" class="form-control " placeholder="Nhập mô tả cho danh mục ..." name="descriptions" id="descriptions"></textarea>
                                <p style="color: red" class="error errorDescription"></p>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" id="btnSubmitAddCategory">Tạo mới</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Chỉnh sửa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form  id="formEditCategory">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">Tên danh mục<abbr title="Required">*</abbr></label>
                                <input type="text" class="form-control name_category_at_form_create" placeholder="Nhập tên danh mục ..." name="name" id="name_edit" required>
                                <p style="color: red" class="error errorName"></p>
                            </div>

                            <div class="form-group">
                                <label for="parent_id">Danh mục chứa</label>
                                <select name="parent_id" class="form-control parent_id_category_at_form_create" id="parent_id_edit">
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="descriptions">Mô tả</label>
                                <textarea type="text" class="form-control " placeholder="Nhập mô tả cho danh mục ..." name="descriptions" id="descriptions_edit"></textarea>
                                <p style="color: red" class="error errorDescription"></p>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" id="btnSubmitEditCategory">Cập nhật</button>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script src="{{asset('backend/assets/javascript/category.js')}}"></script>

@endsection
