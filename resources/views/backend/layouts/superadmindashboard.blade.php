@extends('backend.layouts.superadminbackend')
@section('title',' SuperAdmin-Dashboard')
@section('content')
    <br>
    <div class="container-fluid">
{{--        <div class="clearfix"></div><hr />--}}
        <div class="col-md-3" style="margin-right: auto;margin-left: auto">
            <div class="card text-white">
                <div class="card-body text-center" style="background-color: #ceddeb!important;color: #40217a!important">
                    <p class="card-title mt-2" style="font-size: 42px">
                        <a><span class="badge hours"></span></a> :
                        <a><span class="badge min"></span></a> :
                        <a><span class="badge sec"></span></a>
                    </p>
                </div>
            </div>
        </div>
        <!-- Info boxes -->
        <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-list-alt"></i></span>
{{--                    <a href="{{route('semester.index')}}">--}}
                        <div class="info-box-content">
                            <span class="info-box-text" style="color: black">Company</span>
                            <span class="info-box-number">
                  {{count($companies)}}

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
                            <span class="info-box-text" style="color: black">Users</span>
                            <span class="info-box-number">{{count($users)}}</span>
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
@section('script')
    <script>
        $(document).ready(function() {
            setInterval( function() {
                var hours = new Date().getHours();
                $(".hours").html(( hours < 10 ? "0" : "" ) + hours);
            }, 1000);
            setInterval( function() {
                var minutes = new Date().getMinutes();
                $(".min").html(( minutes < 10 ? "0" : "" ) + minutes);
            },1000);
            setInterval( function() {
                var seconds = new Date().getSeconds();
                $(".sec").html(( seconds < 10 ? "0" : "" ) + seconds);
            },1000);
        });
    </script>
@endsection
