<?php $company_id=auth()->user()->company_id ?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('/admin/dashboard')}}" class="brand-link">
        <img src="{{url('/').Storage::url(get_company_info(Auth::user()->company_id)->logo)}}" alt="{{get_company_info('company_name')}}"
             class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">{{get_company_info(Auth::user()->company_id)->short_name}}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('backend/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2"
                     alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{Auth::user()->name ?? 'Admin'}}</a>
            </div>

        </div>


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview menu-open">
                    <a href="{{url('/admin/dashboard')}}" class="nav-link active">
                        <i class="fas fa-home"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>

                </li>
                @if(has_permission('permission-list',$company_id)||
              has_permission('permission-delete',$company_id)||
              has_permission('permission-create',$company_id)||
              has_permission('permission-edit',$company_id))
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="fas fa-skull-crossbones"></i>
                        <p>
                            Permission
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('permissions.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add New</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('permissions.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View All</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif
                @if(has_permission('role-list',$company_id)||
               has_permission('role-delete',$company_id)||
               has_permission('role-create',$company_id)||
               has_permission('role-edit',$company_id))
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="fas fa-user-tag"></i>
                        <p>
                            Roles
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('roles.create')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add New</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('roles.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View All</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif
                @if(has_permission('user-list',$company_id)||
              has_permission('user-delete',$company_id)||
              has_permission('user-create',$company_id)||
              has_permission('user-edit',$company_id))
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="fas fa-users"></i>
                        <p>
                            Users
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('users.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add New</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('users.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View All</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif

                {{--                <li class="nav-item has-treeview">--}}
                {{--                    <a href="#" class="nav-link">--}}
                {{--                        <i class="fas fa-list"></i>--}}
                {{--                        <p>--}}
                {{--                            Semester--}}
                {{--                            <i class="fas fa-angle-left right"></i>--}}
                {{--                        </p>--}}
                {{--                    </a>--}}
                {{--                    <ul class="nav nav-treeview">--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a href="{{route('semester.create')}}" class="nav-link">--}}
                {{--                                <i class="far fa-circle nav-icon"></i>--}}
                {{--                                <p>Add New</p>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a href="{{route('semester.index')}}" class="nav-link">--}}
                {{--                                <i class="far fa-circle nav-icon"></i>--}}
                {{--                                <p>View All</p>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}
                {{--                    </ul>--}}
                {{--                </li>--}}
                {{--                --}}
                @if(has_permission('setting-list',$company_id)||
               has_permission('setting-delete',$company_id)||
               has_permission('setting-create',$company_id)||
               has_permission('setting-edit',$company_id))
                <li class="nav-item">
                    <a href="{{route('setting.index')}}" class="nav-link">
                        <i class="fas fa-wrench"></i>
                        <p>
                            Setting
                        </p>
                    </a>
                </li>
                    @endif


            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
