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
                                            <th><i>AREA {{$area}}</i></th>
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
                                    <tbody>
                                        <tr class="text-right">
                                            <td class="text-center">1</td>
                                            <td class="text-left">GI PAITON</td>
                                            <td class="text-center">I</td>
                                            <td>5,077,342</td>
                                            <td>2,195</td>
                                            <td>5,075,147</td>
                                            <td>5,081,417</td>
                                            <td>5,084,470</td>
                                            <td>(4,075)</td>
                                            <td>(0.08)</td>
                                            <td>(9,323)</td>
                                            <td>(0.18)</td>
                                            <td>(5,248)</td>
                                            <td>(0.10)</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr class="text-right">
                                            <td class="text-center">2</td>
                                            <td class="text-left">GI KRAKSAAN</td>
                                            <td class="text-center">I</td>
                                            <td>9,408,343</td>
                                            <td>13,273</td>
                                            <td>9,395,070</td>
                                            <td>9,426,750</td>
                                            <td>10,429,790</td>
                                            <td>(18,407)</td>
                                            <td>(0.20)</td>
                                            <td>(1,034,720)</td>
                                            <td>(11.01)</td>
                                            <td>(1,016,313)</td>
                                            <td>(10.80)</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr class="text-right">
                                            <td class="text-center"></td>
                                            <td class="text-left"></td>
                                            <td class="text-center">II</td>
                                            <td>5,518,343</td>
                                            <td>-</td>
                                            <td>5,518,343</td>
                                            <td>5,526,790</td>
                                            <td>4,574,220</td>
                                            <td>(8,447)</td>
                                            <td>(0.15)</td>
                                            <td>944,123</td>
                                            <td>17.11</td>
                                            <td>952,570</td>
                                            <td>17.24</td>
                                            <td></td>
                                            <td></td>
                                        </tr>

                                    </tbody>
                                    {{-----------}}
                                    <thead>
                                        <tr>
                                            <th colspan="3" class="text-center">JUMLAH</th>
                                            <th class="text-right">310,379,523</th>
                                            <th class="text-right">189,788</th>
                                            <th class="text-right">310,189,735</th>
                                            <th class="text-right">310,264,944</th>
                                            <th class="text-right">311,439,100</th>
                                            <th class="text-right">114,579</th>
                                            <th class="text-right">0.04</th>
                                            <th class="text-right">(1,249,366)</th>
                                            <th class="text-right">(0.40)</th>
                                            <th class="text-right">(1,189,624)</th>
                                            <th class="text-right">(0.38)</th>
                                            <th class="text-center"></th>
                                            <th class="text-center"></th>
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