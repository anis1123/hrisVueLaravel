@extends('backend.layouts.superadminbackend')
@section('title',' Department | Add')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Department</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item">Department</li>
                        <li class="breadcrumb-item active">Add</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-4">
                <div class="card card-primary">
                    <div class="card-header with-border">
                        Add New Department
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                                    title="Collapse">
                                <i class="fas fa-minus"></i></button>
                        </div>
                        <br>
                    </div>
                    <div class="card-body">

                        <form action="{{route('department.store')}}" method="POST">


                            @csrf

                            <div class="form-group">
                                <label for="name">Department Name</label>
                                <input type="text" class="form-control" name="name"
                                       value="{{old('name')}}" required>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                Add Department
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header with-border">
                        Showing all Departments
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                                    title="Collapse">
                                <i class="fas fa-minus"></i></button>
                        </div>
                        <br>
                    </div>
                    <div class="card-body">
                        <div class="card">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Department Name</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($departments as $department)
                                        <tr>
                                            <td>{{$department->id}}</td>

                                            <td>{{ucfirst($department->name)}}</td>
                                            <td>
                                                &emsp;<a href="{{route('department.edit',$department->id)}}"
                                                         title='Edit'><span
                                                        class='fa fa-edit'></span></a>
                                                &emsp;
                                                <a href="" onclick=" confirmDelete('{{$department->id}}');">
                                                    <span class="fa fa-trash"></span></a></td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Subject Name</th>
                                        <th>Action</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>


        </div>

    </section>
    <!-- /.content -->

@endsection
@section('script')
    <script>
        function confirmDelete(id) {
            var url = '{{ route("department.trash", ":id") }}';
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
