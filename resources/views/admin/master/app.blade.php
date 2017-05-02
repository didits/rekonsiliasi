<html>
    <head>
        <title>SI - ONENG | Dashboard - @yield('title')</title>
        <meta charset="utf-8" />
        <link rel="icon" type="image/png" href="{{ URL::asset('dashboard/img/favicon.ico') }}">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />


        <!-- Bootstrap core CSS     -->
        <link href="{{ URL::asset('dashboard/css/bootstrap.min.css') }}" rel="stylesheet" />


        <!-- Animation library for notifications   -->
        <link href="{{ URL::asset('dashboard/css/animate.min.css') }}" rel="stylesheet"/>

        <!--  Light Bootstrap Table core CSS    -->
        <link href="{{ URL::asset('dashboard/css/light-bootstrap-dashboard.css') }}" rel="stylesheet"/>


        <!--  CSS for Demo Purpose, don't include it in your project     -->
        {{--<link href="{{ URL::asset('dashboard/css/demo.css') }}" rel="stylesheet" />--}}
        {{--<link href="{{ URL::asset('css/universal.css') }}" rel="stylesheet" />--}}

        <!--     Fonts and icons     -->
        <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
        <link href="{{ URL::asset('dashboard/css/pe-icon-7-stroke.css') }}" rel="stylesheet" />
        </head>
    <body>


        @yield('content')

    </body>

    <script src="{{ URL::asset('dashboard/js/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('dashboard/js/jquery-ui.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('dashboard/js/bootstrap.min.js') }}" type="text/javascript"></script>

    <!--  Forms Validations Plugin -->
    <script src="{{ URL::asset('dashboard/js/jquery.validate.min.js') }}"></script>

    <!--  Checkbox, Radio & Switch Plugins -->
    <script src="{{ URL::asset('dashboard/js/bootstrap-checkbox-radio-switch.js') }}"></script>

    <!--  Charts Plugin -->
    <script src="{{ URL::asset('dashboard/js/chartist.min.js') }}"></script>

    <!--  Notifications Plugin    -->
    <script src="{{ URL::asset('dashboard/js/bootstrap-notify.js') }}"></script>

    <!--  Select Picker Plugin -->
    <script src="{{ URL::asset('dashboard/js/bootstrap-selectpicker.js') }}"></script>

    <!--  Google Maps Plugin    -->
    {{--<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>--}}

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
    <script src="{{ URL::asset('dashboard/js/light-bootstrap-dashboard.js') }}"></script>

    <script type="text/javascript">
        $().ready(function(){

            $('#registerFormValidation').validate();

        });
    </script>

    <!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
{{--    <script src="{{ URL::asset('dashboard/js/demo.js') }}"></script>--}}

    <script type="text/javascript">
        $(document).ready(function(){

//            demo.initChartist();

            @if (session('notification'))
                $.notify({
                icon: '{{ session('icon') }}',
                message: "{{ session('notification') }}"
                },{
                type: 'info',
                timer: 4000
                });
            @endif
        });
    </script>
</html> 