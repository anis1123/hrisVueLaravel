@extends('backend.layouts.superadminbackend')
@section('title',' Company | Edit')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Company</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('super-admin/dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Edit Company</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div style="padding-left: 400px">
            <form action="{{route('super.company.update',$company->id)}}" method="POST" enctype="multipart/form-data">
                @method("PUT")
                {{csrf_field()}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">General</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                            data-toggle="tooltip" title="Collapse">
                                        <i class="fas fa-minus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <h3 class="text-center">Company ID: {{$company->id}}</h3>
                                <div class="form-group">
                                    <div class="form-group">
                                        <input type="hidden" name="company_id" value="{{$company->id}}">
                                        <label for="site_name">Company Name</label>
                                        <input type="text" class="form-control" name="company_name"
                                               value="{{$company->company_name}}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="short_name">Short Name</label>
                                        <input type="text" class="form-control" name="short_name"
                                               value="{{$company->short_name}}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input type="text" class="form-control" name="phone"
                                               value="{{$company->phone}}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="mobile">Mobile</label>
                                        <input type="text" class="form-control" name="mobile"
                                               value="{{$company->mobile}}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" name="email"
                                               value="{{$company->email}}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input type="text" class="form-control" name="address"
                                               value="{{$company->address}}" required>
                                    </div>
                                    <div class="form-group">

                                        <input type="hidden" class="form-control" name="country"
                                               value="{{$company->country}}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="currency">Currency</label>
                                        <input type="text" class="form-control" name="currency"
                                               value="{{$company->currency}}" required>
                                        <h6>Eg: Rs.</h6>
                                    </div>
                                    <div class="form-group">
                                        <label for="contact_person">Contact Person</label>
                                        <input type="text" class="form-control" name="contact_person"
                                               value="{{$company->contact_person}}" required>
                                    </div>
                                    <label class="bmd-label-floating">Select Logo*</label>
                                    <div class="form-group">

                                        <div class="fileinput fileinput-new text-center" data-provides="fileinput">

                                            <div class="fileinput-new img-thumbnail"
                                                 style="max-width: 200px; max-height: 150px;">
                                                @if($company->logo!=null)
                                                    <img src="{{url('/').Storage::url($company->logo)}}"/>
                                                @else<img
                                                    src="{{asset('backend/img/image_placeholder.jpg')}}"
                                                    alt="..."
                                                >
                                                @endif</div>
                                            <div class="fileinput-preview fileinput-exists thumbnail"
                                                 style="max-width: 200px; max-height: 150px;"></div>
                                            <div>
                                        <span class="btn btn-outline-secondary btn-file"><span class="fileinput-new">Select image</span>
                                            <span class="fileinput-exists">Change</span>
                                            <input type="file" name="logo"></span>
                                                <a href="#" class="btn btn-outline-secondary fileinput-exists"
                                                   data-dismiss="fileinput">Remove</a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">

                                        <input type="submit" value="Submit" class="btn btn-success float-right">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </section>
    {{--</div>--}}
@endsection
