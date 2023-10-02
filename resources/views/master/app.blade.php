<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>
        @isset($tittle)
            {{ $tittle }}
        @endisset
    </title>
    <meta name="description" content="Hound is a Dashboard & Admin Site Responsive Template by hencework." />
    <meta name="keywords"
        content="admin, admin dashboard, admin template, cms, crm, Hound Admin, Houndadmin, premium admin templates, responsive admin, sass, panel, software, ui, visualization, web app, application" />
    <meta name="author" content="hencework" />

    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Morris Charts CSS -->
    <link href="{{ asset('backend/vendors/bower_components/morris.js/morris.css') }}" rel="stylesheet"
        type="text/css" />
    {{--  <!-- Data table CSS -->  --}}
    <link href="{{ asset('backend/vendors/bower_components/datatables/media/css/jquery.dataTables.min.css') }}"
        rel="stylesheet" type="text/css" />

    <link href="{{ asset('backend/vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.css') }}"
        rel="stylesheet" type="text/css">

    <!-- Custom CSS -->
    <link href="{{ asset('backend/dist/css/style.css') }}" rel="stylesheet" type="text/css">
</head>

<body>
    <!-- Preloader -->
    <div class="preloader-it">
        <div class="la-anim-1"></div>
    </div>
    <!-- /Preloader -->
    <div class="wrapper theme-1-active pimary-color-red">
        {{--  <!-- Top Menu Items -->  --}}
        @include('master.inc.header')
        {{--  <!-- End Top Menu Items -->  --}}


        {{--  <!-- Left Sidebar Menu -->  --}}
        @include('master.inc.sidebar')
        {{--  <!-- /Left Sidebar Menu -->  --}}


        <!-- Main Content -->
        <div class="page-wrapper">
            <div class="container-fluid pt-25">
                {{--  <!-- Row -->  --}}
                @yield('main_content')
                {{--  <!-- Row -->  --}}
            </div>

            <!-- Footer -->
            <footer class="footer container-fluid pl-30 pr-30">
                <div class="row">
                    <div class="col-sm-12">
                        <p>2017 &copy; Hound. Pampered by Hencework</p>
                    </div>
                </div>
            </footer>
            {{--  <!-- /Footer -->  --}}

        </div>
        <!-- /Main Content -->

    </div>
    <!-- /#wrapper -->

    <!-- JavaScript -->

    <!-- jQuery -->
    <script src="{{ asset('backend/vendors/bower_components/jquery/dist/jquery.min.js') }}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('backend/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>

    <!-- Data table JavaScript -->
    <script src="{{ asset('backend/vendors/bower_components/datatables/media/js/jquery.dataTables.min.js') }}"></script>

    <!-- Slimscroll JavaScript -->
    <script src="{{ asset('backend/dist/js/jquery.slimscroll.js') }}"></script>

    <!-- simpleWeather JavaScript -->
    <script src="{{ asset('backend/vendors/bower_components/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('backend/vendors/bower_components/simpleWeather/jquery.simpleWeather.min.js') }}"></script>
    <script src="{{ asset('backend/dist/js/simpleweather-data.js') }}"></script>

    <!-- Progressbar Animation JavaScript -->
    <script src="{{ asset('backend/vendors/bower_components/waypoints/lib/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('backend/vendors/bower_components/jquery.counterup/jquery.counterup.min.js') }}"></script>

    <!-- Fancy Dropdown JS -->
    <script src="{{ asset('backend/dist/js/dropdown-bootstrap-extended.js') }}"></script>

    <!-- Sparkline JavaScript -->
    <script src="{{ asset('backend/vendors/jquery.sparkline/dist/jquery.sparkline.min.js') }}"></script>

    <!-- Owl JavaScript -->
    <script src="{{ asset('backend/vendors/bower_components/owl.carousel/dist/owl.carousel.min.js') }}"></script>

    <!-- ChartJS JavaScript -->
    <script src="{{ asset('backend/vendors/chart.js/Chart.min.js') }}"></script>

    <!-- Morris Charts JavaScript -->
    <script src="{{ asset('backend/vendors/bower_components/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('backend/vendors/bower_components/morris.js/morris.min.js') }}"></script>
    <script src="{{ asset('backend/vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.js') }}"></script>

    <!-- Switchery JavaScript -->
    <script src="{{ asset('backend/vendors/bower_components/switchery/dist/switchery.min.js') }}"></script>
    <!-- Init JavaScript -->
    <script src="{{ asset('backend/dist/js/init.js') }}"></script>
    <script src="{{ asset('backend/dist/js/dashboard-data.js') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @yield('scripts')

</body>

</html>
