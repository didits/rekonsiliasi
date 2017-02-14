<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="{{ URL::asset('material-kit/img/apple-icon.png') }}">
	<link rel="icon" type="image/png" href="{{ URL::asset('material-kit/img/favicon.png') }}">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>SI - ONENG | Login</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

	<!--     Fonts and icons     -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

	<!-- CSS Files -->
    <link href="{{ URL::asset('material-kit/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('material-kit/css/material-kit.css') }}" rel="stylesheet"/>

</head>

@yield('content')
    
	<!--   Core JS Files   -->
	<script src="{{ URL::asset('material-kit/js/jquery.min.js') }}" type="text/javascript"></script>
	<script src="{{ URL::asset('material-kit/js/bootstrap.min.js') }}" type="text/javascript"></script>
	<script src="{{ URL::asset('material-kit/js/material.min.js') }}"></script>

	<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
	<script src="{{ URL::asset('material-kit/js/nouislider.min.js') }}" type="text/javascript"></script>

	<!--  Plugin for the Datepicker, full documentation here: http://www.eyecon.ro/bootstrap-datepicker/ -->
	<script src="{{ URL::asset('material-kit/js/bootstrap-datepicker.js') }}" type="text/javascript"></script>

	<!-- Control Center for Material Kit: activating the ripples, parallax effects, scripts from the example pages etc -->
	<script src="{{ URL::asset('material-kit/js/material-kit.js') }}" type="text/javascript"></script>

</html>
