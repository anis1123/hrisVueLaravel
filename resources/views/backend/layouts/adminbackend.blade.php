<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{Auth::user()->companies->company_name}} | @yield('title') </title>
    @include('backend.includes.admin.head')
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav ">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
            </li>
            <div class="d-md-flex d-block flex-row mx-md-auto mx-0">
                <a href="{{url('admin/dashboard')}}" class="nav-link">Home | Admin</a>
            </div>
        </ul>
       <ul class="nav navbar-nav ml-auto">

           <a class="nav-item nav-link"><b><h3>{{Auth::user()->companies->company_name}} | ID: {{Auth::user()->company_id}}</h3></b></a>
{{--           <a class="nav-item nav-link"><b><h3>{{(get_company_info(Auth::user()->company_id))->company_name}}</h3></b></a>--}}

       </ul>
       <ul class="navbar-nav ml-auto">
            <a class="nav-item" href="{{ url('admin/logout') }}" style="float:right"
               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i>{{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{url('admin/logout')}}"  style="display: none;">
                @csrf
            </form>

        </ul>
    </nav>
    <!-- /.navbar -->

@include('backend.includes.admin.sidebar')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    @include('backend.includes.admin.message')
    <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            @yield('content')
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
    <!-- Main Footer -->
    <footer class="main-footer">
        <div style="float:right;">
            <strong>Copyright &copy; 2014-2019 <a href="http://www.paceinfosys.com.np">Pace Infosys</a>.</strong>
            All rights reserved.
        </div>

    </footer>
</div>
<!-- ./wrapper -->

@include('backend.includes.superadmin.script')
{!!toastr()->render()!!}
</body>
</html>
