<html>
    <head>
        <title>SI - ONENG | Dashboard - @yield('title')</title>
        <meta charset="utf-8" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" type="image/png" href="{{ URL::asset('dashboard/img/favicon.ico') }}">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
 
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />

        {{--<!-- Bootstrap core CSS     -->--}}
        <link href="{{ URL::asset('dashboard/css/bootstrap.min.css') }}" rel="stylesheet" />

        {{--<!-- Animation library for notifications   -->--}}
        <link href="{{ URL::asset('dashboard/css/animate.min.css') }}" rel="stylesheet"/>

        {{--<!--  Light Bootstrap Table core CSS    -->--}}
        <link href="{{ URL::asset('dashboard/css/light-bootstrap-dashboard.css') }}" rel="stylesheet"/>

        {{--<!--  CSS for Demo Purpose, don't include it in your project     -->--}}
        <link href="{{ URL::asset('dashboard/css/demo.css') }}" rel="stylesheet" />
        {{--<link href="{{ URL::asset('css/universal.css') }}" rel="stylesheet" />--}}

        {{--<!--     Fonts and icons     -->--}}
        <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
        <link href="{{ URL::asset('dashboard/css/pe-icon-7-stroke.css') }}" rel="stylesheet" />
        @yield('extra_style')

    </head>
    <body>
        @yield('content')

    </body>

    <script src="{{ URL::asset('dashboard/js/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('dashboard/js/jquery-ui.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('dashboard/js/bootstrap.min.js') }}" type="text/javascript"></script>

    {{--<!--  Forms Validations Plugin -->--}}
    <script src="{{ URL::asset('dashboard/js/jquery.validate.min.js') }}"></script>

    {{--<!--  Checkbox, Radio & Switch Plugins -->--}}
    <script src="{{ URL::asset('dashboard/js/bootstrap-checkbox-radio-switch.js') }}"></script>

    {{--<!--  Charts Plugin -->--}}
    <script src="{{ URL::asset('dashboard/js/chartist.min.js') }}"></script>

    {{--<!--  Notifications Plugin    -->--}}
    <script src="{{ URL::asset('dashboard/js/bootstrap-notify.js') }}"></script>

    {{--<!--  Select Picker Plugin -->--}}
    <script src="{{ URL::asset('dashboard/js/bootstrap-selectpicker.js') }}"></script>

    {{--<!--  Bootstrap Table Plugin    -->--}}
    <script src="{{ URL::asset('dashboard/js/bootstrap-table.js') }}"></script>

    {{--<!--  Google Maps Plugin    -->--}}
    {{--<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>--}}

    @yield('extra_plugin')

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
    <script src="{{ URL::asset('dashboard/js/light-bootstrap-dashboard.js') }}"></script>

    <script type="text/javascript">
        $().ready(function(){

            $('#registerFormValidation').validate();

        });
    </script>

    <script type="text/javascript">
        var $table = $('#bootstrap-table');

        function operateFormatter(value, row, index) {
            return [
                '<a rel="tooltip" title="View" class="btn btn-simple btn-info btn-icon table-action view" href="javascript:void(0)">',
                '<i class="fa fa-image"></i>',
                '</a>',
                '<a rel="tooltip" title="Edit" class="btn btn-simple btn-warning btn-icon table-action edit" href="javascript:void(0)">',
                '<i class="fa fa-edit"></i>',
                '</a>',
                '<a rel="tooltip" title="Remove" class="btn btn-simple btn-danger btn-icon table-action remove" href="javascript:void(0)">',
                '<i class="fa fa-remove"></i>',
                '</a>'
            ].join('');
        }

        $().ready(function(){
            window.operateEvents = {
                'click .view': function (e, value, row, index) {
                    info = JSON.stringify(row);

                    swal('You click view icon, row: ', info);
                    console.log(info);
                },
                'click .edit': function (e, value, row, index) {
                    info = JSON.stringify(row);

                    swal('You click edit icon, row: ', info);
                    console.log(info);
                },
                'click .remove': function (e, value, row, index) {
                    console.log(row);
                    $table.bootstrapTable('remove', {
                        field: 'id',
                        values: [row.id]
                    });
                }
            };

            $table.bootstrapTable({
                toolbar: ".toolbar",
                clickToSelect: true,
                showRefresh: true,
                search: true,
                showToggle: true,
                showColumns: true,
                pagination: true,
                searchAlign: 'left',
                pageSize: 8,
                clickToSelect: false,
                pageList: [8,10,25,50,100],

                formatShowingRows: function(pageFrom, pageTo, totalRows){
                    //do nothing here, we don't want to show the text "showing x of y from..."
                },
                formatRecordsPerPage: function(pageNumber){
                    return pageNumber + " rows visible";
                },
                icons: {
                    refresh: 'fa fa-refresh',
                    toggle: 'fa fa-th-list',
                    columns: 'fa fa-columns',
                    detailOpen: 'fa fa-plus-circle',
                    detailClose: 'fa fa-minus-circle'
                }
            });

            //activate the tooltips after the data table is initialized
            $('[rel="tooltip"]').tooltip();

            $(window).resize(function () {
                $table.bootstrapTable('resetView');
            });


        });

    </script>

    {{--<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->--}}
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

    @yield('extra_script')

</html> 