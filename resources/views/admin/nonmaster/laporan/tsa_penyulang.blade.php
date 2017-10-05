@extends('admin.master.app')
@section('title', 'Si-Oneng, Rekonsiliasi Energi')

@section('content')

<div class="wrapper">
@include('admin.master.navbar')

    <div class="main-panel">
    @include('admin.master.top_navbar', ['navbartitle' => "LAPORAN "])
        <div class="content">
             <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-3">
                        <div class="card">
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th><i>PT PLN ( PERSERO )</i></th>
                                        </tr>
                                        <tr>
                                            <th><i>DISTRIBUSI JAWA TIMUR</i></th>
                                        </tr>
                                        <tr>
                                            @if($tipe == 3)
                                            <th><i>RAYON {{$area}}</i></th>
                                            @elseif($tipe == 2)
                                            <th><i>AREA {{$area}}</i></th>
                                            @endif
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="card">
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                    <tr>
                                        <th><br/></th>
                                    </tr>
                                    <tr>
                                        <th class="text-center">KWH SALUR PER PENYULANG</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center">BULAN : {{date('M Y')}}</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-3">
                        <div class="card text-center">
                            <div class="header">
                                <h4 class="title">Download Laporan</h4>
                            </div>
                            <div class="content">
                                <a href="" rel="tooltip" title="" data-original-title="">
                                    <button class="btn btn-info btn-fill btn-wd"><i class="pe-7s-diskette"></i><br/>Download Laporan</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="card" style="white-space: nowrap; overflow-x: auto;">
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-bordered" style="white-space: nowrap; overflow-x: auto;">
                                    <thead>
                                        <tr>
                                            <th rowspan="3" class="text-center">NO</th>
                                            <th colspan="3" class="text-center">GARDU INDUK (GI)</th>
                                            <th rowspan="3" class="text-center">NAMA PENYULANG</th >
                                            <th colspan="6" class="text-center">KWH SALUR</th>
                                            <th rowspan="3" class="text-center">UP/UPJ</th>
                                            <th rowspan="3" class="text-center">KWH PENYULANG BULAN LALU</th>
                                            <th colspan="2" rowspan="2" class="text-center">NAIK/TURUN</th>
                                        </tr>
                                        <tr>
                                            <th rowspan="2" class="text-center">NAMA</th>
                                            <th rowspan="2" class="text-center">TRAFO</th>
                                            <th rowspan="2" class="text-center">DAYA<br/>(MVA)</th>
                                            <th rowspan="2" class="text-center">LWBP1</th>
                                            <th rowspan="2" class="text-center">LWBP2</th>
                                            <th rowspan="2" class="text-center">WBP</th>
                                            <th rowspan="2" class="text-center">TOTAL KWH</th>
                                            <th rowspan="2" class="text-center">KVARH</th>
                                            <th rowspan="2" class="text-center">KW</th>
                                        </tr>
                                        <tr>
                                            <th class="text-center">KWH</th>
                                            <th class="text-center">%</th>
                                        </tr>
                                    </thead>
                                    @if($trafo)
                                    <tbody>
                                        @for($j=0;$j<count($trafo);$j++)

                                            <div style="display: none;">{{$flag=true}}</div>
                                        @for($i=0;$i<count($data_gi);$i++)
                                        <tr class="text-right">
                                            @if($data_gi[$i]['id_trafo']==$trafo[$j]['id'])
                                            @if($flag==1)
                                            <td class="text-center">{{$j+1}}</td>
                                            <td class="text-left">{{$gi}}</td>
                                            <td class="text-center">{{$trafo[$j]['nama_trafo_gi']}}</td>
                                            <td class="text-center">40</td>
                                            <div style="display: none;">{{$flag=false}}</div>
                                            @else
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            @endif
                                            <td class="text-center">{{$data_gi[$i]['nama_p']}}</td>
                                            <td>{{$data_gi[$i]['lwbp1']}}</td>
                                            <td>{{$data_gi[$i]['lwbp2']}}</td>
                                            <td>{{$data_gi[$i]['wbp']}}</td>
                                            <td>{{$data_gi[$i]['total_kwh']}}</td>
                                            <td>-</td>
                                            <td>{{$data_gi[$i]['KW']}}</td>
                                            <td class="text-left">KRAKSAAN</td>
                                            <td>{{$data_gi[$i]['KWH_lalu']}}</td>
                                            <td>{{$data_gi[$i]['KWH']}}</td>
                                            <td>{{$data_gi[$i]['persen']}}</td>
                                            @endif
                                        </tr>
                                        @endfor
                                        <tr class="text-right">
                                            <td class="text-center"></td>
                                            <td colspan="4" class="text-center"><b>JUMLAH</b></td>
                                            <td><b>{{$data_jumlah[$j]['lwbp1']}}</b></td>
                                            <td><b>{{$data_jumlah[$j]['lwbp2']}}</b></td>
                                            <td><b>{{$data_jumlah[$j]['wbp']}}</b></td>
                                            <td><b>{{$data_jumlah[$j]['total_kwh']}}</b></td>
                                            <td><b>-</b></td>
                                            <td><b>{{$data_jumlah[$j]['KW']}}</b></td>
                                            <td class="text-left"><b></b></td>
                                            <td><b>{{$data_jumlah[$j]['KWH_lalu']}}</b></td>
                                            <td><b>{{$data_jumlah[$j]['KWH']}}</b></td>
                                            <td><b>{{$data_jumlah[$j]['persen']}}</b></td>

                                        </tr>
                                        @endfor
                                        {{--JUMLAH--}}
                                    </tbody>
                                    {{-----------}}
                                    <thead>
                                        <tr>
                                            <th colspan="5" class="text-center">JUMLAH</th>
                                            <th class="text-right"><b>{{$total_jumlah['lwbp1']}}</b></th>
                                            <th class="text-right"><b>{{$total_jumlah['lwbp2']}}</b></th>
                                            <th class="text-right"><b>{{$total_jumlah['wbp']}}</b></th>
                                            <th class="text-right"><b>{{$total_jumlah['total_kwh']}}</b></th>
                                            <th class="text-right"><b></b></th>
                                            <th class="text-right"><b>{{$total_jumlah['KW']}}</b></th>
                                            <th class="text-center"><b></b></th>
                                            <th class="text-right"><b>{{$total_jumlah['KWH_lalu']}}</b></th>
                                            <th class="text-right"><b>{{$total_jumlah['KWH']}}</b></th>
                                            <th class="text-right"><b>{{$total_jumlah['persen']}}</b></th>
                                        </tr>
                                    </thead>
                                    @endif
                                </table>
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