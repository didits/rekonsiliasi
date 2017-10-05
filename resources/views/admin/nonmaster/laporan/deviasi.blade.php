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
                                            @if($tipe == "area")
                                            <th><i>AREA {{$area}}</i></th>
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
                                            <th rowspan="3" class="text-center">GARDU INDUK</th>
                                            <th rowspan="3" class="text-center">NO.<br/>TRF</th>
                                            <th rowspan="3" class="text-center">INCOMING<br/>UTAMA</th>
                                            <th rowspan="3" class="text-center">PEMAKAIAN<br/>SENDIRI GI</th>
                                            <th rowspan="3" class="text-center">KWH SALUR<br/>KE DISTRIBUSI</th>
                                            <th rowspan="3" class="text-center">INCOMING<br/>PEMBANDING</th>
                                            <th rowspan="3" class="text-center">TOTAL<br/>PENYULANG</th>
                                            <th colspan="6" class="text-center">DEVIASI</th>
                                            <th colspan="6" class="text-center">DEVIASI TIDAK NORMAL</th>
                                        </tr>
                                        <tr>
                                            <th colspan="2" class="text-center">UTAMA VS PEMBANDING</th>
                                            <th colspan="2" class="text-center">UTAMA VS ∑PENYULANG</th>
                                            <th colspan="2" class="text-center">PEMBANDING VS ∑PENYULANG</th>
                                            <th rowspan="2" class="text-center">PENJELASAN</th>
                                            <th rowspan="2" class="text-center">TINDAK LANJUT<br/>PENYELESAIAN</th>
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
                                            <th class="text-center">16</th>
                                        </tr>
                                    </thead>
                                    @if($area == "data")
                                    <tbody>
                                        @for($i=0;$i<count($data_GI);$i++)
                                        <tr class="text-right">
                                            @if($i==0)
                                            <td class="text-center">1</td>
                                            <td class="text-left">{{$data_GI[$i]['gi']}}</td>
                                            @else
                                            <td class="text-center"></td>
                                            <td class="text-left"></td>
                                            @endif
                                            <td class="text-center">{{$data_GI[$i]['trafo']}}</td>
                                            <td>{{number_format($data_GI[$i]['D'],0)}}</td>
                                            <td>{{number_format($data_GI[$i]['E'],0)}}</td>
                                            <td>{{number_format($data_GI[$i]['F'],0)}}</td>
                                            <td>{{number_format($data_GI[$i]['G'],0)}}</td>
                                            <td>{{number_format($data_GI[$i]['H'],0)}}</td>
                                            <td>({{number_format($data_GI[$i]['I']),0}})</td>
                                            <td>({{number_format($data_GI[$i]['J'],2)}})</td>
                                            <td>({{number_format($data_GI[$i]['K'],0)}})</td>
                                            <td>({{number_format($data_GI[$i]['L'],2)}})</td>
                                            <td>({{number_format($data_GI[$i]['M'],0)}})</td>
                                            <td>({{number_format($data_GI[$i]['N'],2)}})</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        @endfor

                                    </tbody>
                                    @elseif($area == "area")
                                    <tbody>
                                        @for($i=0;$i<count($data_GI);$i++)
                                        <tr class="text-right">
                                            @if($i==0)
                                                <td class="text-center">1</td>{{$}}
                                                <td class="text-left">{{$data_GI[$i][0][1]['gi']}}</td>
                                            @else
                                                <td class="text-center"></td>
                                                <td class="text-left"></td>
                                            @endif
                                            <td class="text-center">{{$data_GI[$i][0][0]['trafo']}}</td>
                                            <td>{{number_format($data_GI[$i][0][0]['D'],0)}}</td>
                                            <td>{{number_format($data_GI[$i][0][0]['E'],0)}}</td>
                                            <td>{{number_format($data_GI[$i][0][0]['F'],0)}}</td>
                                            <td>{{number_format($data_GI[$i][0][0]['G'],0)}}</td>
                                            <td>{{number_format($data_GI[$i][0][0]['H'],0)}}</td>
                                            <td>({{number_format($data_GI[$i][0][0]['I']),0}})</td>
                                            <td>({{number_format($data_GI[$i][0][0]['J'],2)}})</td>
                                            <td>({{number_format($data_GI[$i][0][0]['K'],0)}})</td>
                                            <td>({{number_format($data_GI[$i][0][0]['L'],2)}})</td>
                                            <td>({{number_format($data_GI[$i][0][0]['M'],0)}})</td>
                                            <td>({{number_format($data_GI[$i][0][0]['N'],2)}})</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
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