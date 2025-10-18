<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? '' }} | {{ config('app.name', 'Laravel') }}</title>

    <!-- CSS Reset -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/reset.css') }}" media="screen" />

    <!-- Fluid 960 Grid System - CSS framework -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/grid.css') }}" media="screen" />
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Main stylesheet -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}" media="screen" />

    <!-- Table sorter stylesheet -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/tablesorter.css') }}" media="screen" />

    <!-- Thickbox stylesheet -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/thickbox.css') }}" media="screen" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/theme-blue.css') }}" media="screen" />
    <script type="text/javascript" src="{{ asset('js/jquery-1.3.2.min.js') }}"></script>

    <!-- Toast Plugin -->
    <link rel="stylesheet" href="{{ asset('css/toast.css') }}">


    <link rel="stylesheet" type="text/css" href=" https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.0/css/buttons.dataTables.min.css" />

    <script type="text/javascript" src="//code.jquery.com/jquery-1.12.4.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.0/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
    <script type="text/javascript" src="//cdn.datatables.net/buttons/1.5.0/js/buttons.html5.min.js"></script>

    <!-- Sweet alerts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!--END-->
    <!-- JQuery thickbox plugin script -->
    <script type="text/javascript" src="{{ asset('js/thickbox.js') }}"></script>

    <script src="{{ asset('js/feather.min.js') }}"></script>

    <style>
        #subnav ul li a {
            background: #423b72 !important;
            padding: 7px 10px !important;
            margin-top: 3px !important;
            text-decoration: none !important;
            color: white !important;
        }

        .fontStyle2 {
            font-family: 'Manrope', sans-serif;
            background-color: #008bc6 !important;
        }

        .compact {
            line-height: 1.5em
        }

        a.customNav {
            color: #fff;
            text-decoration: none;
            display: inline-block;
            min-width: 80px;
            text-align: center;
            border-right: 2px solid white;
            border-radius: 50px !important;
            padding: 14px 18px;
        }

        a.active,
        a.customNav:hover {
            background: rgba(255, 255, 255, 0.2) !important;
            border-color: transparent
        }

        @media screen and (min-width:797px) {
            #bottomNavbar.collapse {
                display: block
            }
        }

        @media screen and (max-width:796px) {
            #bottomNavbar {
                padding: 14px;
            }

            #bottomNavbar a.customNav {
                display: block !important;
                border: none;
                background: rgba(0, 0, 0, 0.2);
                margin-top: 4px;
                margin-bottom: 4px;
                margin-left: -5px;
                margin-right: -5px;
            }

            #removeFlex {
                display: block !important;
                text-align: center
            }
        }

        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
            font-size: 1.2em;
        }

        .pagination a,
        .pagination span {
            display: inline-block;
            padding: 5px 10px;
            margin: 0 5px;
            text-align: center;
            border-radius: 3px;
            color: #333;
            background-color: #fff;
            border: 1px solid #ddd;
            transition: background-color 0.2s ease;
        }

        .pagination a:hover {
            background-color: #ddd;
        }

        .pagination .current {
            color: #fff;
            background-color: blue;
            border-color: #333;
        }

        .tab-pane.fade.active.show {
            opacity: 1 !important;
        }

        .modal.fade.active.show {
            opacity: 0 !important;
        }

        body {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }

        .main-content-div {
            flex: 1;
        }

        .dataTables_filter {
            float: right;
        }

        a {
            text-decoration: none !important;
        }

        select,
        input,
        button {
            box-shadow: none !important;
            ;
        }

        .left-tab-btns {
            font-size: 15px;
            display: flex;
            align-items: center;
        }

        .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            background-color: #008bc6;
        }

        .nav-pills .nav-link {
            color: #008bc6;
        }

        .bg-primary,
        .btn-primary {
            background-color: #008BC6 !important;
        }

        svg.feather.feather-plus {
            width: 20px;
            height: 20px;
        }
    </style>

    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
    <script src="https://cdn.quilljs.com/1.3.6/quill.table.min.js"></script>
</head>

<body>

    @isset($title)
        <header>
            <div id="header-status">
                <div class="container-fluid bg-dark px-5">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="my-2 text-white h4">LAPT - ADMINISTRATION PANEL</span>

                        <form action="{{ route('logout') }}" method="post">
                            @csrf;
                            <button type="submit" class="btn my-2 btn-primary text-white">Logout</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="fontStyle2">
                <button type="button" data-bs-toggle="collapse" data-bs-target="#bottomNavbar" class="btn btn-danger w-100 d-lg-none d-md-none d-sm-block d-xs-block rounded-0 p-2"><i class="fas fa-bars me-2" aria-hidden="true"></i> Menu</button>
                <div class="collapse navbar-collapse px-2" id="bottomNavbar">
                    <div class="container-fluid">
                        <div class="d-flex justify-content-between align-items-center" id="removeFlex">
                            <div class="flex-grow-1">
                                <a href="{{ route('dashboard') }}" class="d-inline-block customNav {{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
                                <a href="{{ route('invoices.index') }}" class="d-inline-block customNav {{ request()->routeIs('invoices.*') ? 'active' : '' }}">Sales</a>
                                <a href="{{ route('centres.index') }}" class="d-inline-block customNav {{ request()->routeIs('centres.*') ? 'active' : '' }}">Centres</a>
                                <a href="{{ route('courses.index') }}" class="d-inline-block customNav {{ request()->routeIs('courses.*') ? 'active' : '' }}">Courses</a>
                                <a href="{{ route('students.index') }}" class="d-inline-block customNav {{ request()->routeIs('students.*') ? 'active' : '' }}">Students</a>
                            </div>

                            <div class="m-3">
                                <i class="fas fa-search text-white fs-6" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
    @endisset

    {{ $slot }}

    @isset($title)
        <footer class="p-2 text-center d-flex justify-content-center align-item-center bg-dark" style="width:100%;">
            <h5 class="my-1 text-white">&copy; {{ date('Y') }}. <a class="text-white" href="#" title="ADMINISTRATION PANEL">LAPT</a></h5>
        </footer>
    @endisset

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script> feather.replace(); </script>
</body>

</html>