<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="http://demos.creative-tim.com/light-bootstrap-dashboard-pro/assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>SI - ONENG | Dashboard - Login</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	<meta name="viewport" content="width=device-width" />


	<!-- Canonical SEO -->
	<link rel="canonical" href="https://www.creative-tim.com/product/light-bootstrap-dashboard-pro"/>

	<!--  Social tags      -->
	<meta name="keywords" content="creative tim, html dashboard, html css dashboard, web dashboard, bootstrap dashboard, bootstrap, css3 dashboard, bootstrap admin, light bootstrap dashboard, frontend, responsive bootstrap dashboard">

	<meta name="description" content="Forget about boring dashboards, get an admin template designed to be simple and beautiful.">

	<!-- Schema.org markup for Google+ -->
	<meta itemprop="name" content="Light Bootstrap Dashboard PRO by Creative Tim">
	<meta itemprop="description" content="Forget about boring dashboards, get an admin template designed to be simple and beautiful.">

	<meta itemprop="image" content="http://s3.amazonaws.com/creativetim_bucket/products/34/original/opt_lbd_pro_thumbnail.jpg">
	<!-- Twitter Card data -->

	<meta name="twitter:card" content="product">
	<meta name="twitter:site" content="@creativetim">
	<meta name="twitter:title" content="Light Bootstrap Dashboard PRO by Creative Tim">

	<meta name="twitter:description" content="Forget about boring dashboards, get an admin template designed to be simple and beautiful.">
	<meta name="twitter:creator" content="@creativetim">
	<meta name="twitter:image" content="http://s3.amazonaws.com/creativetim_bucket/products/34/original/opt_lbd_pro_thumbnail.jpg">
	<meta name="twitter:data1" content="Light Bootstrap Dashboard PRO by Creative Tim">
	<meta name="twitter:label1" content="Product Type">
	<meta name="twitter:data2" content="$29">
	<meta name="twitter:label2" content="Price">

	<!-- Open Graph data -->
	<meta property="og:title" content="Light Bootstrap Dashboard PRO by Creative Tim" />
	<meta property="og:type" content="article" />
	<meta property="og:url" content="{{url('/')}}" />
	<meta property="og:image" content="http://s3.amazonaws.com/creativetim_bucket/products/34/original/opt_lbd_pro_thumbnail.jpg"/>
	<meta property="og:description" content="Forget about boring dashboards, get an admin template designed to be simple and beautiful." />
	<meta property="og:site_name" content="Creative Tim" />


	<!-- Bootstrap core CSS     -->
	<link href="{{ URL::asset('dashboard/css/bootstrap.min.css') }}" rel="stylesheet" />

	<!--  Light Bootstrap Dashboard core CSS    -->
	<link href="{{ URL::asset('dashboard/css/light-bootstrap-dashboard.css') }}" rel="stylesheet"/>

	<!--  CSS for Demo Purpose, don't include it in your project     -->
	{{--<link href="../../assets/css/demo.css" rel="stylesheet" />--}}


	<!--     Fonts and icons     -->
	<link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
	<link href="{{ URL::asset('dashboard/css/pe-icon-7-stroke.css') }}" rel="stylesheet" />

</head>

@yield('content')

	<!--   Core JS Files and PerfectScrollbar library inside jquery.ui   -->
	<script src="{{ URL::asset('dashboard/js/jquery.min.js') }}" type="text/javascript"></script>
	<script src="{{ URL::asset('dashboard/js/jquery-ui.min.js') }}" type="text/javascript"></script>
	<script src="{{ URL::asset('dashboard/js/bootstrap.min.js') }}" type="text/javascript"></script>

	<!--  Forms Validations Plugin -->
	<script src="{{ URL::asset('dashboard/js/jquery.validate.min.js') }}"></script>

	<!--  Plugin for Date Time Picker and Full Calendar Plugin-->
	<script src="{{ URL::asset('dashboard/js/moment.min.js') }}"></script>

	<!--  Date Time Picker Plugin is included in this js file -->
	<script src="{{ URL::asset('dashboard/js/bootstrap-datetimepicker.js') }}"></script>

	<!--  Select Picker Plugin -->
	<script src="{{ URL::asset('dashboard/js/bootstrap-selectpicker.js') }}"></script>

	<!--  Checkbox, Radio, Switch and Tags Input Plugins -->
	<script src="{{ URL::asset('dashboard/js/bootstrap-checkbox-radio-switch-tags.js') }}"></script>

	<!--  Charts Plugin -->
	<script src="{{ URL::asset('dashboard/js/chartist.min.js') }}"></script>

	<!--  Notifications Plugin    -->
	<script src="{{ URL::asset('dashboard/js/bootstrap-notify.js') }}"></script>

	<!-- Sweet Alert 2 plugin -->
	<script src="{{ URL::asset('dashboard/js/sweetalert2.js') }}"></script>

	<!-- Vector Map plugin -->
	<script src="{{ URL::asset('dashboard/js/jquery-jvectormap.js') }}"></script>

	<!--  Google Maps Plugin    -->
	{{--<script src="https://maps.googleapis.com/maps/api/js"></script>--}}

	<!-- Wizard Plugin    -->
	<script src="{{ URL::asset('dashboard/js/jquery.bootstrap.wizard.min.js') }}"></script>

	<!--  Datatable Plugin    -->
	<script src="{{ URL::asset('dashboard/js/bootstrap-table.js') }}"></script>

	<!--  Full Calendar Plugin    -->
	<script src="{{ URL::asset('dashboard/js/fullcalendar.min.js') }}"></script>

	<!-- Light Bootstrap Dashboard Core javascript and methods -->
	<script src="{{ URL::asset('dashboard/js/light-bootstrap-dashboard.js') }}"></script>

	<!--   Sharrre Library    -->
	<script src="{{ URL::asset('dashboard/js/jquery.sharrre.js') }}"></script>

	<!-- Light Bootstrap Dashboard DEMO methods, don't include it in your project! -->
	{{--<script src="{{ URL::asset('dashboard/js/demo.js') }}"></script>--}}
	<script type="text/javascript">
		$().ready(function(){
			lbd.checkFullPageBackgroundImage();

			setTimeout(function(){
				// after 1000 ms we add the class animated to the login/register card
				$('.card').removeClass('card-hidden');
			}, 700)
		});
	</script>
</html>
