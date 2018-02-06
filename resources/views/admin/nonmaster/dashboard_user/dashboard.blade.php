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
                                    <p class="category">Dashboard Bulan {{$date}}</p>
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
                                    {{--<h4 class="title" style="text-align: center;">Deviasi Meter Utama</h4>--}}
                                    {{--<p class="category" style="text-align: center;">Deviasi Bulan {{$date}}</p>--}}
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
                                <div class="footer">
                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">GI Normal:</label>
                                            <div class="col-sm-8">
                                                <input type="text" placeholder="{{isset($deviasi)?$deviasi[0][1]:0}}" disabled="" class="form-control">
                                            </div>
                                        </div>
                                    </fieldset>
                                    <br/>
                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">GI Tidak Normal:</label>
                                            <div class="col-sm-8">
                                                <input type="text" placeholder="{{isset($deviasi)?$deviasi[1][1]:0}}" disabled="" class="form-control">
                                            </div>
                                        </div>
                                    </fieldset>
                                    <br/>
                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Total GI:</label>
                                            <div class="col-sm-8">
                                                <input type="text" placeholder="{{isset($deviasi)?$deviasi[2]:0}}" disabled="" class="form-control">
                                            </div>
                                        </div>
                                    </fieldset>
                                    {{--<div class="legend">--}}
                                        {{--<i class="fa fa-circle text-info"></i> GI Normal: {{isset($deviasi)?$deviasi[0][1]:0}}--}}
                                        {{--<br/>--}}
                                        {{--<i class="fa fa-circle text-danger"></i> GI Tidak Normal: {{isset($deviasi)?$deviasi[1][1]:0}}--}}
                                        {{--<br/>--}}
                                        {{--<i class="fa fa-circle text-success"></i> Total GI: {{isset($deviasi)?$deviasi[2]:0}}--}}
                                    {{--</div>--}}
>>>>>>> bde504d50cef442f8e6ebfd1c7144fdc17ecbc6b
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
                                    {{--<h4 class="title" style="text-align: center;">Susut GI</h4>--}}
                                    {{--<p class="category" style="text-align: center;">Deviasi Bulan {{$date}}</p>--}}
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
                                <div class="footer">
                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">GI dgn Susut < 6%:</label>
                                            <div class="col-sm-8">
                                                <input type="text" placeholder="{{isset($susut)?$susut[0][1]:0}}" disabled="" class="form-control">
                                            </div>
                                        </div>
                                    </fieldset>
                                    <br/>
                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">GI dgn Susut > 6%:</label>
                                            <div class="col-sm-8">
                                                <input type="text" placeholder="{{isset($susut)?$susut[1][1]:0}}" disabled="" class="form-control">
                                            </div>
                                        </div>
                                    </fieldset>
                                    <br/>
                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Total GI:</label>
                                            <div class="col-sm-8">
                                                <input type="text" placeholder="{{isset($susut)?$susut[2]:0}}" disabled="" class="form-control">
                                            </div>
                                        </div>
                                    </fieldset>
                                    <div class="legend">
                                        <i class="fa fa-circle text-info"></i> GI dgn Susut < 6%: {{isset($susut)?$susut[0][1]:0}}
                                        <br/>
                                        <i class="fa fa-circle text-danger"></i> GI dgn Susut > 6%: {{isset($susut)?$susut[1][1]:0}}
                                        <br/>
                                        <i class="fa fa-circle text-success"></i> Total GI: {{isset($susut)?$susut[2]:0}}
                                    </div>
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-history"></i> Terupdate
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div>
                <div class="container-fluid">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                @if($distribusi)
                                <h4 class="title">Daftar Area</h4>
                                <p class="category">{{Auth::user()->nama_organisasi}}</p>
                                @else
                                <h4 class="title">Area {{Auth::user()->nama_organisasi}}</h4>
                                {{--<p class="category"></p>--}}
                                @endif
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                    <th>AREA</th>
                                    <th class="text-right">LAST UPDATE</th>
                                    <th class="text-right">UPDATE DATA GI</th>
                                    </thead>
                                    <tbody>
                                    @for($i=0;$i<count($data) ;$i++)
                                        <tr>
{{--                                            {{dd($distribusi)}}--}}
                                            @if($distribusi)
                                            <td>{{$data[$i]['nama_organisasi']}}</td>
                                            {{--                                            {{dd($time[0][0])}}--}}
                                            <td class="text-right">{{$time[$i][0]}}</td>
                                            <td>
                                                <a href="{{route('distribusi.reload', $data[$i]['id_organisasi'])}}" rel="tooltip" title="" data-original-title="List Rayon" class="btn btn-info btn-fill pull-right" >
                                                    <i class="fa fa-rotate-right"></i>
                                                </a>
                                            </td>
                                            @else
                                            <td>{{$data}}</td>
                                            {{--                                            {{dd($time[0][0])}}--}}
                                            <td class="text-right">{{$time[0]}}</td>
                                            <td>
                                                <a href="{{route('area.reload', Auth::user()->id_organisasi)}}" rel="tooltip" title="" data-original-title="List Rayon" class="btn btn-info btn-fill pull-right" >
                                                    <i class="fa fa-rotate-right"></i>
                                                </a>
                                            </td>
                                            @endif
                                        </tr>
                                    @endfor
                                    </tbody>
                                </table>

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
                text: "{{$date}}"
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
                    { y:  {{number_format($persen_dev*100,2)}}, name: "GI Normal:{{($deviasi)}}" },
                    { y: {{(number_format((1-$persen_dev)*100,2))}}, name: "GI Tidak Normal: {{($jumlah_gi-$deviasi)}}", exploded: true },
                    {{--{ y: {{isset($deviasi)?$deviasi[0][0]:0}}, name: "GI Normal: {{isset($deviasi)?$deviasi[0][1]:0}}" },--}}
                    {{--{ y: {{isset($deviasi)?$deviasi[1][0]:0}}, name: "GI Tidak Normal: {{isset($deviasi)?$deviasi[1][1]:0}}", exploded: true },--}}
                    {{--{ y: 0, name: "Total GI: {{isset ($deviasi)?$deviasi[2]:0}}" }--}}
                ]
            }]
        });
        chartDev.render();

        var chartSut = new CanvasJS.Chart("lingkSusut", {
            exportEnabled: true,
            animationEnabled: true,
            title:{
                text: "{{$date}}"
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
                    { y: {{number_format($persen_susut*100,2)}}, name: "GI Normal: {{$susut}}" },
                    { y: {{number_format((1-$persen_susut)*100,2)}}, name: "GI Tidak Normal: {{($jumlah_gi-$susut)}}", exploded: true },
                    {{--{ y: {{isset($susut)?$susut[0][0]:0}}, name: "Susut Normal: {{isset($susut)?$susut[0][1]:0}}" },--}}
                    {{--{ y: {{isset($susut)?$susut[1][0]:0}}, name: "Susut Tidak Normal: {{isset($susut)?$susut[1][1]:0}}", exploded: true },--}}
{{--                    { y: 0, name: "Total GI: {{isset($susut)?$susut[2]:0}}" }--}}
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