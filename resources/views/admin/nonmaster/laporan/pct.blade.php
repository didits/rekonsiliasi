@extends('admin.master.app')
@section('title', 'Si-Oneng, Rekonsiliasi Energi')

@section('content')

    <div class="wrapper">
        @include('admin.master.top_navbar', ['navbartitle' => "LAPORAN PCT"])

        @include('admin.master.navbar')

        <div class="main-panel">

            {{--Laporan PCT--}}
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
                                                <th class="text-center">TOTAL PEMAKAIAN KWH PCT/EXIM</th>
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
                                    <a href="{{route('area.excel_beli_pct' , [$id_organisasi, $tipe, $id])}}" rel="tooltip" title="" data-original-title="">
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
                                                <th rowspan="2" class="text-center">NO</th>
                                                <th rowspan="2" class="text-center">LOKASI</th>
                                                <th rowspan="2" class="text-center">GI</th>
                                                <th rowspan="2" class="text-center">PENYULANG</th>
                                                <th rowspan="2" class="text-center">ANTAR UNIT</th>
                                                <th rowspan="2" class="text-center">FAKTOR KALI</th>
                                                <th colspan="2" class="text-center">STAND EKSPOR</th>
                                                <th rowspan="2" class="text-center">TOTAL KWH<br/>EXPORT</th>
                                                <th colspan="2" class="text-center">STAND IMPOR</th>
                                                <th rowspan="2" class="text-center">TOTAL KWH<br/>IMPORT</th>
                                            </tr>
                                            <tr>
                                                <th class="text-center">AWAL</th>
                                                <th class="text-center">AKHIR</th>
                                                <th class="text-center">AWAL</th>
                                                <th class="text-center">AKHIR</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr></tr>
                                        @for($i=0; $i<count($p_gardu) ;$i++)

                                            <tr class="text-right">
                                                <td class="text-center">{{$i+1}}</td>
                                                {{--{{dd(json_decode($gardu[$i]['data_master'],true)['meter']['FK']['faktorkali'])}}--}}
                                                <td class="text-left">{{$p_gardu[$i]['nama_gardu']}}</td>
                                                <td class="text-left">{{json_decode($p_gardu[$i]['rincian'],true)['gi']}}</td>
                                                <td class="text-left">{{json_decode($p_gardu[$i]['rincian'],true)['penyulang']}}</td>
                                                <td class="text-left">{{json_decode($p_gardu[$i]['rincian'],true)['antar_unit']}}</td>
                                                <td class="text-left">{{number_format(json_decode($p_gardu[$i]['data_master'],true)['meter']['FK']['faktorkali'],0)}}</td>
                                                {{--@if($p_gardu[$i]['tipe'])--}}
                                                @if(json_decode($p_gardu[$i]['data'],true)['hasil_pengolahan']['ekspor']['total_kwh_download']==0)
                                                <td>{{number_format(json_decode($p_gardu[$i]['data'],true)['beli']['ekspor']['visual']['awal_visual'],2)}}</td>
                                                <td>{{number_format(json_decode($p_gardu[$i]['data'],true)['beli']['ekspor']['visual']['akhir_visual'],2)}}</td>
                                                <td>{{number_format(json_decode($p_gardu[$i]['data'],true)['hasil_pengolahan']['ekspor']['total_kwh_visual'],2)}}</td>
                                                @else
                                                <td>-</td>
                                                <td>-</td>
                                                <td>{{number_format(json_decode($p_gardu[$i]['data'],true)['hasil_pengolahan']['ekspor']['total_kwh_download'],2)}}</td>
                                                @endif
                                                {{--@else--}}
                                                {{--@if(json_decode($p_gardu[$i]['data'],true)['hasil_pengolahan']['impor']['total_kwh_download']==0)--}}
                                                {{--<td>{{number_format(json_decode($p_gardu[$i]['data'],true)['beli']['impor']['visual']['awal_visual'],2)}}</td>--}}
                                                {{--<td>{{number_format(json_decode($p_gardu[$i]['data'],true)['beli']['impor']['visual']['akhir_visual'],2)}}</td>--}}
                                                {{--<td>{{number_format(json_decode($p_gardu[$i]['data'],true)['hasil_pengolahan']['impor']['total_kwh_visual'],2)}}</td>--}}
                                                {{--@else--}}
                                                {{--<td>-</td>--}}
                                                {{--<td>-</td>--}}
                                                {{--<td>{{number_format(json_decode($p_gardu[$i]['data'],true)['hasil_pengolahan']['impor']['total_kwh_download'],2)}}</td>--}}
                                                {{--@endif--}}
                                                {{--@endif--}}

                                                {{--@if($p_gardu[$i]['tipe'])--}}
                                                @if(json_decode($p_gardu[$i]['data'],true)['hasil_pengolahan']['impor']['total_kwh_download']==0)
                                                <td>{{number_format(json_decode($p_gardu[$i]['data'],true)['beli']['impor']['visual']['awal_visual'],2)}}</td>
                                                <td>{{number_format(json_decode($p_gardu[$i]['data'],true)['beli']['impor']['visual']['akhir_visual'],2)}}</td>
                                                <td>{{number_format(json_decode($p_gardu[$i]['data'],true)['hasil_pengolahan']['impor']['total_kwh_visual'],2)}}</td>
                                                @else
                                                <td>-</td>
                                                <td>-</td>
                                                <td>{{number_format(json_decode($p_gardu[$i]['data'],true)['hasil_pengolahan']['impor']['total_kwh_download'],2)}}</td>
                                                @endif
                                                {{--@else--}}
                                                {{--@if(json_decode($p_gardu[$i]['data'],true)['hasil_pengolahan']['ekspor']['total_kwh_download']==0)--}}
                                                {{--<td>{{number_format(json_decode($p_gardu[$i]['data'],true)['beli']['ekspor']['visual']['awal_visual'],2)}}</td>--}}
                                                {{--<td>{{number_format(json_decode($p_gardu[$i]['data'],true)['beli']['ekspor']['visual']['akhir_visual'],2)}}</td>--}}
                                                {{--<td>{{number_format(json_decode($p_gardu[$i]['data'],true)['hasil_pengolahan']['ekspor']['total_kwh_visual'],2)}}</td>--}}
                                                {{--@else--}}
                                                {{--<td>-</td>--}}
                                                {{--<td>-</td>--}}
                                                {{--<td>{{number_format(json_decode($p_gardu[$i]['data'],true)['hasil_pengolahan']['ekspor']['total_kwh_download'],2)}}</td>--}}
                                                {{--@endif--}}
                                                {{--@endif--}}
                                            </tr>
                                        @endfor

                                        </tbody>
                                        {{-----------}}
                                        <thead>
                                            <tr>
                                                @for($i=0; $i<8; $i++)

                                                <td class="text-right"><b></b></td>
                                                @endfor

                                                <td class="text-right"><b>{{number_format($total_e,2)}}</b></td>
                                                @for($i=0; $i<2; $i++)

                                                <td class="text-right"><b></b></td>
                                                @endfor

                                                <td class="text-right"><b>{{number_format($total_i,2)}}</b></td>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{--Laporan PCT Terurai--}}
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
                                                <th class="text-center">TOTAL PEMAKAIAN KWH PCT/EXIM</th>
                                            </tr>
                                            <tr>
                                                <th class="text-center">TERURAI</th>
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
                                    <a href="{{route('area.excel_beli_pct' , [$id_organisasi, $tipe, $id])}}" rel="tooltip" title="" data-original-title="">
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
                                                <th rowspan="2" class="text-center">NO</th>
                                                <th rowspan="2" class="text-center">LOKASI</th>
                                                <th rowspan="2" class="text-center">GI</th>
                                                <th rowspan="2" class="text-center">PENYULANG</th>
                                                <th rowspan="2" class="text-center">ANTAR UNIT</th>
                                                <th colspan="5" class="text-center">EKSPOR</th>
                                                <th colspan="5" class="text-center">IMPOR</th>
                                            </tr>
                                            <tr>
                                            @for($i=0; $i<2; $i++)

                                                <th class="text-center">WBP</th>
                                                <th class="text-center">LWBP1</th>
                                                <th class="text-center">LWBP2</th>
                                                <th class="text-center">KVARH</th>
                                                <th class="text-center">KW</th>
                                            @endfor

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr></tr>
                                        @for($i=0; $i<count($dt_urai) ;$i++)

                                            <tr class="text-right">
                                                <td class="text-center">{{$i+1}}</td>
                                                <td class="text-left">{{$dt_urai[$i]['pct']}}</td>
                                                <td class="text-left">{{json_decode($dt_urai[$i]['rincian'],true)['gi']}}</td>
                                                <td class="text-left">{{json_decode($dt_urai[$i]['rincian'],true)['penyulang']}}</td>
                                                <td class="text-left">{{json_decode($dt_urai[$i]['rincian'],true)['antar_unit']}}</td>
                                                {{--EKSPOR--}}
                                                <td>{{number_format($dt_urai[$i]['wbp_e'],0)}}</td>
                                                <td>{{number_format($dt_urai[$i]['lwbp1_e'],0)}}</td>
                                                <td>{{number_format($dt_urai[$i]['lwbp2_e'],0)}}</td>
                                                <td>{{number_format($dt_urai[$i]['kvar_e'],0)}}</td>
                                                <td>{{number_format($dt_urai[$i]['kw_e'],0)}}</td>
                                                {{--IMPOR--}}
                                                <td>{{number_format($dt_urai[$i]['wbp_i'],0)}}</td>
                                                <td>{{number_format($dt_urai[$i]['lwbp1_i'],0)}}</td>
                                                <td>{{number_format($dt_urai[$i]['lwbp2_i'],0)}}</td>
                                                <td>{{number_format($dt_urai[$i]['kvar_i'],0)}}</td>
                                                <td>{{number_format($dt_urai[$i]['kw_i'],0)}}</td>
                                            </tr>
                                        @endfor

                                        </tbody>
                                        {{-----------}}
                                        <thead>
                                            <tr></tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{--Laporan PCT Terurai Pemakaian Rayon--}}
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
                                            <th class="text-center">TOTAL PEMAKAIAN KWH PCT/EXIM</th>
                                        </tr>
                                        <tr>
                                            <th class="text-center">PEMAKAIAN RAYON</th>
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
                                    <a href="{{route('area.excel_beli_pct' , [$id_organisasi, $tipe, $id])}}" rel="tooltip" title="" data-original-title="">
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
                                            <th rowspan="2" class="text-center">RAYON</th>
                                            <th colspan="5" class="text-center">EKSPOR</th>
                                            <th colspan="5" class="text-center">IMPOR</th>
                                        </tr>
                                        <tr>
                                            @for($i=0; $i<2; $i++)

                                                <th class="text-center">WBP</th>
                                                <th class="text-center">LWBP1</th>
                                                <th class="text-center">LWBP2</th>
                                                <th class="text-center">KVARH</th>
                                                <th class="text-center">KW</th>
                                            @endfor

                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr></tr>
                                        @for($i=0; $i<count($dt_rayon) ;$i++)

                                            <tr class="text-right">
                                                <td class="text-left">{{$dt_rayon[$i]['nama_rayon']}}</td>
                                                {{--EKSPOR--}}
                                                <td>{{number_format($dt_rayon[$i]['wbp_e'],0)}}</td>
                                                <td>{{number_format($dt_rayon[$i]['lwbp1_e'],0)}}</td>
                                                <td>{{number_format($dt_rayon[$i]['lwbp2_e'],0)}}</td>
                                                <td>{{number_format($dt_rayon[$i]['kvar_e'],0)}}</td>
                                                <td>{{number_format($dt_rayon[$i]['kw_e'],0)}}</td>
                                                {{--IMPOR--}}
                                                <td>{{number_format($dt_rayon[$i]['wbp_i'],0)}}</td>
                                                <td>{{number_format($dt_rayon[$i]['lwbp1_i'],0)}}</td>
                                                <td>{{number_format($dt_rayon[$i]['lwbp2_i'],0)}}</td>
                                                <td>{{number_format($dt_rayon[$i]['kvar_i'],0)}}</td>
                                                <td>{{number_format($dt_rayon[$i]['kw_i'],0)}}</td>
                                            </tr>
                                        @endfor

                                        </tbody>
                                        {{-----------}}
                                        <thead>
                                            <tr></tr>
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