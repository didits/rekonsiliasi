@extends('admin.master.app')
@section('title', 'Si-Oneng, Rekonsiliasi Energi')

@section('content')

<div class="wrapper">
    @include('admin.master.top_navbar', ['navbartitle' => "LAPORAN DISTRIBUSI"])

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
                                        <th class="text-center">REKAPITULASI TRANSFER TENAGA LISTRIK (TSA TERURAI)</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center">KE PT PLN (PERSERO) DISTRIBUSI JAWA TIMUR</th>
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
                                <a href="{{route('distribusi.excel_distribusi')}}" rel="tooltip" title="" data-original-title="">
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
                                        <th rowspan="3" class="text-center">GI</th>
                                        <th colspan="6" class="text-center">KWH SALUR</th>
                                        <th rowspan="3" class="text-center">TSA BULAN LALU</th>
                                        <th colspan="2" rowspan="2" class="text-center">NAIK/TURUN</th>
                                        <th rowspan="3" class="text-center">KWH JUAL</th>
                                        <th colspan="3" rowspan="2" class="text-center">SUSUT</th>
                                        {{--<th colspan="2" rowspan="2" class="text-center">DEVIASI</th>--}}
                                        <th colspan="3" rowspan="2"class="text-center">UTAMA VS ∑PENYULANG</th>    {{--<th rowspan="3" class="text-center">AREA</th>--}}
                                    </tr>
                                    <tr>
                                        <th rowspan="2" class="text-center">TOTAL</th>
                                        <th rowspan="2" class="text-center">WBP</th>
                                        <th rowspan="2" class="text-center">LWBP1</th>
                                        <th rowspan="2" class="text-center">LWBP2</th>
                                        <th rowspan="2" class="text-center">KEL. KVARH<br/>(KVARH)</th>
                                        <th rowspan="2" class="text-center">KAPASITAS<br/>(KW)</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center">KWH</th>
                                        <th class="text-center">%</th>
                                        <th class="text-center">KWH SUSUT</th>
                                        <th class="text-center">LOSSES(%)</th>
                                        <th class="text-center">KETERANGAN</th>
                                        <th class="text-center">KWH</th>
                                        <th class="text-center">%</th>
                                        <th class="text-center">KETERANGAN</th>
                                    </tr>
                                    {{--<tr>--}}
                                        {{--<th class="text-center">1</th>--}}
                                        {{--<th class="text-center">2</th>--}}
                                        {{--<th class="text-center">3</th>--}}
                                        {{--<th class="text-center">4=5+6+7</th>--}}
                                        {{--<th class="text-center">5</th>--}}
                                        {{--<th class="text-center">6</th>--}}
                                        {{--<th class="text-center">7</th>--}}
                                        {{--<th class="text-center">13</th>--}}
                                        {{--<th class="text-center">14</th>--}}
                                        {{--<th class="text-center">16</th>--}}
                                        {{--<th class="text-center">17=9-16</th>--}}
                                        {{--<th class="text-center">18=17/16*100</th>--}}
                                        {{--<th class="text-center">19</th>--}}
                                        {{--<th class="text-center">20</th>--}}
                                        {{--<th class="text-center">21</th>--}}
                                        {{--<th class="text-center">22</th>--}}
                                    {{--</tr>--}}
                                    </thead>

                                        @if($data)
                                            <tbody>
                                            @for($i=0;$i<count($data);$i++)
                                                <tr class="text-right">
                                                    <td class="text-center">{{$i+1}}</td>
                                                            <td class="text-center">{{($nama_gi[$i])}}</td>
                                                            <td>{{number_format(json_decode($data[$i]->data,true)['total_kwh'],0)}}</td>
                                                            <td>{{number_format(json_decode($data[$i]->data,true)['wbp'],0)}}</td>
                                                            <td>{{number_format(json_decode($data[$i]->data,true)['lwbp1'],0)}}</td>
                                                            <td>{{number_format(json_decode($data[$i]->data,true)['lwbp2'],0)}}</td>
                                                            <td>{{number_format(json_decode($data[$i]->data,true)['Kvarh'],0)}}</td>
                                                            <td>{{number_format(json_decode($data[$i]->data,true)['KW'],0)}}</td>
                                                            <td>{{number_format(json_decode($data[$i]->data,true)['KWH_lalu'],0)}}</td>
                                                            <td>{{number_format(json_decode($data[$i]->data,true)['KWH'],0)}}</td>
                                                            <td>{{number_format(json_decode($data[$i]->data,true)['persen'],2)}}</td>
                                                            <td>{{number_format(json_decode($data[$i]->data,true)['jual'],0)}}</td>
                                                            <td>{{number_format(json_decode($data[$i]->data,true)['susut'],0)}}</td>
                                                            <td>{{number_format(json_decode($data[$i]->data,true)['losses'],2)}}</td>
                                                            @if(json_decode($data[$i]->data,true)['losses'] > 6)
                                                                <td class="text-center">TIDAK NORMAL</td>
                                                            @elseif(json_decode($data[$i]->data,true)['losses'] < 6)
                                                                <td class="text-center">NORMAL</td>
                                                            @endif
                                                                @if((json_decode($data[$i]->data,true)['KWH_dev'])>= 0)
                                                                    <td>{{number_format(json_decode($data[$i]->data,true)['KWH_dev'],2)}}</td>
                                                                @else
                                                                    <td>({{number_format((json_decode($data[$i]->data,true)['KWH_dev'])*-1)}})</td>
                                                                @endif
                                                                @if((json_decode($data[$i]->data,true)['persen_dev'])>= 0)
                                                                    <td><b>{{number_format(json_decode($data[$i]->data,true)['persen_dev'],2)}}<b></td>
                                                                @else
                                                                    <td><b>({{number_format((json_decode($data[$i]->data,true)['persen_dev'])*-1)}}</b>)</td>
                                                                @endif

                                                            @if(json_decode($data[$i]->data,true)['persen_dev'] > 2)
                                                                <td class="text-center">TIDAK NORMAL</td>
                                                            @elseif(json_decode($data[$i]->data,true)['persen_dev'] < 2)
                                                                <td class="text-center">NORMAL</td>
                                                            @endif
                                                        </tr>
                                                    @endfor
                                            {{--@for($i=0;$i<count($data);$i++)--}}
                                                {{--@for($j=0;$j<count($data[$i]['gi']);$j++)--}}
                                                    {{--<tr class="text-right">--}}
                                                        {{--@if($j>0)--}}
                                                            {{--<td></td>--}}
                                                        {{--@else<td class="text-center">{{$i+1}}</td>--}}
                                                        {{--@endif--}}
                                                        {{--<td class="text-center">{{$data[$i]['gi'][$j]['gi']}}</td>--}}
                                                        {{--<td>{{number_format($data[$i]['gi'][$j]['total_jumlah']['total_kwh'],0)}}</td>--}}
                                                        {{--<td>{{number_format($data[$i]['gi'][$j]['total_jumlah']['wbp'],0)}}</td>--}}
                                                        {{--<td>{{number_format($data[$i]['gi'][$j]['total_jumlah']['lwbp1'],0)}}</td>--}}
                                                        {{--<td>{{number_format($data[$i]['gi'][$j]['total_jumlah']['lwbp2'],0)}}</td>--}}
                                                        {{--<td>{{number_format($data[$i]['gi'][$j]['total_jumlah']['Kvarh'],0)}}</td>--}}
                                                        {{--<td>{{number_format($data[$i]['gi'][$j]['total_jumlah']['KW'],0)}}</td>--}}
                                                        {{--<td>{{number_format($data[$i]['gi'][$j]['total_jumlah']['KWH_lalu'],0)}}</td>--}}
                                                        {{--<td>{{number_format($data[$i]['gi'][$j]['total_jumlah']['KWH'],0)}}</td>--}}
                                                        {{--<td>{{number_format($data[$i]['gi'][$j]['total_jumlah']['persen'],2)}}</td>--}}
                                                        {{--<td>{{number_format($data[$i]['gi'][$j]['total_jumlah']['jual'],0)}}</td>--}}
                                                        {{--<td>{{number_format($data[$i]['gi'][$j]['total_jumlah']['susut'],0)}}</td>--}}
                                                        {{--<td>{{number_format($data[$i]['gi'][$j]['total_jumlah']['losses'],2)}}</td>--}}
                                                        {{--@if($data[$i]['gi'][$j]['total_jumlah']['losses'] > 6)--}}
                                                            {{--<td class="text-center">TIDAK NORMAL</td>--}}
                                                        {{--@elseif($data[$i]['gi'][$j]['total_jumlah']['losses'] < 6)--}}
                                                            {{--<td class="text-center">NORMAL</td>--}}
                                                        {{--@endif--}}
                                                        {{--@if(($data[$i]['dev'][$j]['K'])>= 0)--}}
                                                            {{--<td>{{number_format($data[$i]['K'],2)}}</td>--}}
                                                        {{--@else--}}
                                                            {{--<td>({{number_format(($data[$i]['dev'][$j]['K'])*-1)}})</td>--}}
                                                        {{--@endif--}}
                                                        {{--@if(($data[$i]['dev'][$j]['L'])>= 0)--}}
                                                            {{--<td><b>{{number_format($data[$i]['dev'][$j]['L'],2)}}<b></td>--}}
                                                        {{--@else--}}
                                                            {{--<td><b>({{number_format(($data[$i]['dev'][$j]['L'])*-1)}}</b>)</td>--}}
                                                        {{--@endif--}}

                                                        {{--@if($data[$i]['dev'][$j]['L'] > 2)--}}
                                                            {{--<td class="text-center">TIDAK NORMAL</td>--}}
                                                        {{--@elseif($data[$i]['dev'][$j]['L'] < 2)--}}
                                                            {{--<td class="text-center">NORMAL</td>--}}
                                                        {{--@endif--}}
                                                    {{--</tr>--}}
                                                {{--@endfor--}}
                                            {{--@endfor--}}

                                            <tr class="text-right"></tr>
                                            </tbody>
                                            {{-----------}}
                                            {{--JUMLAH--}}
                                            <thead>
                                            <tr>
                                                {{--<td colspan="5" class="text-center"><b>JUMLAH</b></td>--}}
                                                {{--{{dd($data[$j]['total_jumlah'])}}--}}
                                                {{--<td class="text-right"><b>{{number_format($data[$j]['total_jumlah']['lwbp1'],0)}}</b></td>--}}
                                                {{--<td class="text-right"><b>{{number_format($data[$j]['total_jumlah']['lwbp2'],0)}}</b></td>--}}
                                                {{--<td class="text-right"><b>{{number_format($data[$j]['total_jumlah']['wbp'],0)}}</b></td>--}}
                                                {{--<td class="text-right"><b>{{number_format($data[$j]['total_jumlah']['total_kwh'],0)}}</b></td>--}}
                                                {{--<td class="text-right"><b>{{number_format($data[$j]['total_jumlah']['Kvarh'],0)}}</b></td>--}}
                                                {{--<td class="text-right"><b>{{number_format($data[$j]['total_jumlah']['KW'],0)}}</b></td>--}}
                                                {{--<td class="text-center"><b></b></td>--}}
                                                {{--<td class="text-right"><b>{{number_format($data[$j]['total_jumlah']['KWH_lalu'],0)}}</b></td>--}}
                                                {{--<td class="text-right"><b>{{number_format($data[$j]['total_jumlah']['KWH'],0)}}</b></td>--}}
                                                {{--<td class="text-right"><b>{{number_format($data[$j]['total_jumlah']['persen'],2)}}</b></td>--}}
                                                {{--<td class="text-right"><b>{{number_format($data[$j]['total_jumlah']['jual'],0)}}</b></td>--}}
                                                {{--<td class="text-right"><b>{{number_format($data[$j]['total_jumlah']['susut'],0)}}</b></td>--}}
                                                {{--<td class="text-right"><b>{{number_format($data[$j]['total_jumlah']['losses'],2)}}</b></td>--}}
                                                {{--<td><b></b></td>--}}
                                            {{--</tr>--}}
                                            {{--</thead>--}}
                                            {{--@endfor--}}
                                        @endif
                                    <thead>
                                    <tr class="text-right">
                                        <td class="text-center" colspan="2" class="text-center"><b>JUMLAH</b></td>
                                        <td><b>{{number_format($jumlah['total_kwh'],0)}}</b></td>
                                        <td><b>{{number_format($jumlah['wbp'],0)}}</b></td>
                                        <td><b>{{number_format($jumlah['lwbp1'],0)}}</b></td>
                                        <td><b>{{number_format($jumlah['lwbp2'],0)}}</b></td>
                                        <td><b>{{number_format($jumlah['Kvarh'],0)}}</b></td>
                                        <td><b>{{number_format($jumlah['KW'],0)}}</b></td>
                                        <td><b>{{number_format($jumlah['KWH_lalu'],0)}}</b></td>
                                        <td><b>{{number_format($jumlah['KWH'],0)}}</b></td>
                                        <td><b>{{number_format($jumlah['persen'],2)}}</b></td>
                                        <td><b>{{number_format($jumlah['jual'],0)}}</b></td>
                                        <td><b>{{number_format($jumlah['susut'],0)}}</b></td>
                                        <td><b>{{number_format($jumlah['losses'],2)}}</b></td>
                                        @if($jumlah['losses'] > 6)
                                            <td class="text-center">TIDAK NORMAL</td>
                                        @elseif($jumlah['losses'] < 6)
                                            <td class="text-center">NORMAL</td>
                                        @endif
                                        @if(($jumlah['K'])>= 0)
                                            <td><b>{{number_format($jumlah['K'])}}</b></td>
                                        @else <td><b>({{number_format(abs($jumlah['K']))}}</b>)</td>
                                        @endif
                                        <td><b>{{number_format($jumlah['L'],2)}}</b></td>
                                        @if($jumlah['L'] > 2)
                                            <td class="text-center">TIDAK NORMAL</td>
                                        @elseif($jumlah['L'] < 2)
                                            <td class="text-center">NORMAL</td>
                                        @endif
                                    <tr>

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