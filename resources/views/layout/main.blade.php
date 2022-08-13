<!DOCTYPE html>
<html>

<head>
    @include('layout.head')
</head>

<body>
    <div class="main-wrapper" id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader">
            <div class="loader">
                <div class="loader__figure"></div>
                <p class="loader__label">Company Name</p>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->

        <!-- layout/header.blade.php -->
        @include('layout.header')

        <!-- layout/sidebar.blade.php -->
        @include('layout.sidebar')

        <!-- ============================================================== -->
        <!-- Page wrapper scss in scafholding.scss -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Title and breadcrumb -->
            <!-- ============================================================== -->
            <div class="page-titles">
                <div class="d-flex align-items-center">
                    <h5 class="font-medium m-b-0">{{ $menu }}</h5>
                    <div class="custom-breadcrumb ml-auto">
                        <a class="breadcrumb">Home</a>
                        <a href="/{{ request()->path() }}" class="breadcrumb">{{ $menu }}</a>
                    </div>
                </div>
            </div>

            @yield('main-page')

            <!-- ============================================================== -->
            <!-- Container fluid scss in scafholding.scss -->
            <!-- ============================================================== -->
            {{-- <footer class="center-align m-b-30 fixed">All Rights Reserved by Materialart. Designed and Developed by <a href="https://wrappixel.com">WrapPixel</a>.</footer> --}}

        </div>
        <!-- ============================================================== -->
        <!-- Page wrapper scss in scafholding.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->

    </div>

    @include('layout.footer')
</body>

</html>
