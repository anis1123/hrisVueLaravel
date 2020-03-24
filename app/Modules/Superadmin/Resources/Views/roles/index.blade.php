@extends('backend.layouts.superadminbackend')
@section('head')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
@endsection
@section('title', get_company_info('company_name').' | Roles Detail')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Roles</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('super-admin/dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item">Roles</li>
                        <li class="breadcrumb-item active">List</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-success card-header-icon">
                        <div class="card-icon">
                            <i class="fa fa-clipboard-list"></i>
                        </div>
                        <h4 class="card-title">Roles Detail</h4>

                        <a href="{{route('super.roles.create')}}">
                            <button class="btn btn-primary btn-round float-right mr-1">
                                <i class="fa fa-plus"></i> Add Roles
                            </button>
                        </a>

                    </div>
                    <div class="card-body">
                        <div class="toolbar">
                            <!--        Here you can write extra buttons/actions for the toolbar              -->
                        </div>
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Roles Name</th>
                                    <th>Company Name</th>

                                    <th class="disabled-sorting text-right">Actions</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>Roles Name</th>
                                    <th>Company Name</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach($roles as $role)
                                        <tr>
                                            <td>{{$role->name}}</td>
                                            <td>{{get_company_info($role->company_id)->company_name}}</td>
                                            <td class="text-right">
                                                <a href="{{route('super.roles.show',$role->id)}}" title="View"><span class="fa fa-eye"></span></a>
                                                <a href="{{route('super.roles.edit',$role->id)}}" title="Edit"><span class="fa fa-edit"></span></a>
                                                <a href="#" onclick="
                                                    if(confirmDelete('Are You sure, You Want To Delete?'))
                                                        {
                                                        event.preventDefault();
                                                        document.getElementById('delete-form-{{$role->id}}').submit();
                                                        }
                                                        else{
                                                        event.preventDefault();
                                                        }" title="Delete"><span class="fa fa-trash"></span>
                                                </a>
                                                <form method="post" action="{{route('super.roles.destroy',$role->id)}} " id="delete-form-{{$role->id}}">
                                                    @csrf
                                                    {{method_field('DELETE')}}
                                                </form>
                                            </td>
                                        </tr>
                                @endforeach
                                </tbody>
                            </table>

                    </div>
                    <!-- end content-->
                </div>
                <!--  end card  -->
            </div>
            <!-- end col-md-12 -->
        </div>
        <!-- end row -->
    </div>
@stop
@section('script')
    <!-- DataTables -->
    <script src="{{asset('plugins/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
    <script>
        function confirmDelete(id) {
            var url = '{{ route("super.roles.destroy", ":id") }}';
            url = url.replace(':id', id);
            if (confirm('Are You sure, You Want To Delete?')) {
                event.preventDefault();
                document.location.href = url;
            } else {
                event.preventDefault();
            }
        }
    </script>
@endsection
