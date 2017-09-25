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
                                        <th class="text-center">PEMBACAAN kWh METER {{$gi->nama_gi}}</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center">TRAFO I 150 / 20 KV. 30 MVA</th>
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
                                            <th rowspan="3" colspan="2" class="text-center">CELL 20 kV INCOMING / OUT GOING</th>
                                            <th rowspan="2" colspan="2" class="text-center">kWh Utama INCOMING<br>M - E</th>
                                            <th rowspan="2" colspan="2" class="text-center">kWh Pembanding INCOMING</th>
                                            <th rowspan="3" class="text-center">PEMAKAIAN<br>SENDIRI</th>
                                            <th rowspan="2" colspan="2" class="text-center">TOTAL PENYULANG</th>
                                            <th colspan="8" class="text-center">PENYULANG</th>
                                            <th rowspan="3" class="text-center">KETERANGAN</th>
                                        </tr>
                                        <tr>
                                            @foreach($data->penyulang as $p)
                                                @if($p->id_trafo_gi== $data->trafo[0]->id)
                                            <th colspan="2" class="text-center">{{$p->nama_penyulang}}</th>
                                                @endif
                                            @endforeach
                                            {{--<th colspan="2" class="text-center">TAWANGREJO</th>--}}
                                            {{--<th colspan="2" class="text-center">RANDU PITU</th>--}}
                                            {{--<th colspan="2" class="text-center">KUNCORO WESI</th>--}}
                                        </tr>
                                        <tr>
                                            <th class="text-center">VISUAL</th>
                                            <th class="text-center">DOWNLOAD</th>
                                            <th class="text-center">VISUAL</th>
                                            <th class="text-center">AMR</th>
                                            <th class="text-center">VISUAL</th>
                                            <th class="text-center">AMR</th>
                                            @foreach($data->penyulang as $p)
                                                @if($p->id_trafo_gi== $data->trafo[0]->id)
                                            <th class="text-center">VISUAL</th>
                                            <th class="text-center">AMR</th>
                                                @endif
                                            @endforeach

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="text-center">
                                            <td class="text-left">kWh METER</td>
                                            <td class="text-left">NOMOR</td>
                                            <td>{{json_decode($data->trafo[0]->data_master,true)['utama']['KWH']['nomorseri']}}</td>
                                            <td></td>
                                            <td>{{json_decode($data->trafo[0]->data_master,true)['pembanding']['KWH']['nomorseri']}}</td>
                                            <td></td>
                                            <td>{{json_decode($data->trafo[0]->data_master,true)['ps']['KWH']['nomorseri']}}</td>
                                            <td></td>
                                            <td></td>
                                            @foreach($data->penyulang as $p)
                                                @if($p->id_trafo_gi== $data->trafo[0]->id)
                                            <td>{{json_decode($p->data_master,true)['KWH']['nomorseri']}}</td>
                                            <td></td>
                                                @endif
                                            @endforeach
                                            <td></td>
                                        </tr>
                                        <tr class="text-center">
                                            <td class="text-left"></td>
                                            <td class="text-left">KONSTANTE</td>
                                            <td>{{json_decode($data->trafo[0]->data_master,true)['utama']['KWH']['konstanta']}}</td>
                                            <td></td>
                                            <td>{{json_decode($data->trafo[0]->data_master,true)['pembanding']['KWH']['konstanta']}}</td>
                                            <td></td>
                                            <td>{{json_decode($data->trafo[0]->data_master,true)['ps']['KWH']['konstanta']}}</td>
                                            <td></td>
                                            <td></td>
                                            @foreach($data->penyulang as $p)
                                                @if($p->id_trafo_gi== $data->trafo[0]->id)
                                            <td>{{json_decode($p->data_master,true)['KWH']['konstanta']}}</td>
                                            <td></td>
                                                @endif
                                            @endforeach
                                            <td></td>
                                        </tr>
                                        <tr class="text-center">
                                            <td class="text-left"></td>
                                            <td class="text-left">TEGANGAN / ARUS</td>
                                            <td>{{json_decode($data->trafo[0]->data_master,true)['utama']['KWH']['teganganarus']}}</td>
                                            <td></td>
                                            <td>{{json_decode($data->trafo[0]->data_master,true)['pembanding']['KWH']['teganganarus']}}</td>
                                            <td></td>
                                            <td>{{json_decode($data->trafo[0]->data_master,true)['ps']['KWH']['teganganarus']}}</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr class="text-center">
                                            <td class="text-left">TRAFO ARUS</td>
                                            <td class="text-left">RATED</td>
                                            <td>{{json_decode($data->trafo[0]->data_master,true)['utama']['TA']['ratioct']}}</td>
                                            <td></td>
                                            <td>{{json_decode($data->trafo[0]->data_master,true)['pembanding']['TA']['ratioct']}}</td>
                                            <td></td>
                                            <td>{{json_decode($data->trafo[0]->data_master,true)['ps']['TA']['ratioct']}}</td>
                                            <td></td>
                                            <td></td>
                                            @foreach($data->penyulang as $p)
                                                @if($p->id_trafo_gi== $data->trafo[0]->id)
                                            <td>{{json_decode($p->data_master,true)['TA']['ratioct']}}</td>
                                            <td></td>
                                                @endif
                                            @endforeach
                                            <td></td>
                                        </tr>
                                        <tr class="text-center">
                                            <td class="text-left"></td>
                                            <td class="text-left">BURDEN ( VA )</td>
                                            <td>{{json_decode($data->trafo[0]->data_master,true)['utama']['TA']['burdenct']}}</td>
                                            <td></td>
                                            <td>{{json_decode($data->trafo[0]->data_master,true)['pembanding']['TA']['burdenct']}}</td>
                                            <td></td>
                                            <td>{{json_decode($data->trafo[0]->data_master,true)['ps']['TA']['burdenct']}}</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr class="text-center">
                                            <td class="text-left">TRAFO TEGANGAN</td>
                                            <td class="text-left">RATED</td>
                                            <td>{{json_decode($data->trafo[0]->data_master,true)['utama']['TT']['ratiopt']}}</td>
                                            <td></td>
                                            <td>{{json_decode($data->trafo[0]->data_master,true)['pembanding']['TT']['ratiopt']}}</td>
                                            <td></td>
                                            <td>{{json_decode($data->trafo[0]->data_master,true)['ps']['TT']['ratiopt']}}</td>
                                            <td></td>
                                            <td></td>
                                            @foreach($data->penyulang as $p)
                                                @if($p->id_trafo_gi== $data->trafo[0]->id)
                                            <td>{{json_decode($p->data_master,true)['TT']['ratiopt']}}</td>
                                            <td></td>
                                                @endif
                                            @endforeach
                                            <td></td>
                                        </tr>
                                        <tr class="text-center">
                                            <td class="text-left"></td>
                                            <td class="text-left">BURDEN ( VA )</td>
                                            <td>{{json_decode($data->trafo[0]->data_master,true)['utama']['TT']['burdenpt']}}</td>
                                            <td></td>
                                            <td>{{json_decode($data->trafo[0]->data_master,true)['pembanding']['TT']['burdenpt']}}</td>
                                            <td></td>
                                            <td>{{json_decode($data->trafo[0]->data_master,true)['ps']['TT']['burdenpt']}}</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
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
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        {{--LWBP 1--}}
                                        <tr class="text-right">
                                            <td class="text-left">STAND AWAL</td>
                                            <td class="text-left">LWBP 1</td>
                                            <td>{{json_decode($data->p_trafo[0]->data,true)['beli']['utama']['visual']['lwbp1_visual']}}</td>
                                            <td>{{json_decode($data->p_trafo[0]->data,true)['beli']['utama']['download']['lwbp1_download']}}</td>
                                            <td>{{json_decode($data->p_trafo[0]->data,true)['beli']['pembanding']['visual']['lwbp1_visual']}}</td>
                                            <td>{{json_decode($data->p_trafo[0]->data,true)['beli']['pembanding']['download']['lwbp1_download']}}</td>
                                            <td>{{json_decode($data->p_trafo[0]->data,true)['beli']['ps']['visual']['lwbp1_visual']}}</td>
                                            <td></td>
                                            <td></td>
                                            @for ($j=0; $j < count($penyulang); $j++)
                                                @if($penyulang[$j]['id_trafo']== $data->p_trafo[0]->id_trafo_gi)
                                            <td>{{json_decode($penyulang[$j]['data'],true)['beli']['visual']['lwbp1_visual']}}</td>
                                            <td>{{json_decode($penyulang[$j]['data'],true)['beli']['download']['lwbp1_download']}}</td>
                                                @endif
                                            @endfor
                                            <td></td>
                                        </tr>
                                        <tr class="text-right">
                                            <td class="text-left">STAND AKHIR</td>
                                            <td class="text-left">LWBP 1</td>
                                            <td>{{json_decode($data->p_trafo_[0]->data,true)['beli']['utama']['visual']['lwbp1_visual']}}</td>
                                            <td>{{json_decode($data->p_trafo_[0]->data,true)['beli']['utama']['download']['lwbp1_download']}}</td>
                                            <td>{{json_decode($data->p_trafo_[0]->data,true)['beli']['pembanding']['visual']['lwbp1_visual']}}</td>
                                            <td>{{json_decode($data->p_trafo_[0]->data,true)['beli']['pembanding']['download']['lwbp1_download']}}</td>
                                            <td>{{json_decode($data->p_trafo_[0]->data,true)['beli']['ps']['visual']['lwbp1_visual']}}</td>
                                            <td></td>
                                            <td></td>
                                            @for ($j=0; $j < count($penyulang); $j++)
                                                @if($penyulang[$j]['id_trafo']== $data->p_trafo[0]->id_trafo_gi)
                                            <td>{{json_decode($penyulang[$j]['data_'],true)['beli']['visual']['lwbp1_visual']}}</td>
                                            <td>{{json_decode($penyulang[$j]['data_'],true)['beli']['download']['lwbp1_download']}}</td>
                                                @endif
                                            @endfor
                                            <td></td>
                                        </tr>
                                        <tr class="text-right">
                                            <td colspan="2" class="text-left">SELISIH PEMBACAAN</td>
                                            <td>{{abs(json_decode($data->p_trafo_[0]->data,true)['beli']['utama']['visual']['lwbp1_visual']-json_decode($data->p_trafo[0]->data,true)['beli']['utama']['visual']['lwbp1_visual'])}}</td>
                                            <td>{{abs(json_decode($data->p_trafo_[0]->data,true)['beli']['utama']['download']['lwbp1_download']-json_decode($data->p_trafo[0]->data,true)['beli']['utama']['download']['lwbp1_download'])}}</td>
                                            <td>{{abs(json_decode($data->p_trafo_[0]->data,true)['beli']['pembanding']['visual']['lwbp1_visual']-json_decode($data->p_trafo[0]->data,true)['beli']['pembanding']['visual']['lwbp1_visual'])}}</td>
                                            <td>{{abs(json_decode($data->p_trafo_[0]->data,true)['beli']['pembanding']['download']['lwbp1_download']-json_decode($data->p_trafo[0]->data,true)['beli']['pembanding']['download']['lwbp1_download'])}}</td>
                                            <td>{{abs(json_decode($data->p_trafo_[0]->data,true)['beli']['ps']['download']['lwbp1_download']-json_decode($data->p_trafo[0]->data,true)['beli']['ps']['download']['lwbp1_download'])}}</td>
                                            <td></td>
                                            <td></td>
                                            @for ($j=0; $j < count($penyulang); $j++)
                                                @if($penyulang[$j]['id_trafo']== $data->p_trafo[0]->id_trafo_gi)
                                            <td>{{abs(json_decode($penyulang[$j]['data'],true)['beli']['visual']['lwbp1_visual']-json_decode($penyulang[$j]['data_'],true)['beli']['visual']['lwbp1_visual'])}}</td>
                                            <td>{{abs(json_decode($penyulang[$j]['data'],true)['beli']['download']['lwbp1_download']-json_decode($penyulang[$j]['data_'],true)['beli']['download']['lwbp1_download'])}}</td>
                                                @endif
                                            @endfor
                                            <td></td>
                                        </tr>
                                        <tr class="text-right">
                                            <td colspan="2" class="text-left">FAKTOR KALI METER</td>
                                            <td>{{json_decode($data->trafo[0]->data_master,true)['utama']['FK']['faktorkali']}}</td>
                                            <td>{{json_decode($data->trafo[0]->data_master,true)['utama']['FK']['faktorkali']}}</td>
                                            <td>{{json_decode($data->trafo[0]->data_master,true)['pembanding']['FK']['faktorkali']}}</td>
                                            <td>{{json_decode($data->trafo[0]->data_master,true)['pembanding']['FK']['faktorkali']}}</td>
                                            <td>{{json_decode($data->trafo[0]->data_master,true)['ps']['FK']['faktorkali']}}</td>
                                            <td></td>
                                            <td></td>
                                            @for ($j=0; $j < count($penyulang); $j++)
                                                @if($penyulang[$j]['id_trafo']== $data->p_trafo[0]->id_trafo_gi)
                                            <td>{{json_decode($data->penyulang[$j]->data_master,true)['FK']['faktorkali']}}</td>
                                            <td>{{json_decode($data->penyulang[$j]->data_master,true)['FK']['faktorkali']}}</td>
                                                @endif
                                            @endfor
                                            <td></td>
                                        </tr>
                                        <tr class="text-right">
                                            <td colspan="2" class="text-left">PEMAKAIAN ENERGI LWBP 1 ( kWh )</td>
                                            <td>{{json_decode($data->p_trafo_[0]->data,true)['hasil_pengolahan']['utama']['visual']['lwbp1_visual']}}</td>
                                            <td class="danger">{{json_decode($data->p_trafo_[0]->data,true)['hasil_pengolahan']['utama']['download']['lwbp1_download']}}</td>
                                            <td>{{json_decode($data->p_trafo_[0]->data,true)['hasil_pengolahan']['pembanding']['visual']['lwbp1_visual']}}</td>
                                            <td>{{json_decode($data->p_trafo_[0]->data,true)['hasil_pengolahan']['pembanding']['download']['lwbp1_download']}}</td>
                                            <td>{{json_decode($data->p_trafo_[0]->data,true)['hasil_pengolahan']['ps']['visual']['lwbp1_visual']}}</td>
                                            <td>3,413,720</td>
                                            <td></td>
                                            @for ($j=0; $j < count($penyulang); $j++)
                                                @if($penyulang[$j]['id_trafo']== $data->p_trafo[0]->id_trafo_gi)
                                            <td>{{abs(json_decode($penyulang[$j]['data'],true)['hasil_pengolahan']['visual']['lwbp1_visual'])}}</td>
                                            <td>{{abs(json_decode($penyulang[$j]['data'],true)['hasil_pengolahan']['download']['lwbp1_download'])}}</td>
                                               @endif
                                            @endfor
                                            <td></td>
                                        </tr>
                                        {{--LWBP 2--}}
                                        <tr class="text-right">
                                            <td class="text-left">STAND AWAL</td>
                                            <td class="text-left">LWBP 2</td>
                                            <td>{{json_decode($data->p_trafo[0]->data,true)['beli']['utama']['visual']['lwbp2_visual']}}</td>
                                            <td>{{json_decode($data->p_trafo[0]->data,true)['beli']['utama']['download']['lwbp2_download']}}</td>
                                            <td>{{json_decode($data->p_trafo[0]->data,true)['beli']['pembanding']['visual']['lwbp2_visual']}}</td>
                                            <td>{{json_decode($data->p_trafo[0]->data,true)['beli']['pembanding']['download']['lwbp2_download']}}</td>
                                            <td>{{json_decode($data->p_trafo[0]->data,true)['beli']['ps']['visual']['lwbp2_visual']}}</td>
                                            <td></td>
                                            <td></td>
                                            @for ($j=0; $j < count($penyulang); $j++)
                                                @if($penyulang[$j]['id_trafo']== $data->p_trafo[0]->id_trafo_gi)
                                                    <td>{{json_decode($penyulang[$j]['data'],true)['beli']['visual']['lwbp2_visual']}}</td>
                                                    <td>{{json_decode($penyulang[$j]['data'],true)['beli']['download']['lwbp2_download']}}</td>
                                                @endif
                                            @endfor
                                            <td></td>
                                        </tr>
                                        <tr class="text-right">
                                            <td class="text-left">STAND AKHIR</td>
                                            <td class="text-left">LWBP 2</td>
                                            <td>{{json_decode($data->p_trafo_[0]->data,true)['beli']['utama']['visual']['lwbp2_visual']}}</td>
                                            <td>{{json_decode($data->p_trafo_[0]->data,true)['beli']['utama']['download']['lwbp2_download']}}</td>
                                            <td>{{json_decode($data->p_trafo_[0]->data,true)['beli']['pembanding']['visual']['lwbp2_visual']}}</td>
                                            <td>{{json_decode($data->p_trafo_[0]->data,true)['beli']['pembanding']['download']['lwbp2_download']}}</td>
                                            <td>{{json_decode($data->p_trafo_[0]->data,true)['beli']['ps']['visual']['lwbp2_visual']}}</td>
                                            <td></td>
                                            <td></td>
                                            @for ($j=0; $j < count($penyulang); $j++)
                                                @if($penyulang[$j]['id_trafo']== $data->p_trafo[0]->id_trafo_gi)
                                                    <td>{{json_decode($penyulang[$j]['data_'],true)['beli']['visual']['lwbp2_visual']}}</td>
                                                    <td>{{json_decode($penyulang[$j]['data_'],true)['beli']['download']['lwbp2_download']}}</td>
                                                @endif
                                            @endfor
                                            <td></td>
                                        </tr>
                                        <tr class="text-right">
                                            <td colspan="2" class="text-left">SELISIH PEMBACAAN</td>
                                            <td>{{abs(json_decode($data->p_trafo_[0]->data,true)['beli']['utama']['visual']['lwbp2_visual']-json_decode($data->p_trafo[0]->data,true)['beli']['utama']['visual']['lwbp2_visual'])}}</td>
                                            <td>{{abs(json_decode($data->p_trafo_[0]->data,true)['beli']['utama']['download']['lwbp2_download']-json_decode($data->p_trafo[0]->data,true)['beli']['utama']['download']['lwbp2_download'])}}</td>
                                            <td>{{abs(json_decode($data->p_trafo_[0]->data,true)['beli']['pembanding']['visual']['lwbp2_visual']-json_decode($data->p_trafo[0]->data,true)['beli']['pembanding']['visual']['lwbp2_visual'])}}</td>
                                            <td>{{abs(json_decode($data->p_trafo_[0]->data,true)['beli']['pembanding']['download']['lwbp2_download']-json_decode($data->p_trafo[0]->data,true)['beli']['pembanding']['download']['lwbp2_download'])}}</td>
                                            <td>{{abs(json_decode($data->p_trafo_[0]->data,true)['beli']['ps']['download']['lwbp2_download']-json_decode($data->p_trafo[0]->data,true)['beli']['ps']['download']['lwbp2_download'])}}</td>
                                            <td></td>
                                            <td></td>
                                            @for ($j=0; $j < count($penyulang); $j++)
                                                @if($penyulang[$j]['id_trafo']== $data->p_trafo[0]->id_trafo_gi)
                                                    <td>{{abs(json_decode($penyulang[$j]['data'],true)['beli']['visual']['lwbp2_visual']-json_decode($penyulang[$j]['data_'],true)['beli']['visual']['lwbp2_visual'])}}</td>
                                                    <td>{{abs(json_decode($penyulang[$j]['data'],true)['beli']['download']['lwbp2_download']-json_decode($penyulang[$j]['data_'],true)['beli']['download']['lwbp2_download'])}}</td>
                                                @endif
                                            @endfor
                                            <td></td>
                                        </tr>
                                        <tr class="text-right">
                                            <td colspan="2" class="text-left">FAKTOR KALI METER</td>
                                            <td>{{json_decode($data->trafo[0]->data_master,true)['utama']['FK']['faktorkali']}}</td>
                                            <td>{{json_decode($data->trafo[0]->data_master,true)['utama']['FK']['faktorkali']}}</td>
                                            <td>{{json_decode($data->trafo[0]->data_master,true)['pembanding']['FK']['faktorkali']}}</td>
                                            <td>{{json_decode($data->trafo[0]->data_master,true)['pembanding']['FK']['faktorkali']}}</td>
                                            <td>{{json_decode($data->trafo[0]->data_master,true)['ps']['FK']['faktorkali']}}</td>
                                            <td></td>
                                            <td></td>
                                            @for ($j=0; $j < count($penyulang); $j++)
                                                @if($penyulang[$j]['id_trafo']== $data->p_trafo[0]->id_trafo_gi)
                                                    <td>{{json_decode($data->penyulang[$j]->data_master,true)['FK']['faktorkali']}}</td>
                                                    <td>{{json_decode($data->penyulang[$j]->data_master,true)['FK']['faktorkali']}}</td>
                                                @endif
                                            @endfor
                                            <td></td>
                                        </tr>
                                        <tr class="text-right">
                                            <td colspan="2" class="text-left">PEMAKAIAN ENERGI LWBP 2 ( kWh )</td>
                                            <td>{{json_decode($data->p_trafo_[0]->data,true)['hasil_pengolahan']['utama']['visual']['lwbp2_visual']}}</td>
                                            <td class="danger">{{json_decode($data->p_trafo_[0]->data,true)['hasil_pengolahan']['utama']['download']['lwbp2_download']}}</td>
                                            <td>{{json_decode($data->p_trafo_[0]->data,true)['hasil_pengolahan']['pembanding']['visual']['lwbp2_visual']}}</td>
                                            <td>{{json_decode($data->p_trafo_[0]->data,true)['hasil_pengolahan']['pembanding']['download']['lwbp2_download']}}</td>
                                            <td>{{json_decode($data->p_trafo_[0]->data,true)['hasil_pengolahan']['ps']['visual']['lwbp2_visual']}}</td>
                                            <td>5,682,320</td>
                                            <td></td>
                                            @for ($j=0; $j < count($penyulang); $j++)
                                                @if($penyulang[$j]['id_trafo']== $data->p_trafo[0]->id_trafo_gi)
                                            <td>{{abs(json_decode($penyulang[$j]['data'],true)['hasil_pengolahan']['visual']['lwbp2_visual'])}}</td>
                                            <td>{{abs(json_decode($penyulang[$j]['data'],true)['hasil_pengolahan']['download']['lwbp2_download'])}}</td>
                                                @endif
                                            @endfor
                                            <td></td>
                                        </tr>
                                        {{--WBP--}}
                                        <tr class="text-right">
                                            <td class="text-left">STAND AWAL</td>
                                            <td class="text-left">WBP</td>
                                            <td>{{json_decode($data->p_trafo[0]->data,true)['beli']['utama']['visual']['wbp_visual']}}</td>
                                            <td>{{json_decode($data->p_trafo[0]->data,true)['beli']['utama']['download']['wbp_download']}}</td>
                                            <td>{{json_decode($data->p_trafo[0]->data,true)['beli']['pembanding']['visual']['wbp_visual']}}</td>
                                            <td>{{json_decode($data->p_trafo[0]->data,true)['beli']['pembanding']['download']['wbp_download']}}</td>
                                            <td>{{json_decode($data->p_trafo[0]->data,true)['beli']['ps']['visual']['wbp_visual']}}</td>
                                            <td></td>
                                            <td></td>
                                            @for ($j=0; $j < count($penyulang); $j++)
                                                @if($penyulang[$j]['id_trafo']== $data->p_trafo[0]->id_trafo_gi)
                                                    <td>{{json_decode($penyulang[$j]['data'],true)['beli']['visual']['wbp_visual']}}</td>
                                                    <td>{{json_decode($penyulang[$j]['data'],true)['beli']['download']['wbp_download']}}</td>
                                                @endif
                                            @endfor
                                            <td></td>
                                        </tr>
                                        <tr class="text-right">
                                            <td class="text-left">STAND AKHIR</td>
                                            <td class="text-left">WBP</td>
                                            <td>{{json_decode($data->p_trafo_[0]->data,true)['beli']['utama']['visual']['wbp_visual']}}</td>
                                            <td>{{json_decode($data->p_trafo_[0]->data,true)['beli']['utama']['download']['wbp_download']}}</td>
                                            <td>{{json_decode($data->p_trafo_[0]->data,true)['beli']['pembanding']['visual']['wbp_visual']}}</td>
                                            <td>{{json_decode($data->p_trafo_[0]->data,true)['beli']['pembanding']['download']['wbp_download']}}</td>
                                            <td>{{json_decode($data->p_trafo_[0]->data,true)['beli']['ps']['visual']['wbp_visual']}}</td>
                                            <td></td>
                                            <td></td>
                                            @for ($j=0; $j < count($penyulang); $j++)
                                                @if($penyulang[$j]['id_trafo']== $data->p_trafo[0]->id_trafo_gi)
                                                    <td>{{json_decode($penyulang[$j]['data_'],true)['beli']['visual']['wbp_visual']}}</td>
                                                    <td>{{json_decode($penyulang[$j]['data_'],true)['beli']['download']['wbp_download']}}</td>
                                                @endif
                                            @endfor
                                            <td></td>
                                        </tr>
                                        <tr class="text-right">
                                            <td colspan="2" class="text-left">SELISIH PEMBACAAN</td>
                                            <td>{{abs(json_decode($data->p_trafo_[0]->data,true)['beli']['utama']['visual']['wbp_visual']-json_decode($data->p_trafo[0]->data,true)['beli']['utama']['visual']['wbp_visual'])}}</td>
                                            <td>{{abs(json_decode($data->p_trafo_[0]->data,true)['beli']['utama']['download']['wbp_download']-json_decode($data->p_trafo[0]->data,true)['beli']['utama']['download']['wbp_download'])}}</td>
                                            <td>{{abs(json_decode($data->p_trafo_[0]->data,true)['beli']['pembanding']['visual']['wbp_visual']-json_decode($data->p_trafo[0]->data,true)['beli']['pembanding']['visual']['wbp_visual'])}}</td>
                                            <td>{{abs(json_decode($data->p_trafo_[0]->data,true)['beli']['pembanding']['download']['wbp_download']-json_decode($data->p_trafo[0]->data,true)['beli']['pembanding']['download']['wbp_download'])}}</td>
                                            <td>{{abs(json_decode($data->p_trafo_[0]->data,true)['beli']['ps']['download']['wbp_download']-json_decode($data->p_trafo[0]->data,true)['beli']['ps']['download']['wbp_download'])}}</td>
                                            <td></td>
                                            <td></td>
                                            @for ($j=0; $j < count($penyulang); $j++)
                                                @if($penyulang[$j]['id_trafo']== $data->p_trafo[0]->id_trafo_gi)
                                                    <td>{{abs(json_decode($penyulang[$j]['data'],true)['beli']['visual']['wbp_visual']-json_decode($penyulang[$j]['data_'],true)['beli']['visual']['wbp_visual'])}}</td>
                                                    <td>{{abs(json_decode($penyulang[$j]['data'],true)['beli']['download']['wbp_download']-json_decode($penyulang[$j]['data_'],true)['beli']['download']['wbp_download'])}}</td>
                                                @endif
                                            @endfor
                                            <td></td>
                                        </tr>
                                        <tr class="text-right">
                                            <td colspan="2" class="text-left">FAKTOR KALI METER</td>
                                            <td>{{json_decode($data->trafo[0]->data_master,true)['utama']['FK']['faktorkali']}}</td>
                                            <td>{{json_decode($data->trafo[0]->data_master,true)['utama']['FK']['faktorkali']}}</td>
                                            <td>{{json_decode($data->trafo[0]->data_master,true)['pembanding']['FK']['faktorkali']}}</td>
                                            <td>{{json_decode($data->trafo[0]->data_master,true)['pembanding']['FK']['faktorkali']}}</td>
                                            <td>{{json_decode($data->trafo[0]->data_master,true)['ps']['FK']['faktorkali']}}</td>
                                            <td></td>
                                            <td></td>
                                            @for ($j=0; $j < count($penyulang); $j++)
                                                @if($penyulang[$j]['id_trafo']== $data->p_trafo[0]->id_trafo_gi)
                                            <td>{{json_decode($data->penyulang[$j]->data_master,true)['FK']['faktorkali']}}</td>
                                            <td>{{json_decode($data->penyulang[$j]->data_master,true)['FK']['faktorkali']}}</td>
                                                @endif
                                            @endfor
                                            <td></td>
                                        </tr>
                                        <tr class="text-right">
                                            <td colspan="2" class="text-left">PEMAKAIAN ENERGI WBP ( kWh )</td>
                                            <td>{{json_decode($data->p_trafo_[0]->data,true)['hasil_pengolahan']['utama']['visual']['wbp_visual']}}</td>
                                            <td class="danger">{{json_decode($data->p_trafo_[0]->data,true)['hasil_pengolahan']['utama']['download']['wbp_download']}}</td>
                                            <td>{{json_decode($data->p_trafo_[0]->data,true)['hasil_pengolahan']['pembanding']['visual']['wbp_visual']}}</td>
                                            <td>{{json_decode($data->p_trafo_[0]->data,true)['hasil_pengolahan']['pembanding']['download']['wbp_download']}}</td>
                                            <td>{{json_decode($data->p_trafo_[0]->data,true)['hasil_pengolahan']['ps']['visual']['wbp_visual']}}</td>
                                            <td>1,822,720</td>
                                            <td></td>
                                            @for ($j=0; $j < count($penyulang); $j++)
                                                @if($penyulang[$j]['id_trafo']== $data->p_trafo[0]->id_trafo_gi)
                                            <td>{{abs(json_decode($penyulang[$j]['data'],true)['hasil_pengolahan']['visual']['wbp_visual'])}}</td>
                                            <td>{{abs(json_decode($penyulang[$j]['data'],true)['hasil_pengolahan']['download']['wbp_download'])}}</td>
                                                @endif
                                            @endfor
                                            <td></td>
                                        </tr>
                                        {{----}}
                                        <tr class="text-right">
                                            <td colspan="2" class="text-left">TOTAL PEMAKAIAN ENERGI (LWBP+WBP)</td>
                                            <td>{{json_decode($data->p_trafo_[0]->data,true)['hasil_pengolahan']['utama']['visual']['total_pemakaian_kwh_visual']}}</td>
                                            <td>{{json_decode($data->p_trafo_[0]->data,true)['hasil_pengolahan']['utama']['download']['total_pemakaian_kwh_download']}}</td>
                                            <td>{{json_decode($data->p_trafo_[0]->data,true)['hasil_pengolahan']['pembanding']['visual']['total_pemakaian_kwh_visual']}}</td>
                                            <td>{{json_decode($data->p_trafo_[0]->data,true)['hasil_pengolahan']['pembanding']['download']['total_pemakaian_kwh_download']}}</td>
                                            <td>{{json_decode($data->p_trafo_[0]->data,true)['hasil_pengolahan']['ps']['visual']['total_pemakaian_kwh_visual']}}</td>
                                            <td>10,918,760</td>
                                            <td>-</td>
                                            @for ($j=0; $j < count($penyulang); $j++)
                                                @if($penyulang[$j]['id_trafo']== $data->p_trafo[0]->id_trafo_gi)
                                                    <td>{{abs(json_decode($penyulang[$j]['data'],true)['hasil_pengolahan']['visual']['total_pemakaian_kwh_visual'])}}</td>
                                                    <td>-</td>
                                                @endif
                                            @endfor
                                            <td></td>
                                        </tr>
                                        <tr class="text-right">
                                            <td colspan="2" class="text-left">PEMAKAIAN KVARH</td>
                                            <td></td>
                                            <td class="warning">-</td>
                                            <td></td>
                                            <td></td>
                                            <td>13,685</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr class="text-right">
                                            <td colspan="2" class="text-left">PEMAKAIAN KVARH</td>
                                            <td></td>
                                            <td class="warning">17,097</td>
                                            <td></td>
                                            <td></td>
                                            <td>18</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        {{----}}
                                        <tr class="text-right">
                                            <td class="text-left">SELISIH kWh INCOMING</td>
                                            <td class="text-left">PEMBANDING</td>
                                            <td></td>
                                            <td></td>
                                            <td><i>({{abs(json_decode($data->p_trafo_[0]->data,true)['hasil_pengolahan']['utama']['download']['total_pemakaian_kwh_download']-json_decode($data->p_trafo_[0]->data,true)['hasil_pengolahan']['pembanding']['visual']['total_pemakaian_kwh_visual'])
                                            /json_decode($data->p_trafo_[0]->data,true)['hasil_pengolahan']['utama']['download']['total_pemakaian_kwh_download']*100}})</i></td>
                                            <td>{{abs(json_decode($data->p_trafo_[0]->data,true)['hasil_pengolahan']['utama']['download']['total_pemakaian_kwh_download']-json_decode($data->p_trafo_[0]->data,true)['hasil_pengolahan']['pembanding']['download']['total_pemakaian_kwh_download'])
                                            /json_decode($data->p_trafo_[0]->data,true)['hasil_pengolahan']['utama']['download']['total_pemakaian_kwh_download']*100}}</td>
                                            <td class="text-left"><i>%</i></td>
                                            <td><i>100.00</i></td>
                                            <td class="text-left"><i>% (inc >&ltout AMR)</i></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr class="text-right">
                                            <td class="text-left">SELISIH kWh INCOMING</td>
                                            <td class="text-left">OUT GOING</td>
                                            <td></td>
                                            <td></td>
                                            <td><i>(0.70)</i></td>
                                            <td>{{abs(json_decode($data->p_trafo_[0]->data,true)['hasil_pengolahan']['pembanding']['visual']['total_pemakaian_kwh_visual']-json_decode($data->p_trafo_[0]->data,true)['hasil_pengolahan']['pembanding']['download']['total_pemakaian_kwh_download'])
                                            /json_decode($data->p_trafo_[0]->data,true)['hasil_pengolahan']['pembanding']['visual']['total_pemakaian_kwh_visual']*100}}</td>
                                            <td class="text-left"><i>%</i></td>
                                            <td><i>100.00</i></td>
                                            <td class="text-left"><i>% (visual >&lt AMR)</i></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        {{----}}
                                        <tr class="text-right">
                                            <td colspan="2" class="text-left">PEMAKAIAN ENERGI BULAN LALU</td>
                                            <td>9,304,476</td>
                                            <td>9,304,021</td>
                                            <td>9,317,840</td>
                                            <td>-</td>
                                            <td>13,515</td>
                                            <td>9,462,660</td>
                                            <td>-</td>
                                            <td>2,764,990</td>
                                            <td>-</td>
                                            <td>944,840</td>
                                            <td>-</td>
                                            <td>2,127,520</td>
                                            <td>-</td>
                                            <td>3,625,310</td>
                                            <td>-</td>
                                            <td></td>
                                        </tr>
                                        <tr class="text-right">
                                            <td colspan="2"></td>
                                            <td></td>
                                            <td>10,842,831</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>2,836,328</td>
                                            <td></td>
                                            <td>1,248,865</td>
                                            <td></td>
                                            <td>2,570,797</td>
                                            <td></td>
                                            <td>4,186,841</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
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