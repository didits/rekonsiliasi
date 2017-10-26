@extends('admin.master.app')
@section('title', 'Si-Oneng, Rekonsiliasi Energi')

@section('content')
    <div class="wrapper">
        @include('admin.master.navbar')
        <div class="main-panel">
            @include('admin.master.top_navbar', ['navbartitle' => "AREA " .    Auth::user()->nama_organisasi])
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title">Daftar Rayon</h4>
                                    <p class="category">Area {{Auth::user()->nama_organisasi}}</p>
                                </div>
                                <div class="content table-responsive table-full-width">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                        <th>RAYON</th>
                                        <th>ALAMAT RAYON</th>
                                        <th></th>
                                        </thead>
                                        <tbody>
                                        @foreach($data as $list)
                                        <tr>
                                            {{--<td><a href="{{route('area.list_gardu_induk', $list->id_organisasi)}}">{{$list->nama_organisasi}}</a></td>--}}
                                            <td>{{$list->nama_organisasi}}</td>
                                            <td>{{$list->alamat}}</td>
                                            <td>
                                                @if(!$transaksi)
                                                <a href="{{route('area.get_structure', $list->id)}}" rel="tooltip" title="" data-original-title="Single Line" class="btn btn-success btn-fill pull-right" style="margin-left:5pt">
                                                    <i class="fa fa-sitemap"></i>
                                                </a>

                                                @endif
                                                @if($laporan)
                                                <a href="{{route('area.list_master_gi', $list->id_organisasi)}}" rel="tooltip" title="" data-original-title="List GI" class="btn btn-info btn-fill pull-right" >
                                                    <i class="fa fa-th-list"></i>
                                                </a>
                                                @elseif($transaksi)
                                                <a href="{{route('area.view_beli_deviasi', [$list->id_organisasi, 'rayon',  $list->id])}}" rel="tooltip" title="" data-original-title="View Deviasi" style="margin-left:5pt"  class="btn btn-success btn-fill pull-right">
                                                    <i class="fa fa-pie-chart"></i>
                                                </a>
                                                <a href="{{route('area.view_beli_tsa', [$list->id_organisasi,$list->id,'rayon'])}}" rel="tooltip" title="" data-original-title="View TSA Penyulang" style="margin-left:5pt"  class="btn btn-success btn-fill pull-right">
                                                    <i class="fa fa-folder"></i>
                                                </a>
                                                <a href="{{route('area.list_beli_gi', $list->id_organisasi)}}" rel="tooltip" title="" data-original-title="List GI" class="btn btn-info btn-fill pull-right">
                                                    <i class="fa fa-th-list"></i>
                                                </a>

                                                @else
                                                <a href="{{route('area.list_datamaster', $list->id_organisasi)}}" rel="tooltip" title="" data-original-title="List GI" class="btn btn-info btn-fill pull-right" >
                                                    <i class="fa fa-th-list"></i>
                                                </a>

                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                    @if($transaksi)
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title">Laporan TSA</h4>
                                    <p class="category">Area {{Auth::user()->nama_organisasi}}</p>
                                </div>
                                <div class="content all-icons">
                                    <div class="row">
                                        <div class="font-icon-list col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                            <a href="{{route('area.view_beli_tsa_area', [Auth::user()->id_organisasi])}}" rel="tooltip" title="" data-original-title="">
                                                <button class="font-icon-detail btn btn-info btn-fill btn-wd">
                                                    <i class="pe-7s-map-2"></i><br/>Laporan<br/>TSA<br/>Area
                                                </button>
                                            </a>
                                        </div>
                                        <div class="font-icon-list col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                            <a href="{{route('area.view_beli_tsa', [Auth::user()->id_organisasi, 'area', 'gi'])}}" rel="tooltip" title="" data-original-title="">
                                                <button class="font-icon-detail btn btn-info btn-fill btn-wd">
                                                    <i class="pe-7s-albums"></i><br/>Laporan<br/>TSA<br/>Rayon
                                                </button>
                                            </a>
                                        </div>
                                        <div class="font-icon-list col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                            <a href="{{route('area.view_beli_tsa', [Auth::user()->id_organisasi, 'area', 'penyulang'])}}" rel="tooltip" title="" data-original-title="">
                                                <button class="font-icon-detail btn btn-info btn-fill btn-wd">
                                                    <i class="pe-7s-folder"></i><br/>Laporan<br/>TSA<br/>Penyulang
                                                </button>
                                            </a>
                                        </div>
                                        <div class="font-icon-list col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                            <a href="{{route('area.view_beli_deviasi', [Auth::user()->id_organisasi, 'area', 0])}}" rel="tooltip" title="" data-original-title="">
                                                <button class="font-icon-detail btn btn-info btn-fill btn-wd">
                                                    <i class="pe-7s-graph"></i><br/>Laporan<br/>Deviasi<br/><br/>
                                                </button>
                                            </a>
                                        </div>
                                        <div class="font-icon-list col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                            <a href="{{route('area.view_beli_pct',[Auth::user()->id_organisasi, 'pct', 0])}}" rel="tooltip" title="" data-original-title="">
                                                <button class="font-icon-detail btn btn-info btn-fill btn-wd">
                                                    <i class="pe-7s-refresh-2"></i><br/>Laporan<br/>PCT<br/><br/>
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                </div>
            </div>

            @include('admin.master.footer')

        </div>
    </div>
@endsection