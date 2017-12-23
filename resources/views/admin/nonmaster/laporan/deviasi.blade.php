@extends('admin.master.app')
@section('title', 'Si-Oneng, Rekonsiliasi Energi')

@section('content')

<div class="wrapper">
    @include('admin.master.top_navbar', ['navbartitle' => "LAPORAN DEVIASI"])

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
                                            @if($tipe == "area")
                                            <th><i>AREA {{Auth::user()->nama_organisasi}}</i></th>
                                            @elseif($tipe == "rayon")
                                            <th><i>RAYON {{$rayon}}</i></th>
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
                                        <th class="text-center">DEVIASI KWH INCOMING DAN OUT GOING GARDU INDUK</th>
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
                                <a href="{{route('area.view_excel_beli_deviasi' , [$id_organisasi, $tipe, $id])}}" rel="tooltip" title="" data-original-title="">
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
                                            <th rowspan="3" class="text-center">GARDU INDUK</th>
                                            <th rowspan="3" class="text-center">NO.<br/>TRF</th>
                                            <th rowspan="3" class="text-center">INCOMING<br/>UTAMA</th>
                                            <th rowspan="3" class="text-center">PEMAKAIAN<br/>SENDIRI GI</th>
                                            <th rowspan="3" class="text-center">KWH SALUR<br/>KE DISTRIBUSI</th>
                                            <th rowspan="3" class="text-center">INCOMING<br/>PEMBANDING</th>
                                            <th rowspan="3" class="text-center">TOTAL<br/>PENYULANG</th>
                                            <th colspan="6" class="text-center">DEVIASI</th>
                                            <th rowspan="3" class="text-center">KETERANGAN</th>
                                            {{--<th colspan="6" class="text-center">DEVIASI TIDAK NORMAL</th>--}}
                                        </tr>
                                        <tr>
                                            <th colspan="2" class="text-center">UTAMA VS PEMBANDING</th>
                                            <th colspan="2" class="text-center">UTAMA VS ∑PENYULANG</th>
                                            <th colspan="2" class="text-center">PEMBANDING VS ∑PENYULANG</th>
                                            {{--<th rowspan="2" class="text-center">PENJELASAN</th>--}}
                                            {{--<th rowspan="2" class="text-center">TINDAK LANJUT<br/>PENYELESAIAN</th>--}}
                                        </tr>
                                        <tr>
                                            <th class="text-center">KWH</th>
                                            <th class="text-center">%</th>
                                            <th class="text-center">KWH</th>
                                            <th class="text-center">%</th>
                                            <th class="text-center">KWH</th>
                                            <th class="text-center">%</th>
                                        </tr>
                                        <tr>
                                            <th class="text-center">1</th>
                                            <th class="text-center">2</th>
                                            <th class="text-center">3</th>
                                            <th class="text-center">4</th>
                                            <th class="text-center">5</th>
                                            <th class="text-center">6=(4-5)</th>
                                            <th class="text-center">7</th>
                                            <th class="text-center">8</th>
                                            <th class="text-center">9=(4-7)</th>
                                            <th class="text-center">10=9/4*100</th>
                                            <th class="text-center">11=(6-7)</th>
                                            <th class="text-center">12=11/6*100</th>
                                            <th class="text-center">13=(7-5-8)</th>
                                            <th class="text-center">14=13/(7-5)*100</th>
                                            <th class="text-center">15</th>
                                            {{--<th class="text-center">16</th>--}}
                                        </tr>
                                    </thead>
                                    @if($area == "data")
                                    <tbody>
                                        <div style="display: none;">{{$flag=true}}</div>
                                        @for($i=0;$i<count($data2_GI);$i++)
                                            @for($j=0;$j<count($data2_GI[$i]['data']);$j++)
                                                <tr class="text-right">
                                            @if($flag)
                                            <td class="text-center">1</td>
                                            <td class="text-left">{{$data2_GI[$i]['data'][$j]['gi']}}</td>
                                            <div style="display: none;">{{$flag=false}}</div>
                                            @else
                                            <td class="text-center"></td>
                                            <td class="text-left"></td>
                                            @endif
                                            <td class="text-center">{{$data2_GI[$i]['data'][$j]['trafo']}}</td>
                                            <td>{{number_format($data2_GI[$i]['data'][$j]['D'],0)}}</td>
                                            <td>{{number_format($data2_GI[$i]['data'][$j]['E'],0)}}</td>
                                            <td>{{number_format($data2_GI[$i]['data'][$j]['F'],0)}}</td>
                                            <td>{{number_format($data2_GI[$i]['data'][$j]['G'],0)}}</td>
                                            <td>{{number_format($data2_GI[$i]['data'][$j]['H'],0)}}</td>
                                            <td>({{number_format($data2_GI[$i]['data'][$j]['I']),0}})</td>
                                            <td>({{number_format($data2_GI[$i]['data'][$j]['J'],2)}})</td>
                                            <td>({{number_format($data2_GI[$i]['data'][$j]['K'],0)}})</td>
                                            <td>({{number_format($data2_GI[$i]['data'][$j]['L'],2)}})</td>
                                            <td>({{number_format($data2_GI[$i]['data'][$j]['M'],0)}})</td>
                                            <td>({{number_format($data2_GI[$i]['data'][$j]['N'],2)}})</td>
                                            @if(number_format($data2_GI[$i]['data'][$j]['N'],2)> 2)
                                            <td class="text-center">TIDAK NORMAL</td>
                                            @elseif(number_format($data2_GI[$i]['data'][$j]['N'],2)< 2)
                                            <td class="text-center">NORMAL</td>
                                            @endif
                                        </tr>
                                            @endfor
                                        @endfor
                                    </tbody>
                                    {{-----------}}
                                    <thead>
                                        <tr>
                                            <th class="text-center" colspan="3" class="text-center">JUMLAH</th>
                                            <th class="text-center">{{number_format($jumlah['D'],0)}}</th>
                                            <th class="text-center">{{number_format($jumlah['E'],0)}}</th>
                                            <th class="text-center">{{number_format($jumlah['F'],0)}}</th>
                                            <th class="text-center">{{number_format($jumlah['G'],0)}}</th>
                                            <th class="text-center">{{number_format($jumlah['H'],0)}}</th>
                                            <th class="text-center">({{number_format($jumlah['I']),0}})</th>
                                            <th class="text-center">({{number_format($jumlah['J'],2)}})</th>
                                            <th class="text-center">({{number_format($jumlah['K'],0)}})</th>
                                            <th class="text-center">({{number_format($jumlah['L'],2)}})</th>
                                            <th class="text-center">({{number_format($jumlah['M'],0)}})</th>
                                            <th class="text-center">({{number_format($jumlah['N'],2)}})</th>
                                            @if(number_format($data2_GI[$i]['data'][$j]['N'],2)> 2)
                                                <th class="text-center">TIDAK NORMAL</th>
                                            @elseif(number_format($data2_GI[$i]['data'][$j]['N'],2)< 2)
                                                <th class="text-center">NORMAL</th>
                                            @endif
                                        </tr> 
                                    </thead>
                                    @elseif($area == "area")
                                    <tbody>
                                    @for($i=0;$i<count($data_GI);$i++)
                                        <div style="display: none;">{{$flag=true}}</div>
                                        @for($j=0;$j<count($data_GI[$i]);$j++)
                                        <tr class="text-right">
                                            @if($flag)
                                            <td class="text-center">{{$i+1}}</td>
                                            <td class="text-left">{{$data_GI[$i][$j]['gi']}}</td>
                                            <div style="display: none;">{{$flag=false}}</div>
                                            @else
                                            <td class="text-center"></td>
                                            <td class="text-left"></td>
                                            @endif
                                            {{--{{dd($data_GI[$i][$j])}}--}}
                                            <td class="text-center">{{$data_GI[$i][$j]['trafo']}}</td>
                                            <td>{{number_format($data_GI[$i][$j]['D'],0)}}</td>
                                            <td>{{number_format($data_GI[$i][$j]['E'],0)}}</td>
                                            <td>{{number_format($data_GI[$i][$j]['F'],0)}}</td>
                                            <td>{{number_format($data_GI[$i][$j]['G'],0)}}</td>
                                            <td>{{number_format($data_GI[$i][$j]['H'],0)}}</td>
                                            <td>({{number_format($data_GI[$i][$j]['I']),0}})</td>
                                            <td>({{number_format($data_GI[$i][$j]['J'],2)}})</td>
                                            <td>({{number_format($data_GI[$i][$j]['K'],0)}})</td>
                                            <td>({{number_format($data_GI[$i][$j]['L'],2)}})</td>
                                            <td>({{number_format($data_GI[$i][$j]['M'],0)}})</td>
                                            <td>({{number_format($data_GI[$i][$j]['N'],2)}})</td>
                                            @if(number_format($data_GI[$i][$j]['N'],2)> 2)
                                            <td>TIDAK NORMAL</td>
                                            @elseif(number_format($data_GI[$i][$j]['N'],2)< 2)
                                            <td>NORMAL</td>
                                            @endif
                                            {{--<td></td>--}}
                                        </tr>
                                        @endfor

                                        {{-----------}}
                                        <thead>
                                        <tr>
                                            <th class="text-center" colspan="3" class="text-center">JUMLAH</th>
                                            <th class="text-center">{{number_format($jumlah[$i]['D'],0)}}</th>
                                            <th class="text-center">{{number_format($jumlah[$i]['E'],0)}}</th>
                                            <th class="text-center">{{number_format($jumlah[$i]['F'],0)}}</th>
                                            <th class="text-center">{{number_format($jumlah[$i]['G'],0)}}</th>
                                            <th class="text-center">{{number_format($jumlah[$i]['H'],0)}}</th>
                                            <th class="text-center">({{number_format($jumlah[$i]['I']),0}})</th>
                                            <th class="text-center">({{number_format($jumlah[$i]['J'],2)}})</th>
                                            <th class="text-center">({{number_format($jumlah[$i]['K'],0)}})</th>
                                            <th class="text-center">({{number_format($jumlah[$i]['L'],2)}})</th>
                                            <th class="text-center">({{number_format($jumlah[$i]['M'],0)}})</th>
                                            <th class="text-center">({{number_format($jumlah[$i]['N'],2)}})</th>
                                            <th></th>
                                            {{--<th></th>--}}
                                        </tr>
                                        </thead>
                                    @endfor
                                        {{-----------}}
                                        <thead>
                                        <tr>
                                            <td class="text-center" colspan="3" class="text-center"><b></b>JUMLAH</td>
                                            <td class="text-center"><b>{{number_format($total['D'],0)}}</b></td>
                                            <td class="text-center"><b>{{number_format($total['E'],0)}}</b></td>
                                            <td class="text-center"><b>{{number_format($total['F'],0)}}</b></td>
                                            <td class="text-center"><b>{{number_format($total['G'],0)}}</b></td>
                                            <td class="text-center"><b>{{number_format($total['H'],0)}}</b></td>
                                            <td class="text-center"><b>({{number_format($total['I']),0}})</b></td>
                                            <td class="text-center"><b>({{number_format($total['J'],2)}})</b></td>
                                            <td class="text-center"><b>({{number_format($total['K'],0)}})</b></td>
                                            <td class="text-center"><b>({{number_format($total['L'],2)}})</b></td>
                                            <td class="text-center"><b>({{number_format($total['M'],0)}})</b></td>
                                            <td class="text-center"><b>({{number_format($total['N'],2)}})</b></td>
                                            <td></td>
                                            {{--<td></td>--}}
                                        </tr>
                                        </thead>
                                    </tbody>
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