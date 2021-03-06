@extends('admin.master.app')
@section('title', 'Si-Oneng, Rekonsiliasi Energi')

@section('content')

<div class="wrapper">
    @include('admin.master.top_navbar', ['navbartitle' => "LAPORAN TSA PENYULANG"])

    @include('admin.master.navbar')

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
                                            @if($tipe == "rayon")
                                            <th><i>RAYON {{$area}}</i></th>
                                            @elseif($tipe == "area")
                                            <th><i>AREA {{Auth::user()->nama_organisasi}}</i></th>
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
                                        <th class="text-center">BULAN : {{$date}}</th>
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
                                <a href="{{route('area.excel_beli_tsa' , [$id_organisasi, $tsa, $tipe_organisasi])}}" rel="tooltip" title="" data-original-title="">
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
                                            <th rowspan="3" class="text-center">TEGANGAN<br/>UJUNG</th>
                                            <th rowspan="3" class="text-center">KWH PENYULANG BULAN LALU</th>
                                            <th colspan="2" rowspan="2" class="text-center">NAIK/TURUN</th>
                                            <th rowspan="3" class="text-center">KWH JUAL</th>
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
                                            <td class="text-center">{{json_decode($data_gi[$j]['trafo'][$k]['data_master'],true)['kapasitas']['kapasitas']}}</td>
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

                                    @elseif($tipe=="area")
                                    @if($trafo)
                                    <tbody>
                                    <div style="display: none;">{{$py=0}}</div>
                                    @for($gi=0;$gi<count($trafo);$gi++)
                                    <div style="display: none;">{{$flag=true}}</div>
                                    @for($tr=0;$tr<count($trafo[$gi]);$tr++)
                                    <div style="display: none;">{{$flag=true}}</div>
                                    @for($py=0;$py<count($data_gi[$gi]);$py++)
                                    <tr class="text-right">
                                                @if($data_gi[$gi][$py]['id_trafo']==$trafo[$gi][$tr]['id'])
                                                    {{--{{dd($data_gi)}}--}}
                                                    @if($flag==1)
                                                        <td class="text-center">{{$gi+1}}</td>
                                                        <td class="text-left">{{$nama_gi[$gi]['nama_gi']}}</td>
                                                        <td class="text-center">{{$trafo[$gi][$tr]['nama_trafo_gi']}}</td>
                                                        <td class="text-center">{{json_decode($trafo[$gi][$tr]['data_master'],true)['kapasitas']['kapasitas']}}</td>
                                                        <div style="display: none;">{{$flag=false}}</div>
                                                    @else
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    @endif
                                                    <td class="text-center">{{$data_gi[$gi][$py]['nama_p']}}</td>
                                                    <td>{{number_format($data_gi[$gi][$py]['lwbp1'],0)}}</td>
                                                    <td>{{number_format($data_gi[$gi][$py]['lwbp2'],0)}}</td>
                                                    <td>{{number_format($data_gi[$gi][$py]['wbp'],0)}}</td>
                                                    <td>{{number_format($data_gi[$gi][$py]['total_kwh'],0)}}</td>
                                                    <td>{{number_format($data_gi[$gi][$py]['Kvarh'],0)}}</td>
                                                    <td>{{number_format($data_gi[$gi][$py]['KW'],0)}}</td>
                                                    <td>{{number_format($data_gi[$gi][$py]['ujung'],0)}}</td>
                                                    <td>{{number_format($data_gi[$gi][$py]['KWH_lalu'],0)}}</td>
                                                    <td>{{number_format($data_gi[$gi][$py]['KWH'],0)}}</td>
                                                    <td>{{number_format($data_gi[$gi][$py]['persen'],2)}}</td>
                                                    <td>{{number_format($data_gi[$gi][$py]['jual'],0)}}</td>
                                                    <td>{{number_format($data_gi[$gi][$py]['susut'],0)}}</td>
                                                    <td>{{number_format($data_gi[$gi][$py]['losses'],2)}}</td>
                                                    <td class="text-left">{{$data_gi[$gi][$py]['rayon']}}</td>
                                                @endif
                                            </tr>
                                    @endfor
                                    <tr class="text-right">
                                            <td colspan="5" class="text-center">JUMLAH</td>
                                            <td><b>{{number_format($data_jumlah[$gi][$tr]['lwbp1'],0)}}</b></td>
                                            <td><b>{{number_format($data_jumlah[$gi][$tr]['lwbp2'],0)}}</b></td>
                                            <td><b>{{number_format($data_jumlah[$gi][$tr]['wbp'],0)}}</b></td>
                                            <td><b>{{number_format($data_jumlah[$gi][$tr]['total_kwh'],0)}}</b></td>
                                            <td><b>{{number_format($data_jumlah[$gi][$tr]['Kvarh'],0)}}</b></td>
                                            <td><b>{{number_format($data_jumlah[$gi][$tr]['KW'],0)}}</b></td>
                                            <td class="text-left"><b></b></td>
                                            <td><b>{{number_format($data_jumlah[$gi][$tr]['KWH_lalu'],0)}}</b></td>
                                            <td><b>{{number_format($data_jumlah[$gi][$tr]['KWH'],0)}}</b></td>
                                            <td><b>{{number_format($data_jumlah[$gi][$tr]['persen'],2)}}</b></td>
                                            <td><b>{{number_format($data_jumlah[$gi][$tr]['jual'],0)}}</b></td>
                                            <td><b>{{number_format($data_jumlah[$gi][$tr]['susut'],0)}}</b></td>
                                            <td><b>{{number_format($data_jumlah[$gi][$tr]['losses'],2)}}</b></td>

                                        </tr>
                                    @endfor
                                    @endfor
                                    {{--JUMLAH--}}
                                    </tbody>
                                    {{-----------}}
                                    <thead>
                                    <tr>
                                        <td colspan="5" class="text-center"><b>JUMLAH TOTAL</b></td>
                                        <td class="text-right"><b>{{number_format($total_jumlah['lwbp1'],0)}}</b></td>
                                        <td class="text-right"><b>{{number_format($total_jumlah['lwbp2'],0)}}</b></td>
                                        <td class="text-right"><b>{{number_format($total_jumlah['wbp'],0)}}</b></td>
                                        <td class="text-right"><b>{{number_format($total_jumlah['total_kwh'],0)}}</b></td>
                                        <td class="text-right"><b>{{number_format($total_jumlah['Kvarh'],0)}}</b></td>
                                        <td class="text-right"><b>{{number_format($total_jumlah['KW'],0)}}</b></td>
                                        <td class="text-center"><b></b></td>
                                        <td class="text-right"><b>{{number_format($total_jumlah['KWH_lalu'],0)}}</b></td>
                                        <td class="text-right"><b>{{number_format($total_jumlah['KWH'],0)}}</b></td>
                                        <td class="text-right"><b>{{number_format($total_jumlah['persen'],2)}}</b></td>
                                        <td class="text-right"><b>{{number_format($total_jumlah['jual'],0)}}</b></td>
                                        <td class="text-right"><b>{{number_format($total_jumlah['susut'],0)}}</b></td>
                                        <td class="text-right"><b>{{number_format($total_jumlah['losses'],2)}}</b></td>
                                    </tr>
                                    </thead>
                                        <th colspan="19" class="text-center">PENYULANG DI AREA LAIN</th>
                                           @for($i = 0;$i< count($id_gi);  $i++)
                                                <div style="display: none;">{{$flag=true}}</div>
                                                @foreach($id_trafo as $trafo)
                                                    <div style="display: none;">{{$flag=true}}</div>
                                                    @foreach($peny_npct as $n_pct)
                                                        {{--{{dd($n_pct)}}--}}
                                                        @if($id_gi[$i]==$n_pct['id_gi'] && $trafo==$n_pct['id_trafo'])
                                                            <tr class="text-right">
                                                                @if($flag==1)
                                                                    <td class="text-center">{{$gi+$i+1}}</td>
                                                                    <td class="text-left">{{$n_pct['gi']}}</td>
                                                                    <td class="text-center">{{$n_pct['trafo']}}</td>
                                                                    <td class="text-center">{{$n_pct['daya']}}</td>
                                                                    <div style="display: none;">{{$flag=false}}</div>
                                                                @else
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                @endif
                                                                <td class="text-center">{{$n_pct['nama_p']}}</td>
                                                                <td>{{number_format($n_pct['lwbp1'],0)}}</td>
                                                                <td>{{number_format($n_pct['lwbp2'],0)}}</td>
                                                                <td>{{number_format($n_pct['wbp'],0)}}</td>
                                                                <td>{{number_format($n_pct['total_kwh'],0)}}</td>
                                                                <td>{{number_format($n_pct['Kvarh'],0)}}</td>
                                                                <td>{{number_format($n_pct['KW'],0)}}</td>
                                                                <td>{{number_format($n_pct['ujung'],0)}}</td>
                                                                <td>{{number_format($n_pct['KWH_lalu'],0)}}</td>
                                                                <td>{{number_format($n_pct['KWH'],0)}}</td>
                                                                <td>{{number_format($n_pct['persen'],2)}}</td>
                                                                <td>{{number_format($n_pct['jual'],0)}}</td>
                                                                <td>{{number_format($n_pct['susut'],0)}}</td>
                                                                <td>{{number_format($n_pct['losses'],2)}}</td>
                                                                <td class="text-left">{{$n_pct['rayon']}}</td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                            @endfor
                                        <thead>
                                            <tr>
                                                <td colspan="5" class="text-center"><b>JUMLAH TOTAL</b></td>
                                                <td class="text-right"><b>{{number_format($jumlah['lwbp1'],0)}}</b></td>
                                                <td class="text-right"><b>{{number_format($jumlah['lwbp2'],0)}}</b></td>
                                                <td class="text-right"><b>{{number_format($jumlah['wbp'],0)}}</b></td>
                                                <td class="text-right"><b>{{number_format($jumlah['total_kwh'],0)}}</b></td>
                                                <td class="text-right"><b>{{number_format($jumlah['Kvarh'],0)}}</b></td>
                                                <td class="text-right"><b>{{number_format($jumlah['KW'],0)}}</b></td>
                                                <td class="text-center"><b></b></td>
                                                <td class="text-right"><b>{{number_format($jumlah['KWH_lalu'],0)}}</b></td>
                                                <td class="text-right"><b>{{number_format($jumlah['KWH'],0)}}</b></td>
                                                <td class="text-right"><b>{{number_format($jumlah['persen'],2)}}</b></td>
                                                <td class="text-right"><b>{{number_format($jumlah['jual'],0)}}</b></td>
                                                <td class="text-right"><b>{{number_format($jumlah['susut'],0)}}</b></td>
                                                <td class="text-right"><b>{{number_format($jumlah['losses'],2)}}</b></td>
                                            </tr>
                                            </thead>

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