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
                                            <th><i>RAYON MANA HAYO</i></th>
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
                                            <th rowspan="3" class="text-center">KWH PENYULANG BULAN LALU</th>
                                            <th colspan="2" rowspan="2" class="text-center">NAIK/TURUN</th>
                                            <th colspan="3" rowspan="2" class="text-center">SUSUT</th>
                                            <th rowspan="3" class="text-center">RAYON</th>
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
                                            <th class="text-center">KWH JUAL</th>
                                            <th class="text-center">KWH SUSUT</th>
                                            <th class="text-center">LOSSES(%)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @for($j=0; $j<2; $j++)

                                        <div style="display: none;">{{$flag=true}}</div>
                                        @for($i=0; $i<4 ;$i++)

                                        <tr class="text-right">
                                            @if($i==3)
                                                @if($flag==true)
                                            <td class="text-center">{{$j+1}}</td>
                                            <td class="text-left">NAMA GI</td>
                                            <td class="text-center">NAMA TRAFO GI</td>
                                            <td class="text-center">40</td>
                                            <div style="display: none;">{{$flag=false}}</div>
                                                @else
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            @endif

                                            <td>{{number_format(1)}}</td>
                                            <td>{{number_format(1)}}</td>
                                            <td>{{number_format(1)}}</td>
                                            <td>{{number_format(1)}}</td>
                                            <td>-</td>
                                            <td>{{number_format(1)}}</td>
                                            <td>{{number_format(1)}}</td>
                                            <td>{{number_format(1)}}</td>
                                            <td>{{number_format(1)}}</td>
                                            <td>{{number_format(1)}}</td>
                                            <td>{{number_format(1)}}</td>
                                            <td>{{number_format(1)}}</td>
                                            <td class="text-left">NAMA RAYON</td>
                                            @endif
                                        </tr>
                                        @endfor
                                        <tr class="text-right">
                                            <td class="text-center"></td>
                                            <td colspan="3" class="text-center"><b>JUMLAH</b></td>
                                            <td><b>{{number_format(1)}}</b></td>
                                            <td><b>{{number_format(1)}}</b></td>
                                            <td><b>{{number_format(1)}}</b></td>
                                            <td><b>{{number_format(1)}}</b></td>
                                            <td><b>-</b></td>
                                            <td><b>{{number_format(1)}}</b></td>
                                            <td class="text-left"><b></b></td>
                                            <td><b>{{number_format(1)}}</b></td>
                                            <td><b>{{number_format(1)}}</b></td>
                                            <td><b>{{number_format(1)}}</b></td>
                                            <td><b>{{number_format(1)}}</b></td>
                                            <td><b>{{number_format(1)}}</b></td>
                                            <td><b></b></td>

                                        </tr>
                                    @endfor
                                        {{--JUMLAH--}}
                                    </tbody>
                                    {{-----------}}
                                    <thead>
                                        <tr>
                                            <td colspan="4" class="text-center"><b>JUMLAH</b></td>
                                            <td class="text-right"><b>{{1}}</b></td>
                                            <td class="text-right"><b>{{1}}</b></td>
                                            <td class="text-right"><b>{{1}}</b></td>
                                            <td class="text-right"><b>{{1}}</b></td>
                                            <td class="text-right"><b></b></td>
                                            <td class="text-right"><b>{{1}}</b></td>
                                            <td class="text-center"><b></b></td>
                                            <td class="text-right"><b>{{1}}</b></td>
                                            <td class="text-right"><b>{{1}}</b></td>
                                            <td class="text-right"><b>{{1}}</b></td>
                                            <td class="text-right"><b>{{1}}</b></td>
                                            <td class="text-right"><b>{{1}}</b></td>
                                            <td><b></b></td>
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