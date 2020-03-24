@extends('backend.layouts.superadminbackend')

@section('title', get_company_info('company_name').' | Edit Roles')
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
                        <li class="breadcrumb-item"><a href="{{route('super.roles.index')}}">Roles</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="float-left">
                <h2>Edit Role</h2>
            </div>
            <div class="float-right">
                <a class="btn btn-primary" href="{{ route('super.roles.index') }}"> Back</a>
            </div>
        </div>
    </div>


    {!! Form::model($role, ['method' => 'PATCH','route' => ['super.roles.update', $role->id]]) !!}
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                <input type="hidden" name="company_id" value="{{$role->company_id}}">
                {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Permission:</strong>
                <div class="form-group">
                    <div class="float-right mr-5">
                        <b> Select all</b> <input id="checkall" type="checkbox" href="#">
                    </div>
                </div>
                <br><br>

                @foreach($group as $value)
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="col-sm-3">
                                <button type="button" class="btn btn-info btn-round btn-sm" data-toggle="collapse"
                                        data-target="#group{{$value->id}}"><i class="fa fa-star"></i> {{$value->name}} <i class="fa fa-arrow-down"></i>
                                </button>
                            </div>
                        </div>

                        <div id="group{{$value->id}}" class="collapse col-sm-12 bg-dark" >
                            <div class="col-sm-12 checkbox-radios">
                                @foreach(permission_list($value->id) as $item)
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                            <input class="form-check-input" name="permission[]" type="checkbox" value="{{$item->id}}"  @if(in_array($item->id, $rolePermissions)) checked @endif > {{$item->name}}
                                            <span class="form-check-sign">
                                                <span class="check"></span>
                                            </span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
    {!! Form::close() !!}


@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $("#checkall").click(function(){
                $('input:checkbox').not(this).prop('checked', this.checked);
            });
        });
    </script>
@stop
