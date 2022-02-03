<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="Admin Dashboard" name="description" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'St.John | Ambulance Dispatch') }}</title>

        <!-- DataTables -->
        <link href="{{ asset('vendor/assets/plugins/datatables/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('vendor/assets/plugins/datatables/responsive.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('vendor/assets/plugins/datatables/dataTables.bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>


        <link href="{{ asset('vendor/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('vendor/assets/css/icons.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('vendor/assets/css/style.css') }}" rel="stylesheet" type="text/css">

        <!-- Scripts -->
        @livewireStyles
    </head>


    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            <div class="topbar">
                <!-- LOGO -->
                <div class="topbar-left">
                    <div class="text-center">
                        <a href="{{ route('dispatcher.index') }}" class="logo">HOME | DASHBOARD</a>
                    </div>
                </div>
                <!-- Button mobile view to collapse sidebar menu -->
                <div class="navbar navbar-default" role="navigation">
                    <div class="container">
                        <div class="">
                            <div class="pull-left">
                                <button type="button" class="button-menu-mobile open-left waves-effect waves-light">
                                    <i class="ion-navicon"></i>
                                </button>
                                <span class="clearfix"></span>
                            </div>
                            <form class="navbar-form pull-left" role="search" method="POST">
                                <div class="form-group">
                                    <input type="text" class="form-control search-bar" placeholder="Search...">
                                </div>
                                <button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
                            </form>

                            <ul class="nav navbar-nav navbar-right pull-right">
                                <li class="dropdown hidden-xs">
                                    <a href="#" data-bs-target="#" class="dropdown-toggle waves-effect waves-light" data-bs-toggle="dropdown" aria-expanded="true">
                                        <i class="ti-bell"></i> <span class="badge badge-xs badge-danger">@yield('number_notifications')</span>
                                    </a>
                                </li>
                                <li class="hidden-xs">
                                    <a href="#" id="btn-fullscreen" class="waves-effect waves-light"><i class="ti-fullscreen"></i></a>
                                </li>
                                <li class="dropdown">
                                    <a href="" class="dropdown-toggle profile waves-effect waves-light" data-bs-toggle="dropdown" aria-expanded="true"><img src="@yield('profile-pic-sm')" alt="user-img" class="img-circle"> </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="javascript:void(0)"> &nbsp;</a></li>
                                        <li class="divider"></li>
                                        <li>
                                            <a href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                                document.getElementById('logout-form').submit();">
                                                    {{ __('Logout') }}
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                @csrf
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <!--/.nav-collapse -->
                    </div>
                </div>
            </div>
            <!-- Top Bar End -->


            <!-- ========== Left Sidebar Start ========== -->

            <div class="left side-menu">
                <div class="sidebar-inner slimscrollleft">
                    <div class="user-details">
                        <div class="text-center">
                            <img src="@yield('profile-pic-lg')" alt="" class="img-circle" height="50">
                        </div>
                        <div class="user-info">
                            <div class="dropdown">
                                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">@yield('user_name')</a>
                                <ul class="dropdown-menu">
                                    <li><a href="javascript:void(0)"> &nbsp;</a></li>
                                    <li class="divider"></li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </div>

                            <p class="text-muted m-0"><i class="fa fa-dot-circle-o text-success"></i> Online </p>
                        </div>
                    </div>
                    <!--- Divider -->
                    <div id="sidebar-menu">
                        <ul>
                            <li>
                                <a href="{{ route('dispatcher.index') }}" class="waves-effect"><i class="ti-home"></i><span> Dashboard </span></a>
                            </li>

                            <li>
                                <a href="{{ route('dispatcher.media.index') }}" class="waves-effect"><i class="ti-video-clapper"></i><span> Media </span></a>
                            </li>

                            <li class="has_sub">
                                <a href="{{ route('dispatcher.location.index') }}" class="waves-effect"><i class="ti-location-pin"></i> <span> Locations </span> <span class="pull-right"><i class="mdi mdi-plus"></i></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="{{ route('dispatcher.location.index') }}">All Hospitals</a></li>
                                    <li><a href="{{ route('dispatcher.location.create') }}">Add Hospital</a></li>
                                </ul>
                            </li>

                            <li class="has_sub">
                                <a href="{{ route('dispatcher.ambulance.index') }}" class="waves-effect"><i class="fa fa-ambulance"></i> <span> Ambulances </span> <span class="pull-right"><i class="mdi mdi-plus"></i></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="{{ route('dispatcher.ambulance.index') }}">All Ambulances</a></li>
                                    <li><a href="{{ route('dispatcher.ambulance.create') }}">Create Ambulance</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="{{ route('dispatcher.dispatch-ambulance.index') }}" class="waves-effect"><i class="ti-headphone-alt"></i><span> Dispatch Ambulance </span></a>
                            </li>

                        </ul>
                    </div>
                    <div class="clearfix"></div>
                </div> <!-- end sidebarinner -->
            </div>
            <!-- Left Sidebar End -->

            <!-- Start right Content here -->

            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">
                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="page-header-title">
                                    <h4 class="pull-left page-title">@yield('page_name')</h4>
                                    <ol class="breadcrumb pull-right">
                                        <li><a href=" {{ route('dispatcher.index') }} ">Dispatch</a></li>
                                        <li class="active">Dashboard</li>
                                    </ol>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-md-1">
                            @yield('dashboard_panels')
                        </div>

                        <div class="row m-t-10">
                            <div class="col-md-12">
                                @yield('alerts')
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">@yield('table_name')</h3>
                                    </div>
                                    <div class="panel-body">
                                        @yield('table_content')
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Row -->


                    </div>
                    <!-- container -->

                </div>
                <!-- content -->

                <footer class="footer">
                    2021 © St.John | Ambulance Dispatch
                </footer>

            </div>
            <!-- End Right content here -->

        </div>
        <!-- END wrapper -->

        <!-- jQuery  -->
        <script src="{{ asset('vendor/assets/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('vendor/assets/js/jquery.min.js') }}"></script>
        <script src="{{ asset('vendor/assets/js/jquery.slimscroll.js') }}"></script>
        <script src="{{ asset('vendor/assets/js/modernizr.min.js') }}"></script>
        <script src="{{ asset('vendor/assets/js/detect.js') }}"></script>
        <script src="{{ asset('vendor/assets/js/fastclick.js') }}"></script>
        <script src="{{ asset('vendor/assets/js/jquery.blockUI.js') }}"></script>
        <script src="{{ asset('vendor/assets/js/waves.js') }}"></script>
        <script src="{{ asset('vendor/assets/js/wow.min.js') }}"></script>
        <script src="{{ asset('vendor/assets/js/jquery.nicescroll.js') }}"></script>
        <script src="{{ asset('vendor/assets/js/jquery.scrollTo.min.js') }}"></script>
        <script src="{{ asset('vendor/assets/plugins/jquery-sparkline/jquery.sparkline.min.js') }}"></script>

        <!-- Datatables-->
        <script src="{{ asset('vendor/assets/plugins/datatables/dataTables.min.js') }}"></script>
        <script src="{{ asset('vendor/assets/pages/datatables.init.js') }}"></script>

        <script src="{{ asset('vendor/assets/pages/dashborad.js') }}"></script>

        <script src="{{ asset('vendor/assets/js/app.js') }}"></script>
        <script src="{{ asset('js/app.js') }}"></script>

        @livewireScripts
    </body>
</html>






