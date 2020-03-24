@extends('backend.layouts.adminbackend')

@section('title', Auth::user()->companies->company_name.' | User Update')
@section('head')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet"/>
@endsection
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Users</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item">Users</li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <div class="container-fluid">
        <div class="row">
                <div class="col-md-4">
                    <form id="TypeValidation" class="form-horizontal" action="{{route('users.update',$user->id)}}"
                          method="post">
                        @method('PUT')
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
                                            <input type="hidden" name="company_id" value="{{$company_id}}">
                                            <label class="bmd-label-floating">User Name</label>
                                            <input class="form-control" value="{{$user->name}}" type="text"
                                                   maxlength="15" name="name" required="true"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-1 col-form-label"></label>
                                    <div class="col-sm-10">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">User Email</label>
                                            <input class="form-control" value="{{$user->email}}" type="text"
                                                   name="email" required="true"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-1 col-form-label"></label>
                                    <div class="col-sm-10">
                                        <div class="form-group">

<?php $roles=array($companyroles)?>
{{--                                            {{dd($roles)}}--}}
                                            <?php $r=array_values($roles); ?>
{{--    {{dd($r)}}--}}
                                            <?php $user=array_values($userRole) ?>
{{--    {{dd($user)}}--}}
                                                <?php $role=count($companyroles) ?>
                                                <?php $users=count($user) ?>
{{--    {{dd($role)}}--}}
{{--    {{dd($users)}}--}}
{{--    {{dd($companyroles[0]->name)}}--}}
{{--    {{dd($user[0])}}--}}
{{--                                                {{dd($roles,$users)}}--}}
{{--                                            {{dd(($userRole[0]))}}--}}
{{--                                      @foreach($roles as $role){{dd($role)}}@endforeach--}}
                                            <label class="bmd-label-floating">Select Role</label>
                                           <select class="select2 form-control select-with-transition" name="roles[]" multiple >
<option disabled>Select Role</option>

                                               @for($m=0;$m<$role;$m++))


<?php $i=0 ?>
                                                   <option value="{{$companyroles[$m]->name}}"
                                                           @for($n=0;$n<$users;$n++)
                                                           @if($companyroles[$m]->name==$user[$n]->name) selected @endif
                                                   @endfor>{{$companyroles[$m]->name}}</option>
                                               <?php $i=$i+1 ?>

                                               @endfor
                                           </select>
{{--                                            {!! Form::select('roles[]', $userRole,[], array('class' => 'select2','multiple', 'data-style' => 'select-with-transition')) !!}--}}

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-1 col-form-label"></label>
                                    <div class="col-sm-10">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Remarks</label>
                                            <input class="form-control" value="{{ old('remarks') }}" type="text"
                                                   name="remarks"/>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <label class="col-sm-5 col-form-label"></label>
                                    <button class="btn btn-primary btn-round float-right mr-1">
                                        Update User
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
                                                <th>Email</th>
                                                <th>Role</th>
                                                <th>Remarks</th>

                                                    <th class="disabled-sorting text-right">Actions</th>

                                            </tr>
                                            </thead>
                                            <tfoot>
                                            <tr>
                                                <th>User's Name</th>
                                                <th>Email</th>
                                                <th>Role</th>
                                                <th>Remarks</th>
                                                    <th class="disabled-sorting text-right">Actions</th>

                                            </tr>
                                            </tfoot>
                                            <tbody>
                                            @foreach($data as $user)
                                                <tr>
                                                    <td>{{$user->name}}</td>
                                                    <td>{{$user->email}}</td>
                                                    <td>
                                                        @if(!empty($user->getRoleNames()))
                                                            @foreach($user->getRoleNames() as $v)
                                                                <label class="badge badge-success">{{ $v }}</label>
                                                            @endforeach
                                                        @endif
                                                    </td>
                                                    @if($user->remarks!="")
                                                        <td>{{$user->remarks}}</td>
                                                    @else
                                                        <td>N/A</td>
                                                    @endif
                                                    <td class="text-right">

                                                            <a href="{{ route('users.edit',$user->id) }}"
                                                               ><span class="fa fa-edit"></span></a>

                                                        <a href="" onclick="confirmDelete('{{$user->id}}');">
                                                            <span class="fa fa-trash"></span></a>


                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
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
            var url = '{{ route("users.delete", ":id") }}';
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
