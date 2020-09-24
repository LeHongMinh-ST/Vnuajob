<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"><!-- End Required meta tags -->
    <!-- Begin SEO tag -->
    <title> Đăng kí | Tuyển dụng</title>
    <meta property="og:title" content="Sign Up">
    <meta name="author" content="Beni Arisandi">
    <meta property="og:locale" content="en_US">
    <meta name="description" content="Responsive admin theme build on top of Bootstrap 4">
    <meta property="og:description" content="Responsive admin theme build on top of Bootstrap 4">
    <link rel="canonical" href="https://uselooper.com">
    <meta property="og:url" content="https://uselooper.com">
    <meta property="og:site_name" content="Looper - Bootstrap 4 Admin Theme">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script type="application/ld+json">
      {
        "name": "Looper - Bootstrap 4 Admin Theme",
        "description": "Responsive admin theme build on top of Bootstrap 4",
        "author":
        {
          "@type": "Person",
          "name": "Beni Arisandi"
        },
        "@type": "WebSite",
        "url": "",
        "headline": "Sign Up",
        "@context": "http://schema.org"
      }
    </script><!-- End SEO tag -->
    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="144x144" href="{{asset('backend')}}/assets/apple-touch-icon.png">
    <link rel="shortcut icon" href="{{asset('backend')}}/assets/favicon.ico">
    <meta name="theme-color" content="#3063A0"><!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Fira+Sans:400,500,600" rel="stylesheet"><!-- End Google font -->
    <!-- BEGIN PLUGINS STYLES -->
    <link rel="stylesheet" href="{{asset('backend')}}/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css"><!-- END PLUGINS STYLES -->
    <!-- BEGIN THEME STYLES -->
    <link rel="stylesheet" href="{{asset('backend')}}/assets/stylesheets/theme.min.css" data-skin="default">
    <link rel="stylesheet" href="{{asset('backend')}}/assets/stylesheets/theme-dark.min.css" data-skin="dark">
    <link rel="stylesheet" href="{{asset('backend')}}/assets/stylesheets/custom.css">
    <script>
        var skin = localStorage.getItem('skin') || 'default';
        var isCompact = JSON.parse(localStorage.getItem('hasCompactMenu'));
        var disabledSkinStylesheet = document.querySelector('link[data-skin]:not([data-skin="' + skin + '"])');
        // Disable unused skin immediately
        disabledSkinStylesheet.setAttribute('rel', '');
        disabledSkinStylesheet.setAttribute('disabled', true);
        // add flag class to html immediately
        if (isCompact == true) document.querySelector('html').classList.add('preparing-compact-menu');
    </script><!-- END THEME STYLES -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
    <style>
        .error{
            color: red;
        }
    </style>
</head>
<body>
<!--[if lt IE 10]>
<div class="page-message" role="alert">You are using an <strong>outdated</strong> browser. Please <a class="alert-link" href="http://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</div>
<![endif]-->
<!-- .auth -->
<main class="auth">
    <header id="auth-header" class="auth-header" style="background-image: url({{asset('backend')}}/assets/images/illustration/img-1.png);">
        <h1>
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="64" viewbox="0 0 351 100">
                <defs>
                    <path id="a" d="M156.538 45.644v1.04a6.347 6.347 0 0 1-1.847 3.98L127.708 77.67a6.338 6.338 0 0 1-3.862 1.839h-1.272a6.34 6.34 0 0 1-3.862-1.839L91.728 50.664a6.353 6.353 0 0 1 0-9l9.11-9.117-2.136-2.138a3.171 3.171 0 0 0-4.498 0L80.711 43.913a3.177 3.177 0 0 0-.043 4.453l-.002.003.048.047 24.733 24.754-4.497 4.5a6.339 6.339 0 0 1-3.863 1.84h-1.27a6.337 6.337 0 0 1-3.863-1.84L64.971 50.665a6.353 6.353 0 0 1 0-9l26.983-27.008a6.336 6.336 0 0 1 4.498-1.869c1.626 0 3.252.622 4.498 1.87l26.986 27.006a6.353 6.353 0 0 1 0 9l-9.11 9.117 2.136 2.138a3.171 3.171 0 0 0 4.498 0l13.49-13.504a3.177 3.177 0 0 0 .046-4.453l.002-.002-.047-.048-24.737-24.754 4.498-4.5a6.344 6.344 0 0 1 8.996 0l26.983 27.006a6.347 6.347 0 0 1 1.847 3.98zm-46.707-4.095l-2.362 2.364a3.178 3.178 0 0 0 0 4.501l2.362 2.364 2.361-2.364a3.178 3.178 0 0 0 0-4.501l-2.361-2.364z"></path>
                </defs>
                <g fill="none" fill-rule="evenodd">
                    <path fill="currentColor" fill-rule="nonzero" d="M39.252 80.385c-13.817 0-21.06-8.915-21.06-22.955V13.862H.81V.936h33.762V58.1c0 6.797 4.346 9.026 9.026 9.026 2.563 0 5.237-.446 8.58-1.783l3.677 12.034c-5.794 1.894-9.694 3.009-16.603 3.009zM164.213 99.55V23.78h13.372l1.225 5.571h.335c4.457-4.011 10.585-6.908 16.491-6.908 13.817 0 22.174 11.031 22.174 28.08 0 18.943-11.588 29.863-23.957 29.863-4.903 0-9.694-2.117-13.594-6.017h-.446l.78 9.025V99.55h-16.38zm25.852-32.537c6.128 0 10.92-4.903 10.92-16.268 0-9.917-3.232-14.932-10.14-14.932-3.566 0-6.797 1.56-10.252 5.126v22.397c3.12 2.674 6.686 3.677 9.472 3.677zm69.643 13.372c-17.272 0-30.643-10.586-30.643-28.972 0-18.163 13.928-28.971 28.748-28.971 17.049 0 26.075 11.477 26.075 26.52 0 3.008-.558 6.017-.78 7.354h-37.663c1.56 8.023 7.465 11.589 16.491 11.589 5.014 0 9.36-1.337 14.263-3.9l5.46 9.917c-6.351 4.011-14.597 6.463-21.951 6.463zm-1.338-45.463c-6.462 0-11.031 3.454-12.702 10.363h23.622c-.78-6.797-4.568-10.363-10.92-10.363zm44.238 44.126V23.779h13.371l1.337 12.034h.334c5.46-9.025 13.595-13.371 22.398-13.371 4.902 0 7.465.78 10.697 2.228l-3.343 13.706c-3.454-1.003-5.683-1.56-9.806-1.56-6.797 0-13.928 3.566-18.608 13.483v28.749h-16.38z"></path>
                    <use class="fill-warning" xlink:href="#a"></use>
                </g>
            </svg> <span class="sr-only">Sign Up</span>
        </h1>
        <p> Already have an account? please <a href="{{route('employers.login')}}">Đăng nhập</a>
        </p>
    </header><!-- form -->
    <form class="auth-form" id="formRegister" action="{{route('employers.registerProcess')}}" method="post">
        @csrf
        <!-- .form-group -->
        <div class="form-group">
            <div class="form-label-group" id="validate-name">
                <input type="email" id="email" class="form-control" name="email" placeholder="Email" required="" autofocus=""> <label for="email">Email</label>
            </div>
        </div><!-- /.form-group -->
        <!-- .form-group -->
        <div class="form-group">
            <div class="form-label-group" id="validate-name">
                <input type="text" id="name" name="name" class="form-control" placeholder="Họ và tên" > <label for="name">Họ tên</label>
            </div>
        </div><!-- /.form-group -->
        <!-- .form-group -->
        <div class="form-group">
            <div class="form-label-group" id="validate-password">
                <input type="password" id="password" name="password" class="form-control" placeholder="Password"  name="password"> <label for="password">Mật khẩu</label>
            </div>
        </div><!-- /.form-group -->

        <div class="form-group">
            <div class="form-label-group" id="validate-password_confirmation">
                <input type="password" id="password_confirmation" class="form-control" placeholder="Password" name="password_confirmation"> <label for="password_confirmation">Nhập lại mật khẩu</label>
            </div>
        </div>

        <div class="form-group">
            <div class="form-label-group" id="validate-company_id">
                <select name="company_id" id="company_id" class="form-control">
                    <option value=""></option>
                    @forelse($companies as $company)
                    <option value="{{$company->id}}">{{$company->name}}</option>
                    @empty

                    @endforelse
                </select>
            </div>
        </div>
        <p class="text-center text-muted"> Nếu không tìm thấy công ty hãy<a href="#" id="addCompany"> tạo mới!</a>. </p><!-- /.form-group -->
        <!-- .form-group -->
        <div class="form-group">
            <button class="btn btn-lg btn-primary btn-block" for="formRegister" type="submit">Đăng kí</button>
        </div><!-- /.form-group -->
        <!-- .form-group -->
        <div class="form-group text-center">
            <div class="custom-control custom-control-inline custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="newsletter"> <label class="custom-control-label" for="newsletter">Sign me up for the newsletter</label>
            </div>
        </div><!-- /.form-group -->
        <!-- recovery links -->
        <p class="text-center text-muted mb-0"> By creating an account you agree to the <a href="#">Terms of Use</a> and <a href="#">Privacy Policy</a>. </p><!-- /recovery links -->
    </form><!-- /.auth-form -->
    <!-- copyright -->
    <footer class="auth-footer"> © 2018 All Rights Reserved. </footer>

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
</main><!-- /.auth -->
<!-- BEGIN BASE JS -->
<script src="{{asset('backend')}}/assets/vendor/jquery/jquery.min.js"></script>
<script src="{{asset('backend')}}/assets/vendor/popper.js/umd/popper.min.js"></script>
<script src="{{asset('backend')}}/assets/vendor/bootstrap/js/bootstrap.min.js"></script> <!-- END BASE JS -->
<!-- BEGIN PLUGINS JS -->
<script src="{{asset('backend')}}/assets/vendor/particles.js/particles.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script type="text/javascript"src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    /**
     * Keep in mind that your scripts may not always be executed after the theme is completely ready,
     * you might need to observe the `theme:load` event to make sure your scripts are executed after the theme is ready.
     */
    $(document).on('theme:init', () =>
    {
        /* particlesJS.load(@dom-id, @path-json, @callback (optional)); */
        particlesJS.load('auth-header', '{{asset('backend')}}/assets/javascript/pages/particles.json');
    })
    $('#company_id').select2({
        placeholder:'Chọn công ty',
    });

    $('#formRegister').validate({
        rules:{
            name:{
                required:true
            },
            email:{
                required:true,
                email:true
            },
            password:{
                required:true,
                minlength : 8,
            },
            password_confirm : {
                minlength : 8,
                equalTo : "#password"
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
            password:{
                required:'Vui lòng nhập mật khẩu',
                minlength:'Mật khẩu ít nhất 8 kí tự',
            }

        },
        errorPlacement: function(error, element) {
            let id = element.attr('id');
            error.insertAfter($('#validate-'+id));
        },
    });

    $('#formRegister').on('submit',function (e) {
        e.preventDefault();

        if(!$('#formRegister').valid()){
            return false;
        }else{
            $('#formRegister')[0].submit();
        }
    })

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
                    let option = {
                        id: res.company.id,
                        text: res.company.name
                    };

                    let newOption = new Option(option.text, option.id, false, false);
                    $('#company_id').append(newOption).trigger('change');
                    $('#company_id').select2().val(res.company.id).trigger('change');
                    $('#addCompanyModal').modal('hide');

                    toastr.success(res.message);
                }else{
                    toastr.error(res.message);
                }
            }
        })
    })

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
</script> <!-- END PLUGINS JS -->
<!-- BEGIN THEME JS -->
<script src="{{asset('backend')}}/assets/javascript/theme.min.js"></script> <!-- END THEME JS -->
</body>
</html>
