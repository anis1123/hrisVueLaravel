@extends('backend.layouts.adminbackend')
@section('title',' Admin-Dashboard')
@section('content')
    <br>
    <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-list-alt"></i></span>
                    {{--                    <a href="{{route('semester.index')}}">--}}
                    <div class="info-box-content">
                        <span class="info-box-text" style="color: black">Users</span>
                        <span class="info-box-number">
                  {{$users}}

                </span>
                    </div>
                {{--                    </a>--}}
                <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-flag-checkered"></i></span>
                    {{--                    <a href="{{route('notice.index')}}">--}}
                    <div class="info-box-content">
                        <span class="info-box-text" style="color: black">Notice</span>
                        {{--                            <span class="info-box-number">{{count(get_notices())}}</span>--}}
                    </div>
                {{--                    </a>--}}
                <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>

            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-newspaper"></i></span>
                    {{--                    <a href="{{route('news_and_events.index')}}">--}}
                    <div class="info-box-content">
                        <span class="info-box-text" style="color: black">News and Events</span>
                        {{--                            <span class="info-box-number">{{count(get_news_and_events())}}</span>--}}
                    </div>
                {{--                    </a>--}}
                <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-question-circle"></i></span>
                    {{--                    <a href="{{route('enquiry.index')}}">--}}
                    <div class="info-box-content">
                        <span class="info-box-text" style="color: black">Enquiries</span>
                        {{--                            <span class="info-box-number">{{count(get_enquiries())}}</span>--}}
                    </div>
                {{--                    </a>--}}
                <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->


    </div><!--/. container-fluid -->
@endsection
