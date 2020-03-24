@extends('backend.layouts.loginpage')



@section('content')
    <style>
        body, html {
            background-image: url('https://i.imgur.com/xhiRfL6.jpg');
            height: 100%;
        }

        #profile-img {
            height: 180px;
        }

        .h-80 {
            height: 80% !important;
        }
    </style>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->

    <div class="container h-80">
        <div class="row align-items-center h-100">
            <div class="col-3 mx-auto">
                <div class="text-center">
                    <img id="profile-img" class="rounded-circle profile-img-card"
                         src="https://i.imgur.com/6b6psnA.png"/>
                    <p id="profile-name" class="profile-name-card"></p>
                    <form class="form-signin" action="{{ route('admin-login') }}" method="POST">


                        <input type="email" name="email" id="email"
                               class="form-control form-group{{ $errors->has('email') ? ' is-invalid' : '' }}"
                               placeholder="Username" required autofocus>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('email') }}</strong>
                                                            </span>

                        @endif
                        <input type="password" name="password" id="inputPassword"
                               class="form-control form-group{{ $errors->has('password') ? ' is-invalid' : '' }}"
                               placeholder="Password" required autofocus>
                        @if ($errors->has('password'))--}}

                        <span class="invalid-feedback">

                                                                <strong>{{ $errors->first('password') }}</strong>

                                                            </span>

                        @endif
{{--                        <div class="form-group row">--}}

{{--                            <div class="col-md-6 offset-md-4">--}}
                                <div class="checkbox float-left">
                                    <label><font color="white">
                                        <input type="checkbox"
                                               name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                                        </font> </label>
                                </div>
{{--                            </div>--}}

{{--                        </div>--}}
                        <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Enter</button>
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            <font color="white">
                            {{ __('Forgot Your Password?') }}
                            </font>
                        </a>
                    </form><!-- /form -->
                </div>
            </div>
        </div>
    </div>
    {{--    <div class="container">--}}
    {{--<h3 class="text-center">This is superadmin panel</h3>--}}
    {{--        <div class="row justify-content-center">--}}

    {{--            <div class="col-md-8">--}}

    {{--                <div class="card">--}}

{{--                        <div class="card-header">Admin {{ __('Login') }}</div>--}}



    {{--                    <div class="card-body">--}}

    {{--                        <form method="POST" action="{{ route('admin-login') }}">--}}

    {{--                            @csrf--}}



    {{--                            <div class="form-group row">--}}

    {{--                                <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}



    {{--                                <div class="col-md-6">--}}

    {{--                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>--}}



    {{--                                    @if ($errors->has('email'))--}}

    {{--                                        <span class="invalid-feedback">--}}

    {{--                                        <strong>{{ $errors->first('email') }}</strong>--}}

    {{--                                    </span>--}}

    {{--                                    @endif--}}

    {{--                                </div>--}}

    {{--                            </div>--}}



    {{--                            <div class="form-group row">--}}

    {{--                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}



    {{--                                <div class="col-md-6">--}}

    {{--                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>--}}



    {{--                                    @if ($errors->has('password'))--}}

    {{--                                        <span class="invalid-feedback">--}}

    {{--                                        <strong>{{ $errors->first('password') }}</strong>--}}

    {{--                                    </span>--}}

    {{--                                    @endif--}}

    {{--                                </div>--}}

    {{--                            </div>--}}



    {{--                            <div class="form-group row">--}}

    {{--                                <div class="col-md-6 offset-md-4">--}}

    {{--                                    <div class="checkbox">--}}

    {{--                                        <label>--}}

    {{--                                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}--}}

    {{--                                        </label>--}}

    {{--                                    </div>--}}

    {{--                                </div>--}}

    {{--                            </div>--}}



    {{--                            <div class="form-group row mb-0">--}}

    {{--                                <div class="col-md-8 offset-md-4">--}}

    {{--                                    <button type="submit" class="btn btn-primary">--}}

    {{--                                        {{ __('Login') }}--}}

    {{--                                    </button>--}}

    {{--                                    <a class="btn btn-link" href="{{ route('password.request') }}">--}}

    {{--                                        {{ __('Forgot Your Password?') }}--}}

    {{--                                    </a>--}}

    {{--                                </div>--}}

    {{--                            </div>--}}

    {{--                        </form>--}}

    {{--                    </div>--}}

    {{--                </div>--}}

    {{--            </div>--}}

    {{--        </div>--}}

    {{--    </div>--}}

@endsection
