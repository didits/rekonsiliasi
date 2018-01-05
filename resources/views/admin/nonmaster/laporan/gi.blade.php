@extends('admin.master.app')
@section('title', 'Si-Oneng, Rekonsiliasi Energi')

@section('content')

<div class="wrapper">
    @include('admin.master.top_navbar', ['navbartitle' => "LAPORAN GI"])

    @include('admin.master.navbar')

    <div class="main-panel">
        @for($tr=0;$tr<count($dt_trafo);$tr++)
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
                                        <th class="text-center">PEMBACAAN kWh METER {{$gi->nama_gi}}</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center">{{$data_master[$tr]['nama']}} {{(json_decode($data_master[$tr]["data_master"],true)['kapasitas']['tegangan'])}} KV. {{(json_decode($data_master[$tr]["data_master"],true)['kapasitas']['kapasitas'])}} MVA</th>
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
                                @if (Auth::user()->tipe_organisasi == 2)

                                <a href="{{route('area.view_excel_beli' , [$id_organisasi, $tipe, $id, $tr])}}" rel="tooltip" title="" data-original-title="">
                                @else

                                <a href="{{route('rayon.view_excel_beli' , [$id_organisasi, $tipe, $id, $tr])}}" rel="tooltip" title="" data-original-title="">
                                @endif

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
                                            <th rowspan="3" colspan="2" class="text-center">CELL 20 kV INCOMING / OUT GOING</th>
                                            <th rowspan="2" colspan="2" class="text-center">kWh Utama INCOMING<br>M - E</th>
                                            <th rowspan="2" colspan="2" class="text-center">kWh Pembanding INCOMING</th>
                                            <th rowspan="3" class="text-center">PEMAKAIAN<br>SENDIRI</th>
                                            <th rowspan="2" colspan="2" class="text-center">TOTAL PENYULANG</th>
                                            <th colspan="{{2*count($dt_trafo[$tr])}}" class="text-center">PENYULANG</th>
                                            <th rowspan="3" class="text-center">KETERANGAN</th>
                                        </tr>
                                        <tr>
                                            @for ($j=0; $j < count($dt_trafo[$tr]); $j++)
                                                <th colspan="2" class="text-center">{{$dt_trafo[$tr][$j]['nama']}}</th>
                                            @endfor
                                        </tr>
                                        <tr>
                                            <th class="text-center">VISUAL</th>
                                            <th class="text-center">DOWNLOAD</th>
                                            <th class="text-center">VISUAL</th>
                                            <th class="text-center">AMR</th>
                                            <th class="text-center">VISUAL</th>
                                            <th class="text-center">AMR</th>
                                            @for ($j=0; $j < count($dt_trafo[$tr]); $j++)
                                            <th class="text-center">VISUAL</th>
                                            <th class="text-center">AMR</th>
                                            @endfor
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="text-center">
                                            <td class="text-left">kWh METER</td>
                                            <td class="text-left">NOMOR</td>
                                            <td>{{json_decode($data_master[$tr]['data_master'],true)['utama']['KWH']['nomorseri']}}</td>
                                            <td></td>
                                            <td>{{json_decode($data_master[$tr]['data_master'],true)['pembanding']['KWH']['nomorseri']}}</td>
                                            <td></td>
                                            <td>{{json_decode($data_master[$tr]['data_master'],true)['ps']['KWH']['nomorseri']}}</td>
                                            <td></td>
                                            <td></td>
                                            @for ($j=0; $j < count($dt_trafo[$tr]); $j++)
                                            <td>{{json_decode($dt_trafo[$tr][$j]['data_master'],true)['KWH']['nomorseri']}}</td>
                                            <td></td>
                                            @endfor
                                            <td></td>
                                        </tr>
                                        <tr class="text-center">
                                            <td class="text-left"></td>
                                            <td class="text-left">KONSTANTE</td>
                                            <td>{{json_decode($data_master[$tr]['data_master'],true)['utama']['KWH']['konstanta']}}</td>
                                            <td></td>
                                            <td>{{json_decode($data_master[$tr]['data_master'],true)['pembanding']['KWH']['konstanta']}}</td>
                                            <td></td>
                                            <td>{{json_decode($data_master[$tr]['data_master'],true)['ps']['KWH']['konstanta']}}</td>
                                            <td></td>
                                            <td></td>
                                            @for ($j=0; $j < count($dt_trafo[$tr]); $j++)
                                            <td>{{json_decode($dt_trafo[$tr][$j]['data_master'],true)['KWH']['konstanta']}}</td>
                                            <td></td>
                                            @endfor
                                            <td></td>
                                        </tr>
                                        <tr class="text-center">
                                            <td class="text-left"></td>
                                            <td class="text-left">TEGANGAN / ARUS</td>
                                            <td>{{json_decode($data_master[$tr]['data_master'],true)['utama']['KWH']['teganganarus']}}</td>
                                            <td></td>
                                            <td>{{json_decode($data_master[$tr]['data_master'],true)['pembanding']['KWH']['teganganarus']}}</td>
                                            <td></td>
                                            <td>{{json_decode($data_master[$tr]['data_master'],true)['ps']['KWH']['teganganarus']}}</td>
                                            <td></td>
                                            <td></td>
                                            @for ($j=0; $j < count($dt_trafo[$tr]); $j++)
                                                <td></td>
                                                <td></td>
                                            @endfor

                                            <td></td>
                                        </tr>
                                        <tr class="text-center">
                                            <td class="text-left">TRAFO ARUS</td>
                                            <td class="text-left">RATED</td>
                                            <td>{{json_decode($data_master[$tr]['data_master'],true)['utama']['TA']['ratioct']}}</td>
                                            <td></td>
                                            <td>{{json_decode($data_master[$tr]['data_master'],true)['pembanding']['TA']['ratioct']}}</td>
                                            <td></td>
                                            <td>{{json_decode($data_master[$tr]['data_master'],true)['ps']['TA']['ratioct']}}</td>
                                            <td></td>
                                            <td></td>
                                            @for ($j=0; $j < count($dt_trafo[$tr]); $j++)
                                            <td>{{json_decode($dt_trafo[$tr][$j]['data_master'],true)['TA']['ratioct']}}</td>
                                            <td></td>
                                            @endfor

                                            <td></td>
                                        </tr>
                                        <tr class="text-center">
                                            <td class="text-left"></td>
                                            <td class="text-left">BURDEN ( VA )</td>
                                            <td>{{json_decode($data_master[$tr]['data_master'],true)['utama']['TA']['burdenct']}}</td>
                                            <td></td>
                                            <td>{{json_decode($data_master[$tr]['data_master'],true)['pembanding']['TA']['burdenct']}}</td>
                                            <td></td>
                                            <td>{{json_decode($data_master[$tr]['data_master'],true)['ps']['TA']['burdenct']}}</td>
                                            <td></td>
                                            <td></td>
                                            @for ($j=0; $j < count($dt_trafo[$tr]); $j++)
                                                <td></td>
                                                <td></td>
                                            @endfor

                                            <td></td>
                                        </tr>
                                        <tr class="text-center">
                                            <td class="text-left">TRAFO TEGANGAN</td>
                                            <td class="text-left">RATED</td>
                                            <td>{{json_decode($data_master[$tr]['data_master'],true)['utama']['TT']['ratiopt']}}</td>
                                            <td></td>
                                            <td>{{json_decode($data_master[$tr]['data_master'],true)['pembanding']['TT']['ratiopt']}}</td>
                                            <td></td>
                                            <td>{{json_decode($data_master[$tr]['data_master'],true)['ps']['TT']['ratiopt']}}</td>
                                            <td></td>
                                            <td></td>
                                            @for ($j=0; $j < count($dt_trafo[$tr]); $j++)
                                            <td>{{json_decode($dt_trafo[$tr][$j]['data_master'],true)['TT']['ratiopt']}}</td>
                                            <td></td>
                                            @endfor
                                            <td></td>
                                        </tr>
                                        <tr class="text-center">
                                            <td class="text-left"></td>
                                            <td class="text-left">BURDEN ( VA )</td>
                                            <td>{{json_decode($data_master[$tr]['data_master'],true)['utama']['TT']['burdenpt']}}</td>
                                            <td></td>
                                            <td>{{json_decode($data_master[$tr]['data_master'],true)['pembanding']['TT']['burdenpt']}}</td>
                                            <td></td>
                                            <td>{{json_decode($data_master[$tr]['data_master'],true)['ps']['TT']['burdenpt']}}</td>
                                            <td></td>
                                            <td></td>
                                            @for ($j=0; $j < count($dt_trafo[$tr]); $j++)
                                                <td></td>
                                                <td></td>
                                            @endfor

                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">PENUNJUKAN STAND kWh METER</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            @for ($j=0; $j < count($dt_trafo[$tr]); $j++)
                                                <td></td>
                                                <td></td>
                                            @endfor

                                            <td></td>
                                        </tr>
                                        {{--LWBP 1--}}
                                        <tr class="text-right">
                                            <td class="text-left">STAND AWAL</td>
                                            <td class="text-left">LWBP 1</td>
                                            {{--@if(json_decode($data_master[$tr]['data'],true)['beli'] == null)--}}
                                            {{--<td>{{number_format(json_decode($data_master[$tr]['data'],true)['utama']['visual']['lwbp1_visual'], 2)}}</td>--}}
                                            {{--@else--}}
                                            <td>{{number_format(json_decode($data_master[$tr]['data'],true)['beli']['utama']['visual']['lwbp1_visual'], 2)}}</td>
                                            {{--@endif--}}
                                            <td></td>
                                            {{--<td>{{number_format(json_decode($data_master[$tr]['data'],true)['beli']['utama']['download']['lwbp1_download'], 2)}}</td>--}}
                                            <td>{{number_format(json_decode($data_master[$tr]['data'],true)['beli']['pembanding']['visual']['lwbp1_visual'], 2)}}</td>
                                            <td>{{number_format(json_decode($data_master[$tr]['data'],true)['beli']['pembanding']['download']['lwbp1_download'], 2)}}</td>
                                            <td>{{number_format(json_decode($data_master[$tr]['data'],true)['beli']['ps']['visual']['lwbp1_visual'], 2)}}</td>
                                            <td></td>
                                            <td></td>
                                            @for ($j=0; $j < count($dt_trafo[$tr]); $j++)
                                            <td>{{number_format(json_decode($dt_trafo[$tr][$j]['data'],true)['beli']['visual']['lwbp1_visual'], 2)}}</td>
                                            <td>{{number_format(json_decode($dt_trafo[$tr][$j]['data'],true)['beli']['download']['lwbp1_download'], 2)}}</td>
                                            @endfor
                                            <td></td>
                                        </tr>
                                        <tr class="text-right">
                                            <td class="text-left">STAND AKHIR</td>
                                            <td class="text-left">LWBP 1</td>
                                            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['utama']['visual']['lwbp1_visual'], 2)}}</td>
                                            {{--<td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['utama']['download']['lwbp1_download'], 2)}}</td>--}}
                                            <td></td>
                                            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['pembanding']['visual']['lwbp1_visual'], 2)}}</td>
                                            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['pembanding']['download']['lwbp1_download'], 2)}}</td>
                                            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['ps']['visual']['lwbp1_visual'], 2)}}</td>
                                            <td></td>
                                            <td></td>
                                            @for ($j=0; $j < count($dt_trafo[$tr]); $j++)
                                            <td>{{number_format(json_decode($dt_trafo[$tr][$j]['data_'],true)['beli']['visual']['lwbp1_visual'], 2)}}</td>
                                            <td>{{number_format(json_decode($dt_trafo[$tr][$j]['data_'],true)['beli']['download']['lwbp1_download'], 2)}}</td>
                                            @endfor
                                            <td></td>
                                        </tr>
                                        <tr class="text-right">
                                            <td colspan="2" class="text-left">SELISIH PEMBACAAN</td>
                                            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['utama']['visual']['lwbp1_visual']-json_decode($data_master[$tr]['data'],true)['beli']['utama']['visual']['lwbp1_visual'], 2)}}</td>
                                            <td></td>
                                            {{--<td>{{(json_decode($data_master[$tr]['data_'],true)['beli']['utama']['download']['lwbp1_download']-json_decode($data_master[$tr]['data'],true)['beli']['utama']['download']['lwbp1_download'])}}</td>--}}
                                            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['pembanding']['visual']['lwbp1_visual']-json_decode($data_master[$tr]['data'],true)['beli']['pembanding']['visual']['lwbp1_visual'], 2)}}</td>
                                            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['pembanding']['download']['lwbp1_download']-json_decode($data_master[$tr]['data'],true)['beli']['pembanding']['download']['lwbp1_download'], 2)}}</td>
                                            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['ps']['visual']['lwbp1_visual']-json_decode($data_master[$tr]['data'],true)['beli']['ps']['visual']['lwbp1_visual'], 2)}}</td>
                                            <td></td>
                                            <td></td>
                                            @for ($j=0; $j < count($dt_trafo[$tr]); $j++)
                                            <td>{{number_format(json_decode($dt_trafo[$tr][$j]['data_'],true)['beli']['visual']['lwbp1_visual']-json_decode($dt_trafo[$tr][$j]['data'],true)['beli']['visual']['lwbp1_visual'], 2)}}</td>
                                            <td>{{number_format(json_decode($dt_trafo[$tr][$j]['data_'],true)['beli']['download']['lwbp1_download']-json_decode($dt_trafo[$tr][$j]['data'],true)['beli']['download']['lwbp1_download'], 2)}}</td>
                                            @endfor
                                            <td></td>
                                        </tr>
                                        <tr class="text-right">
                                            <td colspan="2" class="text-left">FAKTOR KALI METER</td>
                                            <td>{{number_format(json_decode($data_master[$tr]['data_master'],true)['utama']['FK']['faktorkali'])}}</td>
                                            <td></td>
                                            {{--<td>{{json_decode($data->trafo[0]->data_master,true)['utama']['FK']['faktorkali']}}</td>--}}
                                            <td>{{number_format(json_decode($data_master[$tr]['data_master'],true)['pembanding']['FK']['faktorkali'])}}</td>
                                            <td>{{number_format(json_decode($data_master[$tr]['data_master'],true)['pembanding']['FK']['faktorkali'])}}</td>
                                            <td>{{number_format(json_decode($data_master[$tr]['data_master'],true)['ps']['FK']['faktorkali'])}}</td>
                                            <td></td>
                                            <td></td>
                                            @for ($j=0; $j < count($penyulang); $j++)
                                                @if($penyulang[$j]['id_trafo']== $data_master[$tr]['id_trafo'])
                                            <td>{{number_format(json_decode($data->penyulang[$j]->data_master,true)['FK']['faktorkali'])}}</td>
                                            <td>{{number_format(json_decode($data->penyulang[$j]->data_master,true)['FK']['faktorkali'])}}</td>
                                                @endif
                                            @endfor
                                            <td></td>
                                        </tr>
                                        <tr class="text-right">
                                            <td colspan="2" class="text-left">PEMAKAIAN ENERGI LWBP 1 ( kWh )</td>
                                            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['hasil_pengolahan']['utama']['visual']['lwbp1_visual'])}}</td>
                                            <td class="danger">{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['utama']['download']['lwbp1_download'])}}</td>
                                            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['hasil_pengolahan']['pembanding']['visual']['lwbp1_visual'])}}</td>
                                            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['hasil_pengolahan']['pembanding']['download']['lwbp1_download'])}}</td>
                                            @if($visual == 1)
                                            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['hasil_pengolahan']['ps']['visual']['lwbp1_visual'])}}</td>
                                            @elseif($visual == 0)
                                            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['hasil_pengolahan']['ps']['download']['lwbp1_download'])}}</td>
                                            @endif
                                            <td></td>
                                            <td></td>
                                            @for ($j=0; $j < count($dt_trafo[$tr]); $j++)
                                            <td>{{number_format(json_decode($dt_trafo[$tr][$j]['data_'],true)['hasil_pengolahan']['visual']['lwbp1_visual'])}}</td>
                                            <td>{{number_format(json_decode($dt_trafo[$tr][$j]['data_'],true)['hasil_pengolahan']['download']['lwbp1_download'])}}</td>
                                            @endfor
                                            <td></td>
                                        </tr>
                                        {{--LWBP 2--}}
                                        <tr class="text-right">
                                            <td class="text-left">STAND AWAL</td>
                                            <td class="text-left">LWBP 2</td>
                                            <td>{{number_format(json_decode($data_master[$tr]['data'],true)['beli']['utama']['visual']['lwbp2_visual'], 2)}}</td>
                                            <td></td>
                                            <td>{{number_format(json_decode($data_master[$tr]['data'],true)['beli']['pembanding']['visual']['lwbp2_visual'], 2)}}</td>
                                            <td>{{number_format(json_decode($data_master[$tr]['data'],true)['beli']['pembanding']['download']['lwbp2_download'], 2)}}</td>
                                            <td>{{number_format(json_decode($data_master[$tr]['data'],true)['beli']['ps']['visual']['lwbp2_visual'], 2)}}</td>
                                            <td></td>
                                            <td></td>
                                            @for ($j=0; $j < count($dt_trafo[$tr]); $j++)
                                            <td>{{number_format(json_decode($dt_trafo[$tr][$j]['data'],true)['beli']['visual']['lwbp2_visual'], 2)}}</td>
                                            <td>{{number_format(json_decode($dt_trafo[$tr][$j]['data'],true)['beli']['download']['lwbp2_download'], 2)}}</td>
                                            @endfor
                                            <td></td>
                                        </tr>
                                        <tr class="text-right">
                                            <td class="text-left">STAND AKHIR</td>
                                            <td class="text-left">LWBP 2</td>
                                            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['utama']['visual']['lwbp2_visual'], 2)}}</td>
                                            <td></td>
                                            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['pembanding']['visual']['lwbp2_visual'], 2)}}</td>
                                            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['pembanding']['download']['lwbp2_download'], 2)}}</td>
                                            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['ps']['visual']['lwbp2_visual'], 2)}}</td>
                                            <td></td>
                                            <td></td>
                                            @for ($j=0; $j < count($dt_trafo[$tr]); $j++)
                                            <td>{{number_format(json_decode($dt_trafo[$tr][$j]['data_'],true)['beli']['visual']['lwbp2_visual'], 2)}}</td>
                                            <td>{{number_format(json_decode($dt_trafo[$tr][$j]['data_'],true)['beli']['download']['lwbp2_download'], 2)}}</td>
                                            @endfor
                                            <td></td>
                                        </tr>
                                        <tr class="text-right">
                                            <td colspan="2" class="text-left">SELISIH PEMBACAAN</td>
                                            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['utama']['visual']['lwbp2_visual']-json_decode($data_master[$tr]['data'],true)['beli']['utama']['visual']['lwbp2_visual'], 2)}}</td>
                                            <td></td>
                                            {{--<td>{{(json_decode($data_master[$tr]['data_'],true)['beli']['utama']['download']['lwbp2_download']-json_decode($data_master[$tr]['data'],true)['beli']['utama']['download']['lwbp2_download'])}}</td>--}}
                                            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['pembanding']['visual']['lwbp2_visual']-json_decode($data_master[$tr]['data'],true)['beli']['pembanding']['visual']['lwbp2_visual'], 2)}}</td>
                                            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['pembanding']['download']['lwbp2_download']-json_decode($data_master[$tr]['data'],true)['beli']['pembanding']['download']['lwbp2_download'], 2)}}</td>
                                            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['ps']['visual']['lwbp2_visual']-json_decode($data_master[$tr]['data'],true)['beli']['ps']['visual']['lwbp2_visual'], 2)}}</td>
                                            <td></td>
                                            <td></td>
                                            @for ($j=0; $j < count($dt_trafo[$tr]); $j++)
                                            <td>{{number_format(json_decode($dt_trafo[$tr][$j]['data_'],true)['beli']['visual']['lwbp2_visual']-json_decode($dt_trafo[$tr][$j]['data'],true)['beli']['visual']['lwbp2_visual'], 2)}}</td>
                                            <td>{{number_format(json_decode($dt_trafo[$tr][$j]['data_'],true)['beli']['download']['lwbp2_download']-json_decode($dt_trafo[$tr][$j]['data'],true)['beli']['download']['lwbp2_download'], 2)}}</td>
                                            @endfor
                                            <td></td>
                                        </tr>
                                        <tr class="text-right">
                                            <td colspan="2" class="text-left">FAKTOR KALI METER</td>
                                            <td>{{number_format(json_decode($data_master[$tr]['data_master'],true)['utama']['FK']['faktorkali'])}}</td>
                                            <td></td>
                                            {{--<td>{{json_decode($data->trafo[0]->data_master,true)['utama']['FK']['faktorkali']}}</td>--}}
                                            <td>{{number_format(json_decode($data_master[$tr]['data_master'],true)['pembanding']['FK']['faktorkali'])}}</td>
                                            <td>{{number_format(json_decode($data_master[$tr]['data_master'],true)['pembanding']['FK']['faktorkali'])}}</td>
                                            <td>{{number_format(json_decode($data_master[$tr]['data_master'],true)['ps']['FK']['faktorkali'])}}</td>
                                            <td></td>
                                            <td></td>
                                            @for ($j=0; $j < count($dt_trafo[$tr]); $j++)
                                            <td>{{number_format(json_decode($dt_trafo[$tr][$j]['data_master'],true)['FK']['faktorkali'])}}</td>
                                            <td></td>
                                            @endfor
                                            <td></td>
                                        </tr>
                                        <tr class="text-right">
                                            <td colspan="2" class="text-left">PEMAKAIAN ENERGI LWBP 2 ( kWh )</td>
                                            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['hasil_pengolahan']['utama']['visual']['lwbp2_visual'])}}</td>
                                            <td class="danger">{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['utama']['download']['lwbp2_download'])}}</td>
                                            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['hasil_pengolahan']['pembanding']['visual']['lwbp2_visual'])}}</td>
                                            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['hasil_pengolahan']['pembanding']['download']['lwbp2_download'])}}</td>
                                            @if($visual == 1)
                                            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['hasil_pengolahan']['ps']['visual']['lwbp2_visual'])}}</td>
                                            @elseif($visual == 0)
                                            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['hasil_pengolahan']['ps']['download']['lwbp2_download'])}}</td>
                                            @endif
                                            <td></td>
                                            <td></td>
                                            @for ($j=0; $j < count($dt_trafo[$tr]); $j++)
                                            <td>{{number_format(json_decode($dt_trafo[$tr][$j]['data_'],true)['hasil_pengolahan']['visual']['lwbp2_visual'])}}</td>
                                            <td>{{number_format(json_decode($dt_trafo[$tr][$j]['data_'],true)['hasil_pengolahan']['download']['lwbp2_download'])}}</td>
                                            @endfor
                                            <td></td>
                                        </tr>
                                        {{--WBP--}}
                                        <tr class="text-right">
                                            <td class="text-left">STAND AWAL</td>
                                            <td class="text-left">WBP</td>
                                            <td>{{number_format(json_decode($data_master[$tr]['data'],true)['beli']['utama']['visual']['wbp_visual'], 2)}}</td>
                                            <td></td>
                                            <td>{{number_format(json_decode($data_master[$tr]['data'],true)['beli']['pembanding']['visual']['wbp_visual'], 2)}}</td>
                                            <td>{{number_format(json_decode($data_master[$tr]['data'],true)['beli']['pembanding']['download']['wbp_download'], 2)}}</td>
                                            <td>{{number_format(json_decode($data_master[$tr]['data'],true)['beli']['ps']['visual']['wbp_visual'], 2)}}</td>
                                            <td></td>
                                            <td></td>
                                            @for ($j=0; $j < count($dt_trafo[$tr]); $j++)
                                            <td>{{number_format(json_decode($dt_trafo[$tr][$j]['data'],true)['beli']['visual']['wbp_visual'], 2)}}</td>
                                            <td>{{number_format(json_decode($dt_trafo[$tr][$j]['data'],true)['beli']['download']['wbp_download'], 2)}}</td>
                                            @endfor
                                            <td></td>
                                        </tr>
                                        <tr class="text-right">
                                            <td class="text-left">STAND AKHIR</td>
                                            <td class="text-left">WBP</td>
                                            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['utama']['visual']['wbp_visual'], 2)}}</td>
                                            <td></td>
                                            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['pembanding']['visual']['wbp_visual'], 2)}}</td>
                                            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['pembanding']['download']['wbp_download'], 2)}}</td>
                                            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['ps']['visual']['wbp_visual'], 2)}}</td>
                                            <td></td>
                                            <td></td>
                                            @for ($j=0; $j < count($dt_trafo[$tr]); $j++)
                                            <td>{{number_format(json_decode($dt_trafo[$tr][$j]['data_'],true)['beli']['visual']['wbp_visual'], 2)}}</td>
                                            <td>{{number_format(json_decode($dt_trafo[$tr][$j]['data_'],true)['beli']['download']['wbp_download'], 2)}}</td>
                                            @endfor
                                            <td></td>
                                        </tr>
                                        <tr class="text-right">
                                            {{--{{dd($data_master[1]['data_'])}}--}}
                                            <td colspan="2" class="text-left">SELISIH PEMBACAAN</td>
                                            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['utama']['visual']['wbp_visual']-json_decode($data_master[$tr]['data'],true)['beli']['utama']['visual']['wbp_visual'], 2)}}</td>
                                            <td></td>
                                            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['pembanding']['visual']['wbp_visual']-json_decode($data_master[$tr]['data'],true)['beli']['pembanding']['visual']['wbp_visual'], 2)}}</td>
                                            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['pembanding']['download']['wbp_download']-json_decode($data_master[$tr]['data'],true)['beli']['pembanding']['download']['wbp_download'], 2)}}</td>
                                            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['ps']['visual']['wbp_visual']-json_decode($data_master[$tr]['data'],true)['beli']['ps']['visual']['wbp_visual'], 2)}}</td>
                                            <td></td>
                                            <td></td>
                                            @for ($j=0; $j < count($dt_trafo[$tr]); $j++)
                                            <td>{{number_format(json_decode($dt_trafo[$tr][$j]['data_'],true)['beli']['visual']['wbp_visual']-json_decode($dt_trafo[$tr][$j]['data'],true)['beli']['visual']['wbp_visual'], 2)}}</td>
                                            <td>{{number_format(json_decode($dt_trafo[$tr][$j]['data_'],true)['beli']['download']['wbp_download']-json_decode($dt_trafo[$tr][$j]['data'],true)['beli']['download']['wbp_download'], 2)}}</td>
                                            @endfor
                                            <td></td>
                                        </tr>
                                        <tr class="text-right">
                                            <td colspan="2" class="text-left">FAKTOR KALI METER</td>
                                            <td>{{number_format(json_decode($data_master[$tr]['data_master'],true)['utama']['FK']['faktorkali'])}}</td>
                                            <td></td>
                                            <td>{{number_format(json_decode($data_master[$tr]['data_master'],true)['pembanding']['FK']['faktorkali'])}}</td>
                                            <td>{{number_format(json_decode($data_master[$tr]['data_master'],true)['pembanding']['FK']['faktorkali'])}}</td>
                                            <td>{{number_format(json_decode($data_master[$tr]['data_master'],true)['ps']['FK']['faktorkali'])}}</td>
                                            <td></td>
                                            <td></td>
                                            @for ($j=0; $j < count($dt_trafo[$tr]); $j++)
                                            <td>{{number_format(json_decode($dt_trafo[$tr][$j]['data_master'],true)['FK']['faktorkali'])}}</td>
                                            <td></td>
                                            @endfor
                                            <td></td>
                                        </tr>
                                        <tr class="text-right">
                                            <td colspan="2" class="text-left">PEMAKAIAN ENERGI WBP ( kWh )</td>
                                            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['hasil_pengolahan']['utama']['visual']['wbp_visual'])}}</td>
                                            <td class="danger">{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['utama']['download']['wbp_download'])}}</td>
                                            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['hasil_pengolahan']['pembanding']['visual']['wbp_visual'])}}</td>
                                            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['hasil_pengolahan']['pembanding']['download']['wbp_download'])}}</td>
                                            @if($visual == 1)
                                            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['hasil_pengolahan']['ps']['visual']['wbp_visual'])}}</td>
                                            @elseif($visual == 0)
                                            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['hasil_pengolahan']['ps']['download']['wbp_download'])}}</td>
                                            @endif
                                            <td></td>
                                            <td></td>
                                            @for ($j=0; $j < count($dt_trafo[$tr]); $j++)
                                            <td>{{number_format(json_decode($dt_trafo[$tr][$j]['data_'],true)['hasil_pengolahan']['visual']['wbp_visual'])}}</td>
                                            <td>{{number_format(json_decode($dt_trafo[$tr][$j]['data_'],true)['hasil_pengolahan']['download']['wbp_download'])}}</td>
                                            @endfor
                                            <td></td>
                                        </tr>
                                        {{----}}
                                        <tr class="text-right">
                                            <td colspan="2" class="text-left">TOTAL PEMAKAIAN ENERGI (LWBP+WBP)</td>
                                            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['hasil_pengolahan']['utama']['visual']['total_pemakaian_kwh_visual'])}}</td>
                                            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['hasil_pengolahan']['utama']['download']['total_pemakaian_kwh_download'])}}</td>
                                            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['hasil_pengolahan']['pembanding']['visual']['total_pemakaian_kwh_visual'])}}</td>
                                            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['hasil_pengolahan']['pembanding']['download']['total_pemakaian_kwh_download'])}}</td>
                                            @if($visual == 1)
                                            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['hasil_pengolahan']['ps']['visual']['total_pemakaian_kwh_visual'], 0)}}</td>
                                            @elseif($visual == 0)
                                            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['hasil_pengolahan']['ps']['download']['total_pemakaian_kwh_download'], 0)}}</td>
                                            @endif
                                            <td>{{number_format($pemakaian[$tr]['total_pemakaian_energi_'])}}</td>
                                            @if($pemakaian[$tr]['total_pemakaian_energi_download_']>0)
                                            <td>{{number_format($pemakaian[$tr]['total_pemakaian_energi_'])}}</td>
                                            @else<td>-</td>
                                            @endif
                                            @for ($j=0; $j < count($dt_trafo[$tr]); $j++)
                                            <td>{{number_format(json_decode($dt_trafo[$tr][$j]['data_'],true)['hasil_pengolahan']['visual']['total_pemakaian_kwh_visual'])}}</td>
                                            <td>{{number_format(json_decode($dt_trafo[$tr][$j]['data_'],true)['hasil_pengolahan']['download']['total_pemakaian_kwh_download'])}}</td>
                                                {{--<td>-</td>--}}
                                            @endfor
                                            <td></td>
                                        </tr>
                                        <tr class="text-right">
                                            <td colspan="2" class="text-left">PEMAKAIAN KVARH</td>
                                            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['utama']['visual']['kvarh_visual'])}}</td>
                                            <td class="warning">{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['utama']['download']['kvarh_download'])}}</td>
                                            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['pembanding']['visual']['kvarh_visual'])}}</td>
                                            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['pembanding']['download']['kvarh_download'])}}</td>
                                            @if($visual == 1)
                                            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['ps']['visual']['kvarh_visual'])}}</td>
                                            @elseif($visual == 0)
                                            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['ps']['download']['kvarh_download'])}}</td>
                                            @endif
                                            <td></td>
                                            <td></td>
                                            @for ($j=0; $j < count($dt_trafo[$tr]); $j++)
                                                <td></td>
                                                <td></td>
                                            @endfor

                                            <td></td>
                                        </tr>
                                        <tr class="text-right">
                                            <td colspan="2" class="text-left">DAYA KONSIDEN</td>
                                            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['utama']['visual']['konsiden_visual'])}}</td>
                                            <td class="warning">{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['utama']['download']['konsiden_download'])}}</td>
                                            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['pembanding']['visual']['konsiden_visual'])}}</td>
                                            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['pembanding']['download']['konsiden_download'])}}</td>
                                            @if($visual == 1)
                                            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['ps']['visual']['konsiden_visual'])}}</td>
                                            @elseif($visual == 0)
                                            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['ps']['download']['konsiden_download'])}}</td>
                                            @endif
                                            <td></td>
                                            <td></td>
                                            @for ($j=0; $j < count($dt_trafo[$tr]); $j++)
                                                <td></td>
                                                <td></td>
                                            @endfor

                                            <td></td>
                                        </tr>
                                        {{----}}
                                        <tr class="text-right">
                                            <td class="text-left">SELISIH kWh INCOMING</td>
                                            <td class="text-left">PEMBANDING</td>
                                            <td></td>
                                            <td></td>
                                            <td><i>{{number_format($data_master[$tr]['s_pembanding'], 2)}}</i></td>
                                            <td>{{number_format($data_master[$tr]['p_pembanding'], 2)}}</td>
                                            <td class="text-left"><i>%</i></td>
                                            <td>{{number_format($data_master[$tr]['s_ps'], 2)}}</td>
                                            <td class="text-left"><i>% (inc >&ltout AMR)</i></td>
                                            @for ($j=0; $j < count($dt_trafo[$tr]); $j++)
                                                <td></td>
                                                <td></td>
                                            @endfor

                                            <td></td>
                                        </tr>
                                        <tr class="text-right">
                                            <td class="text-left">SELISIH kWh INCOMING</td>
                                            <td class="text-left">OUT GOING</td>
                                            <td></td>
                                            <td></td>
                                            <td><i>{{number_format($data_master[$tr]['s_out'], 2)}}</i></td>
                                            <td>{{number_format($data_master[$tr]['p_out'], 2)}}</td>
                                            <td class="text-left"><i>% (visual >&lt AMR)</i></td>
                                            <td></td>
                                            <td></td>
                                            @for ($j=0; $j < count($dt_trafo[$tr]); $j++)
                                                <td></td>
                                                <td></td>
                                            @endfor

                                            <td></td>
                                        </tr>
                                        {{----}}
                                        <tr class="text-right">
{{--                                            {{dd(json_decode($data_master[$tr]['data'],true))}}--}}
                                            <td colspan="2" class="text-left">PEMAKAIAN ENERGI BULAN LALU</td>
                                            <td>{{number_format(json_decode($data_master[$tr]['data'],true)['hasil_pengolahan']['utama']['visual']['total_pemakaian_kwh_visual'])}}</td>
                                            <td>{{number_format(json_decode($data_master[$tr]['data'],true)['hasil_pengolahan']['utama']['download']['total_pemakaian_kwh_download'])}}</td>
                                            <td>{{number_format(json_decode($data_master[$tr]['data'],true)['hasil_pengolahan']['pembanding']['visual']['total_pemakaian_kwh_visual'])}}</td>
                                            <td>{{number_format(json_decode($data_master[$tr]['data'],true)['hasil_pengolahan']['pembanding']['download']['total_pemakaian_kwh_download'])}}</td>
                                            @if($visual == 1)
                                            <td>{{number_format(json_decode($data_master[$tr]['data'],true)['hasil_pengolahan']['ps']['visual']['total_pemakaian_kwh_visual'])}}</td>
                                            @elseif($visual == 0)
                                            <td>{{number_format(json_decode($data_master[$tr]['data'],true)['hasil_pengolahan']['ps']['download']['total_pemakaian_kwh_download'])}}</td>
                                            @endif
                                            <td>{{number_format($sum[$tr])}}</td>
                                            <td>-</td>
                                            @for ($j=0; $j < count($dt_trafo[$tr]); $j++)
                                            <td>{{number_format(json_decode($dt_trafo[$tr][$j]['data'],true)['hasil_pengolahan']['visual']['total_pemakaian_kwh_visual'])}}</td>
                                            <td>{{number_format(json_decode($dt_trafo[$tr][$j]['data'],true)['hasil_pengolahan']['download']['total_pemakaian_kwh_download'])}}</td>
                                            {{--<td>-</td>--}}
                                            @endfor
                                            <td></td>
                                        </tr>
                                        <tr class="text-right">
                                            <td colspan="2"></td>
                                            <td></td>
                                            @if($visual == 1)
                                            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['hasil_pengolahan']['utama']['download']['total_pemakaian_kwh_download'] -json_decode($data_master[$tr]['data_'],true)['hasil_pengolahan']['ps']['visual']['total_pemakaian_kwh_visual'])}}</td>
                                            @elseif($visual == 0)
                                            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['hasil_pengolahan']['utama']['download']['total_pemakaian_kwh_download'] -json_decode($data_master[$tr]['data_'],true)['hasil_pengolahan']['ps']['download']['total_pemakaian_kwh_download'])}}</td>
                                            @endif
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            @for ($j=0; $j < count($penyulang); $j++)
                                            @if($deviasi[$j]['id_trafo']== $data_master[$tr]['id_trafo'])
                                            <td>{{number_format($deviasi[$j]['deviasi'])}}</td>
                                            <td>-</td>
                                            @endif
                                            @endfor
                                            <td>{{number_format($sum_[$tr])}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endfor
        @include('admin.master.footer')

    </div>
</div>
@endsection