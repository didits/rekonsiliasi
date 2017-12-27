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
                                    {{--<p>Update</p>--}}
                                    {{--<span>--}}
                                        {{--<button type="button" class="btn btn-primary btn-fill">--}}
                                            {{--<i class="fa fa-history"></i>--}}
                                        {{--</button>--}}
                                    {{--</span>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title" style="text-align: center;">Deviasi Meter Utama</h4><!-- 
                                    <p class="category" style="text-align: center;">Bulan {{date("F")}}</p> -->
                                </div>
                                <div class="content">
                                    <div id="lingkDev" class="ct-chart "></div>
                                </div>
                                <!-- <div class="footer">
                                    <div class="legend">
                                        <i class="fa fa-circle text-info"></i> Normal
                                        <i class="fa fa-circle text-danger"></i> Tidak Normal
                                    </div>
                                    <div class="legend">
                                        <i class="fa fa-circle text-info"></i> GI Normal: {{isset($deviasi)?$deviasi[0][1]:0}}
                                        <br/>
                                        <i class="fa fa-circle text-danger"></i> GI Tidak Normal: {{isset($deviasi)?$deviasi[1][1]:0}}
                                        <br/>
                                        <i class="fa fa-circle text-success"></i> Total GI: {{isset($deviasi)?$deviasi[2]:0}}
                                    </div>
                                    <hr>
                                    {{--<div class="stats">--}}
                                        {{--<i class="fa fa-history"></i> Terupdate--}}
                                    {{--</div>--}}
                                </div> -->
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title" style="text-align: center;">Susut GI</h4><!-- 
                                    <p class="category" style="text-align: center;">Bulan {{date("F")}}</p> -->
                                </div>
                                <div class="content">
                                    <div id="lingkSusut" class="ct-chart "></div>
                                </div>
                                <!-- <div class="footer">
                                    <div class="legend">
                                        <i class="fa fa-circle text-info"></i> Susut < 6%
                                        <i class="fa fa-circle text-danger"></i> Susut > 6%
                                    </div>
                                    <div class="legend">
                                        <i class="fa fa-circle text-info"></i> GI dgn Susut < 6%: {{isset($susut)?$susut[0][1]:0}}
                                        <br/>
                                        <i class="fa fa-circle text-danger"></i> GI dgn Susut > 6%: {{isset($susut)?$susut[1][1]:0}}
                                        <br/>
                                        <i class="fa fa-circle text-success"></i> Total GI: {{isset($susut)?$susut[2]:0}}
                                    </div>
                                    <hr>
                                    {{--<div class="stats">--}}
                                        {{--<i class="fa fa-history"></i> Terupdate--}}
                                    {{--</div>--}}
                                </div> -->
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
<script src="{{ URL::asset('dashboard/js/canvasjs.min.js') }}"></script>
@endsection

@section('extra_script')

<script type="text/javascript">
    {{--function initDashboardPageCharts(){--}}

        {{--// Pie Chart--}}
        {{--Chartist.Pie('#lingkDev', {--}}
            {{--labels: ['{{isset($deviasi)?$deviasi[0][0]:0}}% GI NORMAL','{{isset($deviasi)?$deviasi[1][0]:0}}% GI TIDAK NORMAL'],--}}
            {{--series: [{{isset($deviasi)?$deviasi[0][0]:0}}, {{isset($deviasi)?$deviasi[1][0]:0}}]--}}
        {{--});--}}
        {{--Chartist.Pie('#lingkSusut', {--}}
            {{--labels: ['{{isset($susut)?$susut[0][0]:0}}% SUSUT NORMAL','{{isset($susut)?$susut[1][0]:0}}% SUSUT TIDAK NORMAL'],--}}
            {{--series: [{{isset($susut)?$susut[0][0]:0}}, {{isset($susut)?$susut[1][0]:0}}]--}}
        {{--});--}}
    {{--}--}}
    {{--$(document).ready(function(){--}}
        {{--initDashboardPageCharts();--}}
    {{--});--}}
    window.onload = function () {

        var chartDev = new CanvasJS.Chart("lingkDev", {
            exportEnabled: true,
            animationEnabled: true,
            title:{
                text: "{{date("F Y")}}"
            },
            legend:{
                cursor: "pointer",
                itemclick: explodePie
            },
            data: [{
                type: "pie",
                showInLegend: false,
                toolTipContent: "{name}: <strong>{y}%</strong>",
                indexLabel: "{name} - {y}%",
                dataPoints: [
                    { y: {{isset($deviasi)?$deviasi[0][0]:0}}, name: "GI Normal: {{isset($deviasi)?$deviasi[0][1]:0}}"  },
                    { y: {{isset($deviasi)?$deviasi[1][0]:0}}, name: "GI Tidak Normal: {{isset($deviasi)?$deviasi[1][1]:0}}", exploded: true }
                ]
            }]
        });
        chartDev.render();

        var chartSut = new CanvasJS.Chart("lingkSusut", {
            exportEnabled: true,
            animationEnabled: true,
            title:{
                text: "{{date("F Y")}}"
            },
            legend:{
                cursor: "pointer",
                itemclick: explodePie
            },
            data: [{
                type: "pie",
                showInLegend: false,
                toolTipContent: "{name}: <strong>{y}%</strong>",
                indexLabel: "{name} - {y}%",
                dataPoints: [
                    { y: {{isset($susut)?$susut[0][0]:0}}, name: "Susut Normal: {{isset($susut)?$susut[0][1]:0}}" },
                    { y: {{isset($susut)?$susut[1][0]:0}}, name: "Susut Tidak Normal: {{isset($susut)?$susut[1][1]:0}}", exploded: true }
                ]
            }]
        });
        chartSut.render();
    };

    function explodePie (e) {
        if(typeof (e.dataSeries.dataPoints[e.dataPointIndex].exploded) === "undefined" || !e.dataSeries.dataPoints[e.dataPointIndex].exploded) {
            e.dataSeries.dataPoints[e.dataPointIndex].exploded = true;
        } else {
            e.dataSeries.dataPoints[e.dataPointIndex].exploded = false;
        }
        e.chart.render();

    }
</script>
@endsection