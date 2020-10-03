<header>
    <div class="header-area ">
        <div id="sticky-header" class="main-header-area">
            <div class="container-fluid ">
                <div class="header_bottom_border">
                    <div class="row align-items-center">
                        <div class="col-xl-3 col-lg-2">
                            <div class="logo">
                                <a href="/">
                                    <img src="{{asset('frontend')}}/img/logo_vcms.png" alt="" style="width: 30%;">
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-7">
                            <div class="main-menu  d-none d-lg-block">
                                <nav>
                                    <ul id="navigation">
                                        <li><a href="/">Trang chủ</a></li>
                                        <li><a href="/">Giới thiệu</a></li>
                                        <li><a href="#">Danh sách việc làm</a></li>
                                        <li><a href="#">Công ty hàng đầu</a></li>
                                        <li><a href="#">Liên hệ</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 d-none d-lg-block">
                            <div class="Appointment">
                                <div class="phone_num d-none d-xl-block">
                                    <a href="{{route('login')}}">Đăng nhập</a>
                                </div>
                                <div class="d-none d-lg-block">
                                    <a class="boxed-btn3" href="{{route('employers.dashboard')}}">Tuyển dụng</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</header>
