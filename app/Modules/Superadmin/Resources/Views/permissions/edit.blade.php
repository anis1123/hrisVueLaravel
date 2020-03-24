@extends('backend.layouts.superadminbackend')

@section('title', get_company_info('company_name').' | Edit Permission')

@section('Body')

    <div class='col-lg-4 col-lg-offset-4'>

        <h1><i class='fa fa-key'></i> Edit {{$permission->name}}</h1>
        <br>
        <form method="POST" action="{{route('super.permissions.update', $permission->id)}}">
            @csrf
            {{method_field('PUT')}}
            <div class="form-group">
                <label for="name">Permission Name</label>
                <input class="form-control" name="name" type="text" value="{{$permission->name}}" id="name">
            </div>
            <br>
            <input class="btn btn-primary" type="submit" value="Edit">
        </form>
    </div>

@endsection
