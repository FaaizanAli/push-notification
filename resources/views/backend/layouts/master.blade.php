{{--<!DOCTYPE html>--}}
{{--<html lang="en" dir="ltr">--}}
{{--<head>--}}
{{--    <meta charset="UTF-8" />--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />--}}
{{--    @include('backend.layouts.style')--}}

{{--</head>--}}
{{--<body class="selection:bg-[#09365c] selection:text-white">--}}

{{--<!-- Header -->--}}
{{--@include('backend.layouts.header')--}}
{{--side bar--}}
{{--@include('backend.layouts.sidebar')--}}
{{--@include('backend.layouts.theme')--}}
{{--<!--/ content -->--}}
{{--@yield('content')--}}
{{--footer--}}
{{--@include('newlayouts.footer')--}}
{{--script--}}
{{--@include('backend.layouts.script')--}}
{{--</body>--}}

{{--</html>--}}

    <!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="X-UA-Compatible" content="IE=9" />

    @include('backend.layouts.style')


</head>

<body class="main-body app sidebar-mini">

<!-- Loader -->
<div id="global-loader">
    <img src="{{asset('backend/assets/img/loader.svg')}}" class="loader-img" alt="Loader">
</div>
<!-- /Loader -->

<!-- Page -->
<div class="page">

    @include('backend.layouts.sidebar')

    <!-- main-content -->



    <!-- main-content -->
    <div class="main-content app-content">

        <!-- main-header -->
        @include('backend.layouts.header')
        <!-- /main-header -->

        <!-- container -->
        @yield('content')
        <!-- /Container -->
    </div>
    <!-- /main-content -->

    <!-- /main-content -->

    <!-- Sidebar-right-->
    @include('backend.layouts.sidebar-right')
    <!--/Sidebar-right-->

    @include('backend.layouts.footer')

</div>
<!-- End Page -->

<!-- Back-to-top -->
<a href="#top" id="back-to-top"><i class="las la-angle-double-up"></i></a>




@include('backend.layouts.script')

</body>
</html>
