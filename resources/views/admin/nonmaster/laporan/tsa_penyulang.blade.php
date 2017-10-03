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
                    <div class="col-xs-9">
                        <div class="card">
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                    <tr>
                                        <th></th>
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
                                    <tbody>
                                        <tr class="text-right">
                                            <td class="text-center">1</td>
                                            <td class="text-left">GI-PAITON</td>
                                            <td class="text-center">Trafo-1</td>
                                            <td class="text-center">40</td>
                                            <td class="text-center">BHINOR</td>
                                            <td>878,031</td>
                                            <td>1,240,708</td>
                                            <td>594,865</td>
                                            <td>2,713,604</td>
                                            <td>-</td>
                                            <td>5,074</td>
                                            <td class="text-left">KRAKSAAN</td>
                                            <td>2,682,770</td>
                                            <td>30,834</td>
                                            <td>1.15</td>
                                        </tr>
                                        <tr class="text-right">
                                            <td class="text-center"></td>
                                            <td class="text-left"></td>
                                            <td class="text-center"></td>
                                            <td class="text-center"></td>
                                            <td class="text-center">PAKUNIRAN</td>
                                            <td>745,803</td>
                                            <td>1,053,862</td>
                                            <td>505,281</td>
                                            <td>2,304,946</td>
                                            <td>-</td>
                                            <td>4,310</td>
                                            <td class="text-left">KRAKSAAN</td>
                                            <td>2,320,208</td>
                                            <td>(15,262)</td>
                                            <td>(0.66)</td>
                                        </tr>
                                        <tr class="text-right">
                                            <td class="text-center"></td>
                                            <td class="text-left"></td>
                                            <td class="text-center"></td>
                                            <td class="text-center"></td>
                                            <td class="text-center">ASH DISPOSAL</td>
                                            <td>18,313</td>
                                            <td>25,877</td>
                                            <td>12,407</td>
                                            <td>56,597</td>
                                            <td>-</td>
                                            <td>106</td>
                                            <td class="text-left">KRAKSAAN</td>
                                            <td>53,012</td>
                                            <td>3,585</td>
                                            <td>6.76</td>
                                        </tr>
                                        {{--JUMLAH--}}
                                        <tr class="text-right">
                                            <td class="text-center"></td>
                                            <td colspan="4" class="text-center"><b>JUMLAH</b></td>
                                            <td><b>1,642,147</b></td>
                                            <td><b>2,320,447</b></td>
                                            <td><b>1,112,553</b></td>
                                            <td><b>5,075,147</b></td>
                                            <td><b>-</b></td>
                                            <td><b>9,490</b></td>
                                            <td class="text-left"><b></b></td>
                                            <td><b>5,055,990</b></td>
                                            <td><b>19,157</b></td>
                                            <td><b>0.38</b></td>
                                        </tr>
                                    </tbody>
                                    {{-----------}}
                                    <thead>
                                        <tr>
                                            <th colspan="5" class="text-center">JUMLAH</th>
                                            <th class="text-right">96,608,967</th>
                                            <th class="text-right">157,469,807</th>
                                            <th class="text-right">56,110,961</th>
                                            <th class="text-right">310,189,735</th>
                                            <th class="text-right">122,493</th>
                                            <th class="text-right">472,476</th>
                                            <th class="text-center"></th>
                                            <th class="text-right">276,839,751</th>
                                            <th class="text-right">33,349,984</th>
                                            <th class="text-right">12.05</th>
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