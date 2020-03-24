@extends('backend.layouts.superadminbackend')

@section('title', get_company_info('company_name').' | Create Roles')
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
                        <li class="breadcrumb-item active">Add</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="float-left">
                <h2>Create New Role</h2>
            </div>
            <div class="float-right">
                <a class="btn btn-primary" href="{{ route('super.roles.index') }}"> Back</a>
            </div>
        </div>
    </div>

    <form action="{{url('getcompanyid')}}" method="POST" enctype="multipart/form-data">
        {{--    {!! Form::open(array('route' => 'super.roles.store','method'=>'POST')) !!}--}}
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label class="bmd-label-floating">Company</label>
                    <select name="company_id" id="company_id" class="select2 form-control" required>
                        <option selected disabled>Select Company</option>
                        @foreach(get_company_lists() as $company)
                            <option value="{{$company->id}}">{{ucfirst($company->company_name)}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <button type="submit" class="btn btn-primary btn-sm btn-round col-sm-3">Submit</button>
                </div>

            </div>
            @csrf
        </div>
    </form>
{{--        {{dd($permissions)}}--}}
        @if(isset($permissions))

            <div class="card">
                <form action="{{route('super.roles.store')}}" method="POST" enctype="multipart/form-data">
            <div class="col-sm-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" name="name" class="form-control">
                    {{--                {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}--}}
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <input type="hidden" name="company_id" value="{{$company_id}}">
                    <strong>Permission:</strong>
                    <div class="form-group">
                        <div class="float-right mr-5">
                            <b> Select all</b> <input id="checkall" type="checkbox" href="#">
                        </div>
                    </div>
                    <br/>
                    @foreach($group as $value)
                        <div class="row">
                            <div class="col-sm-12">
                                {{--                            <button type="button" class="col-sm-3 btn btn-info btn-round btn-sm" data-toggle="collapse"--}}
                                {{--                                    data-target="#group[{{$value->id}}]">--}}
                                {{--                                <i class="fa fa-star"></i>--}}
                                {{--                                {{$value->name}} <i class="fa fa-arrow-down"></i>--}}
                                {{--                            </button>--}}
                                <button class="col-sm-3 btn btn-info btn-round btn-sm" type="button"
                                        data-toggle="collapse"
                                        data-target="#group{{$value->id}}" aria-expanded="false"
                                        aria-controls="collapseExample">
                                    <i class="fa fa-star"></i>{{$value->name}}<i class="fa fa-arrow-down"></i>
                                </button>
                            </div>

                            <div id="group{{$value->id}}" class="collapse col-sm-12 bg-dark">
                                <div class="col-sm-12 checkbox-radios">
                                    @foreach(permission_list($value->id) as $item)

                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label">
                                                <input class="form-check-input" name="permission[]" type="checkbox"
                                                       value="{{$item->id}}"> {{$item->name}}
                                                <span class="form-check-sign">
                                                <span class="check"></span>
                                            </span>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                                {{--<div class="col-md-12">--}}
                                {{--<label class="form-check-label">--}}
                                {{--<input class="form-check-input" name="" type="checkbox"--}}
                                {{--value=> First Checkbox--}}
                                {{--<span class="form-check-sign">--}}
                                {{--<span class="check"></span>--}}
                                {{--</span>--}}
                                {{--</label>--}}
                                {{--<label>{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}--}}
                                {{--{{ $value->name }}</label>--}}
                                {{--</div>--}}
                            </div>
                        </div>
                    @endforeach


                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <button type="submit" class="btn btn-primary btn-sm btn-round col-sm-3 form-control">Submit</button>
            </div>
                    @csrf
                </form>
            </div>
                @endif

        {{csrf_field()}}
    </form>


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
