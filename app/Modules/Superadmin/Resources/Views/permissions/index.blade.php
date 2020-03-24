@extends('backend.layouts.superadminbackend')
@section('head')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
@endsection
@section('title', get_company_info('company_name').' | Permission')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Permission</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('super-admin/dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item">Permission</li>
                        <li class="breadcrumb-item active">Add</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <form id="TypeValidation" class="form-horizontal" action="{{route('super.permissions.store')}}" method="post" >
                    <div class="card ">
                        <div class="card-header card-header-success card-header-text">
                            <div class="card-text">
                                <h4 class="card-title">New Permission</h4>
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
                                            <option value="{{$company->id}}">{{ucfirst($company->company_name)}}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div><div class="row">
                                <label class="col-sm-1 col-form-label"></label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Permission Group</label>
                                        <input class="form-control" value="{{ old('group') }}" type="text" maxlength="100" name="group" required="true" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-1 col-form-label"></label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        {{--<label class="bmd-label-floating">Guard Name</label>--}}
                                        <input class="form-control" value="web" type="hidden" name="guard_name" />
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <label class="col-sm-5 col-form-label"></label>
                                <button class="btn btn-primary btn-round float-right mr-1">
                                    Add New Permission
                                </button>
                            </div>
                        </div>
                    </div>
                    {{csrf_field()}}
                </form>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header card-header-primary card-header-icon">
                        <div class="card-icon">
                            <i class="fa fa-clipboard-list"></i>
                        </div>
                        <h4 class="card-title">Permission</h4>
                            <a href="{{ URL::to('permissions/create') }}">
                                <button class="btn btn-primary btn-round float-right mr-1">
                                    <i class="fa fa-plus"></i> Add Permission
                                </button>
                            </a>
                    </div>
                    <div class="card-body">
                        <div class="toolbar">
                            <!--        Here you can write extra buttons/actions for the toolbar              -->
                        </div>
                            <table id="example2" class="table table-bordered table-hover">      <thead>
                                <tr>
                                    <th>Permissions Name</th>
                                    <th>Company Name</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($permissions as $permission)
                                    <tr>
                                        <td>{{$permission->name}}</td>
                                        <td>{{get_company_info($permission->company_id)->company_name}}</td>
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
            var url = '{{ route("super.company.destroy", ":id") }}';
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

