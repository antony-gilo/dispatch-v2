<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="Admin Dashboard" name="description" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Ambulance | Dispatch') }}</title>

        <!-- DataTables -->
        <link href="{{ asset('vendor/assets/plugins/datatables/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('vendor/assets/plugins/datatables/responsive.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('vendor/assets/plugins/datatables/dataTables.bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>

        <link href="{{ asset('vendor/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('vendor/assets/css/icons.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('vendor/assets/css/style.css') }}" rel="stylesheet" type="text/css">
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
                                    {{-- <ul class="dropdown-menu dropdown-menu-lg">
                                        <li class="text-center notifi-title">Notification <span class="badge badge-xs badge-success">3</span></li>
                                        <li class="list-group">
                                           <!-- list item-->
                                           <a href="javascript:void(0);" class="list-group-item">
                                              <div class="media">
                                                 <div class="media-heading">Your order is placed</div>
                                                 <p class="m-0">
                                                   <small>Dummy text of the printing and typesetting industry.</small>
                                                 </p>
                                              </div>
                                           </a>

                                           <!-- last list item -->
                                            <a href="javascript:void(0);" class="list-group-item">
                                              <small class="text-primary">See all notifications</small>
                                            </a>
                                        </li>
                                    </ul> --}}
                                </li>
                                <li class="hidden-xs">
                                    <a href="#" id="btn-fullscreen" class="waves-effect waves-light"><i class="ti-fullscreen"></i></a>
                                </li>
                                <li class="dropdown">
                                    <a href="" class="dropdown-toggle profile waves-effect waves-light" data-bs-toggle="dropdown" aria-expanded="true"><img src="{{ $user->photo ? $user->photo->path : 'vendor/assets/images/users/avatar-1.jpg' }}" alt="user-img" class="img-circle"> </a>
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
                            <img src="{{ $user->photo !== null ? $user->photo->path : 'vendor/assets/images/users/avatar-1.jpg' }}" alt="" class="img-circle" height="50">
                        </div>
                        <div class="user-info">
                            <div class="dropdown">
                                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ $user->name }} &nbsp;<i class="fa fa-caret-down"></i>
                                </a>
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
                                <a href="{{ route('location.index') }}" class="waves-effect"><i class="ti-location-pin"></i> <span> Locations </span> <span class="pull-right"><i class="mdi mdi-plus"></i></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="{{ route('dispatcher.location.index') }}">All Locations</a></li>
                                    <li><a href="{{ route('dispatcher.location.create') }}">Add A Location</a></li>
                                </ul>
                            </li>

                            <li class="has_sub">
                                <a href="{{ route('ambulance.index') }}" class="waves-effect"><i class="fa fa-ambulance"></i> <span> Ambulances </span> <span class="pull-right"><i class="mdi mdi-plus"></i></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="{{ route('dispatcher.ambulance.index') }}">All Ambulances</a></li>
                                    <li><a href="{{ route('dispatcher.ambulance.create') }}">Create Ambulance</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="{{ route('dispatch-ambulance.index') }}" class="waves-effect"><i class="ti-headphone-alt"></i><span> Dispatch Ambulance </span></a>
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
                                    <h4 class="pull-left page-title">Dashboard</h4>
                                    <ol class="breadcrumb pull-right">
                                        <li><a href=" {{ route('dispatcher.index') }} ">Dispatch</a></li>
                                        <li class="active">Dispatcher Dashboard</li>
                                    </ol>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-3">
                            <div class="panel panel-primary text-center">
                                <div class="panel-heading">
                                    <h4 class="panel-title">Registered Ambulances</h4>
                                </div>
                                <div class="panel-body">
                                    <h3 class=""><b>{{ $ambulances->count() }}</b></h3>
                                    <p class="text-muted"><b>{{ $on_duty }}</b> Ambulances On Duty</p>
                                    <p class="text-muted"><b>{{ $stand_by }}</b> Ambulances On Stand By</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-3">
                            <div class="panel panel-primary text-center">
                                <div class="panel-heading">
                                    <h4 class="panel-title">Number Of Dispatches</h4>
                                </div>
                                <div class="panel-body">
                                    <h3 class=""><b>{{ $dispatches_count }}</b></h3>
                                    <p class="text-muted">&nbsp;</p>
                                    <p class="text-muted"><b>{{ $monthly_dispatch / $dispatches_count * 100 }}%</b> Of Dispatches Made This Month</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-3">
                            <div class="panel panel-primary text-center">
                                <div class="panel-heading">
                                    <h4 class="panel-title">Registered System Users</h4>
                                </div>
                                <div class="panel-body">
                                    <h3 class=""><b>{{ $users->count() }}</b></h3>
                                    <p class="text-muted"><b>{{ $dispatchers }}</b> Dispatchers</p>
                                    <p class="text-muted"><b>{{ $drivers }}</b> Drivers</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-3 mb-5">
                            <div class="panel panel-primary text-center">
                                <div class="panel-heading">
                                    <h4 class="panel-title">Registered Hospitals</h4>
                                </div>
                                <div class="panel-body">
                                    <h3 class=""><b>{{ $locations->count() }}</b></h3>
                                    <p class="text-muted">&nbsp;</p>
                                    <p class="text-muted"><b>{{ $common_hospital }}</b> Is The Most Preffered By Casualties</p>
                                </div>
                            </div>
                        </div>

                        <div class="row m-t-10">
                            <div class="col-md-12">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">REGISTERED SYSTEM USERS</h3>
                                    </div>
                                    <div class="panel-body">
                                        <table id="datatable" class="table table-striped table-bordered">
                                            <caption><small style="color: #5966f7;">&nbsp;REGISTERED SYSTEM USERS AND THEIR ROLES</small></caption>
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Role</th>
                                                    <th>Email</th>
                                                    <th>Date Enrolled</th>
                                                </tr>
                                            </thead>


                                            <tbody>

                                                @foreach ($users as $user)
                                                    <tr>
                                                        <td>{{ $user->name }}</td>
                                                        <td>{{ $user->role->role }}</td>
                                                        <td>{{ $user->email }}</td>
                                                        <td>{{ $user->created_at->diffForHumans() }}</td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Row -->

                        <div class="row m-t-10">
                            <div class="col-md-12">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">SYSTEM DISPATCHES MADE</h3>
                                    </div>
                                    <div class="panel-body">
                                        <table id="datatable-buttons" class="table table-striped table-bordered">
                                            <caption><small style="color: #5966f7;">&nbsp;REGISTERED SYSTEM USERS AND THEIR ROLES</small></caption>
                                            <thead>
                                                <tr>
                                                    <th>Caller Name</th>
                                                    <th>Caller's No.</th>
                                                    <th>Assigned Ambulance</th>
                                                    <th>Driver In Charge</th>
                                                    <th>Hospital Taken</th>
                                                    <th>Dispatch Date</th>
                                                </tr>
                                            </thead>


                                            <tbody>

                                                @foreach ($dispatches as $dispatch)

                                                    <tr>
                                                        <td>{{ $dispatch->name }}</td>
                                                        <td>{{ $dispatch->caller_phone }}</td>
                                                        <td>
                                                            @if ($assignedAmbulance = $dispatch->ambulance)
                                                                {{ ($assignedAmbulance['reg_no']) }}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($assignedAmbulance = $dispatch->ambulance)
                                                                {{ $assignedAmbulance->driver->name }}
                                                            @endif
                                                        </td>
                                                        <td>{{ $dispatch->location->hospital }}</td>
                                                        <td style="text-align:center"> {{ $dispatch->created_at->toDateString() }}</td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
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
                    2021 © Dispatch.io
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
    </body>
</html>










