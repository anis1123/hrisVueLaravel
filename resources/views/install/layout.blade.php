<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		 <!-- CSRF Token -->
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<title>Install</title>
		<meta name="keywords" content="{{ isset($page) ? $page->content[0]->seo_meta_keywords : 'school' }}"/>
		<meta name="description" content="{{ isset($page) ? $page->content[0]->seo_meta_description : 'school website' }}"/>

		<!-- Google font -->
		<link href="https://fonts.googleapis.com/css?family=Lato:700%7CMontserrat:400,600" rel="stylesheet">

		<!-- Bootstrap -->
		<link href="{{asset('install/css/material-dashboard.minf066.css')}}" rel="stylesheet" media="all"/>



		<!-- Custom stlylesheet -->
		<link type="text/css" rel="stylesheet" href="{{ asset('install/css/style.css') }}"/>
		<link rel="stylesheet" href="{{asset('install/css/loader.css')}}" >

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

    </head>
	<body>
    <div class="container-fluid">
        <div class="row">
            <div class="install-container col-md-6">
                @yield('content')
            </div>
        </div>
        <div class="row" >
            <div class="container-fluid table-info" id="loading" style="display: none;background:#81e5fe;">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card table-info">
                            <div class="card-header card-header-info card-header-text ">
                                <div class="card-text col-sm-12">
                                    <h2 class="card-title ">
                                        <div class="loader">
                                            <center><small><small><small><span>{ Load</span><span>ing }</span></small></small></small></center>
                                        </div>
                                    </h2>
                                    <br>
                                </div>
                            </div>
                            <div class="card-body table-info">
                                <div class="toolbar">
                                </div>
                                <div class="material-datatables table-info">
                                    <div class="loader">
                                        <center><small><small><small><small><span>{ Load</span><span>ing }</span></small></small></small></small></center>
                                    </div>
                                    <!-- end content-->
                                </div>
                                <!--  end card  -->
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>








		<!-- jQuery Plugins -->
		<script type="text/javascript" src="{{ asset('install/js/jquery.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('install/js/bootstrap.min.js') }}"></script>
		@yield('js-script')
	</body>
</html>
