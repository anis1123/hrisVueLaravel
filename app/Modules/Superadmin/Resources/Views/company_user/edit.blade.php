@extends('backend.layouts.superadminbackend')
@section('head')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet"/>
@endsection
@section('title', get_company_info('company_name').' | Edit Company Users')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Users</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('super-admin/dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item">Company Users</li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <form id="TypeValidation" class="form-horizontal" action="{{route('super.company_users.update',$user->id)}}"
                      method="post">
                    @method("PUT")
                    <div class="card ">
                        <div class="card-header card-header-success card-header-text">
                            <div class="card-text">
                                <h4 class="card-title">New User</h4>
                            </div>
                        </div>
                        <div class="card-body ">
                            <br>
                            <div class="row">
                                <label class="col-sm-1 col-form-label"></label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Company</label>
                                        <select name="company_id" class="select2 form-control">
                                            <option selected disabled>Select Company</option>
                                            @foreach(get_company_lists() as $company)
                                                <option value="{{$company->id}}"
                                                @if($company->id==$user->company_id) selected @endif>{{ucfirst($company->company_name)}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-1 col-form-label"></label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">User</label>
                                        <select name="user_id" class="select2 form-control">
                                            <option selected disabled>Select User</option>
                                            @foreach($users as $us)
                                                <option value="{{$user->id}}"
                                                @if($us->id==$user->user_id) selected @endif>{{ucfirst($us->name)}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <label class="col-sm-5 col-form-label"></label>
                                <button class="btn btn-primary btn-round float-right mr-1">
                                    Update Company User
                                </button>
                            </div>
                        </div>
                    </div>
                    {{csrf_field()}}
                </form>
            </div>
            <div class="col-md-8">

                <div class="card">
                    <div class="card-header card-header-success card-header-icon">
                        <div class="card-icon">
                            <i class="fa fa-clipboard-list"></i>
                        </div>
                        <h4 class="card-title">Users List</h4>
                    </div>
                    <div class="card-body">
                        <div class="toolbar">
                            <!--        Here you can write extra buttons/actions for the toolbar              -->
                        </div>
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>User's Name</th>
                                <th>Company's Name</th>
                                <th class="disabled-sorting text-right">Actions</th>

                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>User's Name</th>
                                <th>Company's Name</th>
                                <th class="disabled-sorting text-right">Actions</th>

                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($company_users as $user)
                                <tr>
                                    <td>{{ucfirst($user->users->name)}}</td>
                                    <td>{{ucfirst($user->companies->company_name)}}</td>

                                    <td class="text-right">

                                        <a href="{{ route('super.company_users.edit',$user->id) }}"
                                           title="Edit"><span class="fa fa-edit"></span> </a>

                                        <a href="" onclick="confirmDelete('{{$user->id}}');">
                                            <span class="fa fa-trash"></span></a>
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
    </div>
@stop
@section('script')
    <!-- DataTables -->
    <script src="{{asset('plugins/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.select2').select2();
        });
    </script>
    <script>
        function confirmDelete(id) {
            var url = '{{ route("super.company_users.delete", ":id") }}';
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
