<!doctype html>
<html class="no-js" lang="zxx">

@include('frontend.includes.header')

<body>
    <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

    <!-- header-start -->
    @include('frontend.includes.main_header')
    <!-- header-end -->

    <!-- slider_area_start -->
    @yield('contents')


    @include('frontend.includes.footer')
</body>

</html>