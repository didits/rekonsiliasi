@extends('admin.master.app')
@section('title', 'Si-Oneng, Rekonsiliasi Energi')

@section('content')

<div class="wrapper">
    @include('admin.master.top_navbar', ['navbartitle' => "LAPORAN TSA PENYULANG"])

    @include('admin.master.navbar')
    {{dd($data)}}
    <div class="main-panel">
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
                                        <th><i>{{Auth::user()->nama_organisasi}}</i></th>
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
                                        <th colspan="6" class="text-center">KWH SALUR</th>
                                        <th rowspan="3" class="text-center">TEGANGAN<br/>UJUNG</th>
                                        <th colspan="2" rowspan="2" class="text-center">NAIK/TURUN</th>
                                        <th colspan="2" class="text-center">DEVIASI</th>
                                        <th colspan="2" class="text-center">SUSUT</th>
                                        <th rowspan="3" class="text-center">UP/UPJ</th>
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
                                        <th rowspan="2" class="text-center">DEVIASI(%)</th>
                                        <th rowspan="2" class="text-center">KETERANGAN</th>
                                        <th rowspan="2" class="text-center">KWH SUSUT</th>
                                        <th rowspan="2" class="text-center">LOSSES(%)</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center">KWH</th>
                                        <th class="text-center">%</th>
                                    </tr>
                                    </thead>
                                    @if($tipe=="rayon")

                                        @if($data_gi)
                                            <tbody>
                                            @for($j=0;$j<count($data_gi);$j++)
                                                @for($k=0;$k<count($data_gi[$j]['trafo']);$k++)
                                                    <div style="display: none;">{{$flag=true}}</div>
                                                    @for($i=0;$i<count($data_gi[$j]['data_gi']);$i++)
                                                        <tr class="text-right">
                                                            {{--                                                {{dd(count($data_gi[$j]['trafo']))}}--}}
                                                            @if($data_gi[$j]['data_gi'][$i]['id_trafo']==$data_gi[$j]['trafo'][$k]['id'])
                                                                @if($flag==1)
                                                                    <td class="text-center">{{$j+1}}</td>
                                                                    <td class="text-left">{{$data_gi[$j]['gi']}}</td>
                                                                    <td class="text-center">{{$data_gi[$j]['trafo'][$k]['nama_trafo_gi']}}</td>
                                                                    <td class="text-center">40</td>
                                                                    <div style="display: none;">{{$flag=false}}</div>
                                                                @else
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                @endif
                                                                <td class="text-center">{{$data_gi[$j]['data_gi'][$i]['nama_p']}}</td>
                                                                <td>{{number_format($data_gi[$j]['data_gi'][$i]['lwbp1'],0)}}</td>
                                                                <td>{{number_format($data_gi[$j]['data_gi'][$i]['lwbp2'],0)}}</td>
                                                                <td>{{number_format($data_gi[$j]['data_gi'][$i]['wbp'],0)}}</td>
                                                                <td>{{number_format($data_gi[$j]['data_gi'][$i]['total_kwh'],0)}}</td>
                                                                <td>{{number_format($data_gi[$j]['data_gi'][$i]['Kvarh'],0)}}</td>
                                                                <td>{{number_format($data_gi[$j]['data_gi'][$i]['KW'],0)}}</td>
                                                                <td>{{number_format($data_gi[$j]['data_gi'][$i]['ujung'],0)}}</td>
                                                                <td>{{number_format($data_gi[$j]['data_gi'][$i]['KWH_lalu'],0)}}</td>
                                                                <td>{{number_format($data_gi[$j]['data_gi'][$i]['KWH'],0)}}</td>
                                                                <td>{{number_format($data_gi[$j]['data_gi'][$i]['persen'],2)}}</td>
                                                                <td>{{number_format($data_gi[$j]['data_gi'][$i]['jual'],0)}}</td>
                                                                <td>{{number_format($data_gi[$j]['data_gi'][$i]['susut'],0)}}</td>
                                                                <td>{{number_format($data_gi[$j]['data_gi'][$i]['losses'],2)}}</td>
                                                                <td class="text-left">{{$data_gi[$j]['data_gi'][$i]['rayon']}}</td>
                                                            @endif
                                                        </tr>
                                                    @endfor
                                                @endfor
                                                <tr class="text-right">
                                                    {{--<td class="text-center"></td>--}}
                                                    {{--<td><b></b></td>--}}

                                                </tr>
                                            </tbody>
                                            {{-----------}}
                                            {{--JUMLAH--}}
                                            <thead>
                                            <tr>
                                                <td colspan="5" class="text-center"><b>JUMLAH</b></td>
                                                {{--{{dd($data_gi[$j]['total_jumlah'])}}--}}
                                                <td class="text-right"><b>{{number_format($data_gi[$j]['total_jumlah']['lwbp1'],0)}}</b></td>
                                                <td class="text-right"><b>{{number_format($data_gi[$j]['total_jumlah']['lwbp2'],0)}}</b></td>
                                                <td class="text-right"><b>{{number_format($data_gi[$j]['total_jumlah']['wbp'],0)}}</b></td>
                                                <td class="text-right"><b>{{number_format($data_gi[$j]['total_jumlah']['total_kwh'],0)}}</b></td>
                                                <td class="text-right"><b>{{number_format($data_gi[$j]['total_jumlah']['Kvarh'],0)}}</b></td>
                                                <td class="text-right"><b>{{number_format($data_gi[$j]['total_jumlah']['KW'],0)}}</b></td>
                                                <td class="text-center"><b></b></td>
                                                <td class="text-right"><b>{{number_format($data_gi[$j]['total_jumlah']['KWH_lalu'],0)}}</b></td>
                                                <td class="text-right"><b>{{number_format($data_gi[$j]['total_jumlah']['KWH'],0)}}</b></td>
                                                <td class="text-right"><b>{{number_format($data_gi[$j]['total_jumlah']['persen'],2)}}</b></td>
                                                <td class="text-right"><b>{{number_format($data_gi[$j]['total_jumlah']['jual'],0)}}</b></td>
                                                <td class="text-right"><b>{{number_format($data_gi[$j]['total_jumlah']['susut'],0)}}</b></td>
                                                <td class="text-right"><b>{{number_format($data_gi[$j]['total_jumlah']['losses'],2)}}</b></td>
                                                <td><b></b></td>
                                            </tr>
                                            </thead>
                                            @endfor
                                        @endif
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