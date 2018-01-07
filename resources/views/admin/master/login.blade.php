<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="http://demos.creative-tim.com/light-bootstrap-dashboard-pro/assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>SI - ONENG | Dashboard - Login</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	<meta name="viewport" content="width=device-width" />

	<!-- Bootstrap core CSS     -->
	<link href="{{ URL::asset('dashboard/css/bootstrap.min.css') }}" rel="stylesheet" />

	<!--  Light Bootstrap Dashboard core CSS    -->
	<link href="{{ URL::asset('dashboard/css/light-bootstrap-dashboard.css') }}" rel="stylesheet"/>

	<link href="{{ URL::asset('dashboard/css/select2.min.css') }}" rel="stylesheet"/>

	<!--  CSS for Demo Purpose, don't include it in your project     -->
	{{--<link href="../../assets/css/demo.css" rel="stylesheet" />--}}


	<!--     Fonts and icons     -->
	<link href="{{ URL::asset('dashboard/css/font-awesome.min.css') }}" rel="stylesheet">
	<link href='{{ URL::asset('dashboard/css/roboto.css') }}' rel='stylesheet' type='text/css'>
	<link href="{{ URL::asset('dashboard/css/pe-icon-7-stroke.css') }}" rel="stylesheet" />

</head>

@yield('content')

	<!--   Core JS Files and PerfectScrollbar library inside jquery.ui   -->
	<script src="{{ URL::asset('dashboard/js/jquery.min.js') }}" type="text/javascript"></script>
	<script src="{{ URL::asset('dashboard/js/jquery-ui.min.js') }}" type="text/javascript"></script>
	<script src="{{ URL::asset('dashboard/js/bootstrap.min.js') }}" type="text/javascript"></script>

	<!--  Forms Validations Plugin -->
	<script src="{{ URL::asset('dashboard/js/jquery.validate.min.js') }}"></script>

	<!-- Light Bootstrap Dashboard Core javascript and methods -->
	<script src="{{ URL::asset('dashboard/js/light-bootstrap-dashboard.js') }}"></script>

	<script src="{{ URL::asset('dashboard/js/select2.min.js') }}"></script>

	<!-- Light Bootstrap Dashboard DEMO methods, don't include it in your project! -->
	{{--<script src="{{ URL::asset('dashboard/js/demo.js') }}"></script>--}}
	<script type="text/javascript">
		$().ready(function(){
			lbd.checkFullPageBackgroundImage();

			setTimeout(function(){
				// after 1000 ms we add the class animated to the login/register card
				$('.card').removeClass('card-hidden');
			}, 700);

            $('.select2').select2();
		});
	</script>
</html>
