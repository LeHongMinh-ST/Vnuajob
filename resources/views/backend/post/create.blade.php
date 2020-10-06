@extends('backend.layouts.master')
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="{{asset('backend/custom/post.js')}}"></script>
@endsection
@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>
    <style>
        .error{
            color: red;
        }
        .day{
            border: 0.5px solid #e0d8d8;
        }

        .select2-selection__rendered {
            line-height: 32px !important;
        }

        .select2-selection {
            height: 34px !important;
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
                    <h1 class="page-title"> Đăng bài tuyển dụng </h1>

                </header><!-- /.page-title-bar -->
                <!-- .page-section -->
                <div class="page-section">
                    <!-- .card -->
                    <div class="card card-fluid">
                        <!-- .card-body -->
                        <div class="card-body">
                            <form id="formAddPostEmployer">
                                <!-- .fieldset -->
                                <fieldset>
                                    <div class="form-group">
                                        <label for="title">Tiêu đề</label> <input type="text" class="form-control" id="title" name="title" aria-describedby="tf1Help" placeholder="Nhập vào tiêu đề">
                                    </div><!-- /.form-group -->

                                    <div class="form-group">
                                        <label for="category_id">Danh mục</label>
                                        <select name="category_id" id="category_id" class="form-control">
                                            <option value=""></option>
                                            @forelse($list_category as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @empty

                                            @endforelse
                                        </select>
                                    </div>
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
                                        <div class="form-group col-3">
                                            <label for="date_public">Ngày tuyển dụng</label>
                                            <input type="text" class="form-control" id="date_public" name="date_public"  placeholder="Nhập vào ngày tuyển dụng">
                                        </div><!-- /.form-group -->

                                        <div class="form-group col-3">
                                            <label for="deadline">Hạn nộp hồ sơ</label>
                                            <input type="text" class="form-control" id="deadline" name="deadline"  placeholder="Nhập vào hạn nộp hồ sơ">
                                        </div><!-- /.form-group -->

                                        <div class="form-group col-3">
                                            <label for="vacancy">Số lượng tuyển dụng</label>
                                            <input type="number" class="form-control" id="vacancy" name="vacancy"  placeholder="Nhập vào số lượng tuyển dụng">
                                        </div><!-- /.form-group -->

                                        <div class="form-group col-3">
                                            <label for="job_nature">Loại hình công việc</label>
                                            <select name="job_nature" id="job_nature" class="form-control">
                                                <option value=""></option>
                                                <option value="3">Linh động</option>
                                                <option value="2">Full time</option>
                                                <option value="1">Part time</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="form-group col-4">
                                            <label for="salary">Mức lương</label>
                                            <input type="text" class="form-control" id="salary" name="salary"  placeholder="Nhập vào mức lương (vd: 10-15 triệu)">
                                        </div><!-- /.form-group -->


                                        <div class="form-group col-4">
                                            <div class="row">
                                                <label for="salart_start">Mức lương tối thiểu</label>
                                                <input type="text" class="form-control col-10" id="salart_start" name="salart_start"  placeholder="Mức lương tối thiểu bằng số (vd: 10.000.000)" onChange="format_curency(this);">
                                                <span class="col-2" style="padding-top: 10px;">VNĐ</span>
                                            </div>
                                        </div><!-- /.form-group -->

                                        <div class="form-group col-4">
                                            <div class="row">
                                                <label for="salart_end">Mức lương tối đa</label>
                                                <input type="text" class="form-control col-10" id="salart_end" name="salart_end"  placeholder="Mức lương tối đa bằng số (vd: 10.000.000)" onChange="format_curency(this);">
                                                <span class="col-2" style="padding-top: 10px;">VNĐ</span>
                                            </div>
                                        </div><!-- /.form-group -->
                                    </div>



                                    <div class="row">
                                        <div class="form-group col-5">
                                            <label for="company_id">Chọn công ty</label>
                                            <select name="company_id" id="company_id" class="form-control">
                                                <option value=""></option>
                                                @forelse($companies as $company)
                                                    <option value="{{$company->id}}">{{$company->name}}</option>
                                                @empty

                                                @endforelse
                                            </select>
                                        </div>

                                        <div class="form-group col-4">
                                            <label for="location">Địa chỉ nơi làm việc</label>
                                            <input type="text" class="form-control" id="location" name="location"  placeholder="Nhập vào địa chỉ cụ thể">
                                        </div><!-- /.form-group -->

                                        <div class="form-group col-3">
                                            <label for="position">Chức vụ</label>
                                            <input type="text" class="form-control" id="position" name="position"  placeholder="Nhập vào chức vụ">
                                        </div><!-- /.form-group -->

                                    </div>
                                    <h5>Yêu cầu:</h5>
                                    <div class="row">

                                        <div class="form-group col-3">
                                            <label for="request_degree">Bằng cấp</label>
                                            <select name="request_degree" id="request_degree" class="form-control">
                                                <option value=""></option>
                                                <option value="1">Có</option>
                                                <option value="0">Không</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-3">
                                            <label for="request_old">Độ tuổi</label>
                                            <input type="text" name="request_old" id="request_old" class="form-control"  placeholder="Nhập vào độ tuổi">
                                        </div>

                                        <div class="form-group col-3">
                                            <label for="request_experience">Kinh nghiệm</label>
                                            <select name="request_experience" id="request_experience" class="form-control">
                                                <option value=""></option>
                                                <option value="1">Có</option>
                                                <option value="0">Không</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-3">
                                            <label for="request_sex">Giới tính</label>
                                            <select name="request_sex" id="request_sex" class="form-control">
                                                <option value=""></option>
                                                <option value="0">Không yêu cầu</option>
                                                <option value="1">Nam</option>
                                                <option value="2">Nữ</option>
                                            </select>
                                        </div>
                                    </div>
                                </fieldset><!-- /.fieldset -->
                                <button type="submit" class="btn btn-primary" id="btnSubmitFormPostEmployer">Tạo mới</button>
                            </form>
                        </div><!-- /.card-body -->
                    </div><!-- /.card -->
                </div><!-- /.page-section -->
            </div><!-- /.page-inner -->
        </div><!-- /.page -->
    </div>
@endsection


