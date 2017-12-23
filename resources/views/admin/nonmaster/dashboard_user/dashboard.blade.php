@extends('admin.master.app')
@section('title', 'Si-Oneng, Rekonsiliasi Energi')

@section('content')
    <div class="wrapper">
        @include('admin.master.top_navbar', ['navbartitle' => Auth::user()->nama_organisasi])

        @include('admin.master.navbar')

        <div class="main-panel">
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title">Dashboard</h4>
                                    <p class="category">Dashboard Bulan {{date("F")}}</p>
                                </div>
                                <div class="content">
                                    <p>Update</p>
                                    <span>
                                        <button type="button" class="btn btn-primary btn-fill">
                                            <i class="fa fa-history"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title">Statistik Deviasi</h4>
                                    <p class="category">Deviasi Bulan {{date("F")}}</p>
                                </div>
                                <div class="content">
                                    <div id="lingkDev" class="ct-chart "></div>
                                </div>
                                <div class="footer">
                                    <div class="legend">
                                        <i class="fa fa-circle text-info"></i> Normal
                                        <i class="fa fa-circle text-danger"></i> Tidak Normal
                                    </div>
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-history"></i> Terupdate
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="card ">
                                <div class="header">
                                    <h4 class="title">Statistik Deviasi</h4>
                                    <p class="category">Deviasi Bulan {{date("F")}}</p>
                                </div>
                                <div class="content">
                                    <div id="barDev" class="ct-chart"></div>
                                </div>
                                <div class="footer">
                                    <div class="legend">
                                        <i class="fa fa-circle text-info"></i> Normal
                                        <i class="fa fa-circle text-danger"></i> Tidak Normal
                                    </div>
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-history"></i> Terupdate
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title">Statistik Susut</h4>
                                    <p class="category">Deviasi Bulan {{date("F")}}</p>
                                </div>
                                <div class="content">
                                    <div id="lingkSusut" class="ct-chart "></div>
                                </div>
                                <div class="footer">
                                    <div class="legend">
                                        <i class="fa fa-circle text-info"></i> < 6%
                                        <i class="fa fa-circle text-danger"></i> > 6%
                                    </div>
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-history"></i> Terupdate
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="card ">
                                <div class="header">
                                    <h4 class="title">Statistik Susut</h4>
                                    <p class="category">Deviasi Bulan {{date("F")}}</p>
                                </div>
                                <div class="content">
                                    <div id="barSusut" class="ct-chart"></div>
                                </div>
                                <div class="footer">
                                    <div class="legend">
                                        <i class="fa fa-circle text-info"></i> < 6%
                                        <i class="fa fa-circle text-danger"></i> > 6%
                                    </div>
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-history"></i> Terupdate
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include('admin.master.footer')

        </div>
    </div>
@endsection

@section('extra_plugin')

<!--  Charts Plugin -->
<script src="{{ URL::asset('dashboard/js/chartist.min.js') }}"></script>
@endsection

@section('extra_script')

<script type="text/javascript">
    function initDashboardPageCharts(){


        /*   **************** Email Statistics - Pie Chart ********************    */

        var dataPreferences = {
            series: [
                [25, 30, 20, 25]
            ]
        };

        var optionsPreferences = {
            donut: true,
            donutWidth: 40,
            startAngle: 0,
            height: "245px",
            total: 100,
            showLabel: false,
            axisX: {
                showGrid: false
            }
        };

//        Chartist.Pie('#lingkDev', dataPreferences, optionsPreferences);

        Chartist.Pie('#lingkDev', {
            labels: ['62%','32%','6%'],
            series: [62, 32, 6]
        });
        Chartist.Pie('#lingkSusut', {
            labels: ['62%','32%','6%'],
            series: [62, 32, 6]
        });

        /*   **************** 2014 Sales - Bar Chart ********************    */

        var data = {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mai', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            series: [
                [542, 443, 320, 780, 553, 453, 326, 434, 568, 610, 756, 895],
                [412, 243, 280, 580, 453, 353, 300, 364, 368, 410, 636, 695]
            ]
        };

        var options = {
            seriesBarDistance: 10,
            axisX: {
                showGrid: false
            },
            height: "245px"
        };

        var responsiveOptions = [
            ['screen and (max-width: 640px)', {
                seriesBarDistance: 5,
                axisX: {
                    labelInterpolationFnc: function (value) {
                        return value[0];
                    }
                }
            }]
        ];

        Chartist.Bar('#barDev', data, options, responsiveOptions);
        Chartist.Bar('#barSusut', data, options, responsiveOptions);

    }
    $(document).ready(function(){
        initDashboardPageCharts();
    });
</script>
@endsection