@extends('admin.master.app')
@section('title', 'Si-Oneng, Rekonsiliasi Energi')

@section('content')

    <div class="wrapper">
        @include('admin.master.top_navbar', ['navbartitle' => "LAPORAN TSA RAYON"])

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
                                            <th><i>AREA {{Auth::user()->nama_organisasi}}</i></th>
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
                                            <th class="text-center">KWH SALUR PER RAYON</th>
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
                                    <a href="{{route('area.excel_beli_tsa' , [$id_organisasi, $tsa, $tipe_organisasi])}}" rel="tooltip" title="" data-original-title="">
                                        <button class="btn btn-info btn-fill btn-wd">
                                            <i class="pe-7s-diskette"></i><br/>Download Laporan
                                        </button>
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
                                            <th rowspan="3" class="text-center">SUB UNIT</th>
                                            <th rowspan="3" class="text-center">NO.<br/>TRF</th >
                                            <th colspan="6" class="text-center">KWH SALUR</th>
                                            <th rowspan="3" class="text-center">TSA BULAN LALU</th>
                                            <th colspan="2" rowspan="2" class="text-center">NAIK/TURUN</th>
                                            <th rowspan="3" class="text-center">KWH JUAL</th>
                                            <th colspan="2" rowspan="2" class="text-center">SUSUT</th>
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
                                        </tr>
                                        <tr>
                                            <th class="text-center">1</th>
                                            <th class="text-center">2</th>
                                            <th class="text-center">3</th>
                                            <th class="text-center">4=5+6+7</th>
                                            <th class="text-center">5</th>
                                            <th class="text-center">6</th>
                                            <th class="text-center">7</th>
                                            <th class="text-center">13</th>
                                            <th class="text-center">14</th>
                                            <th class="text-center">16</th>
                                            <th class="text-center">17=9-16</th>
                                            <th class="text-center">18=17/16*100</th>
                                            <th class="text-center">19</th>
                                            <th class="text-center">20</th>
                                            <th class="text-center">21</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @for($i=0;$i<count($rayon);$i++)
                                            <tr class="text-right">
                                                <td class="text-center">{{$i+1}}</td>
                                                <td class="text-left">{{$rayon[$i]['nama_rayon']}}</td>
                                                <td class="text-center">I</td>
                                                <td>{{number_format($rayon[$i]['total_kwh'])}}</td>
                                                <td>{{number_format($rayon[$i]['wbp'])}}</td>
                                                <td>{{number_format($rayon[$i]['lwbp1'])}}</td>
                                                <td>{{number_format($rayon[$i]['lwbp2'])}}</td>
                                                <td>{{number_format($rayon[$i]['Kvarh'])}}</td>
                                                <td>{{number_format($rayon[$i]['KW'])}}</td>
                                                <td>{{number_format($rayon[$i]['KWH_lalu'])}}</td>
                                                <td>{{number_format($rayon[$i]['KWH'])}}</td>
                                                <td>{{number_format($rayon[$i]['persen'])}}</td>
                                                <td>{{number_format($rayon[$i]['jual'])}}</td>
                                                <td>{{number_format($rayon[$i]['susut'])}}</td>
                                                <td>{{number_format($rayon[$i]['losses'])}}</td>
                                            </tr>
                                        @endfor

                                        </tbody>
                                        {{--JUMLAH--}}
                                        <thead>
                                        <tr>
                                            <th colspan="3" class="text-left">JUMLAH</th>
                                            <th class="text-right"><b>{{number_format($total_jumlah['total_kwh'])}}</b></th>
                                            <th class="text-right"><b>{{number_format($total_jumlah['wbp'])}}</b></th>
                                            <th class="text-right"><b>{{number_format($total_jumlah['lwbp1'])}}</b></th>
                                            <th class="text-right"><b>{{number_format($total_jumlah['lwbp2'])}}</b></th>
                                            <th class="text-right"><b>{{number_format($total_jumlah['Kvarh'])}}</b></th>
                                            <th class="text-right"><b>{{number_format($total_jumlah['KW'])}}</b></th>
                                            <th class="text-right"><b>{{number_format($total_jumlah['KWH_lalu'])}}</b></th>
                                            <th class="text-right"><b>{{number_format($total_jumlah['KWH'])}}</b></th>
                                            <th class="text-right"><b>{{number_format($total_jumlah['persen'])}}</b></th>
                                            <th class="text-right"><b>{{number_format($total_jumlah['jual'])}}</b></th>
                                            <th class="text-right"><b>{{number_format($total_jumlah['susut'])}}</b></th>
                                            <th class="text-right"><b>{{number_format($total_jumlah['losses'])}}</b></th>
                                        </tr>
                                        </thead>
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