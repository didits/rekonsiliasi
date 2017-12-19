@extends('admin.master.app')
@section('title', 'Si-Oneng, Rekonsiliasi Energi')

@section('content')
    <div class="wrapper">
        @include('admin.master.top_navbar', ['navbartitle' => Auth::user()->nama_organisasi])

        @include('admin.master.navbar')

        <div class="main-panel">
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title">Daftar Area</h4>
                                    <p class="category">{{Auth::user()->nama_organisasi}}</p>
                                </div>
                                <div class="content table-responsive table-full-width">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <th>ID AREA</th>
                                            <th>AREA</th>
                                            <th></th>
                                        </thead>
                                        <tbody>
                                        @foreach($data as $list)

                                            <tr>
                                                <td>{{$list->id_organisasi}}</td>
                                                <td>{{$list->nama_organisasi}}</td>
                                                <td>
                                                    @if($master)

                                                    <a href="{{route('distribusi.laporan_master', $list->id_organisasi)}}" rel="tooltip" title="" data-original-title="List Rayon" class="btn btn-info btn-fill pull-right" >
                                                        <i class="fa fa-th-list"></i>
                                                    </a>
                                                    @else

                                                    <a href="{{route('distribusi.laporan_beli', $list->id_organisasi)}}" rel="tooltip" title="" data-original-title="List Rayon" class="btn btn-info btn-fill pull-right" >
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
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title">Laporan TSA</h4>
                                    <p class="category">{{Auth::user()->nama_organisasi}}</p>
                                </div>
                                <div class="content all-icons">
                                    <div class="row">
                                        <div class="font-icon-list col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                            <a href="" rel="tooltip" title="" data-original-title="">
                                                <button class="font-icon-detail btn btn-info btn-fill btn-wd">
                                                    <i class="pe-7s-map-2"></i><br/>Laporan<br/>TSA<br/>Area
                                                </button>
                                            </a>
                                        </div>
                                        <div class="font-icon-list col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                            <a href="" rel="tooltip" title="" data-original-title="">
                                                <button class="font-icon-detail btn btn-info btn-fill btn-wd">
                                                    <i class="pe-7s-albums"></i><br/>Laporan<br/>TSA<br/>Rayon
                                                </button>
                                            </a>
                                        </div>
                                        <div class="font-icon-list col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                            <a href="" rel="tooltip" title="" data-original-title="">
                                                <button class="font-icon-detail btn btn-info btn-fill btn-wd">
                                                    <i class="pe-7s-folder"></i><br/>Laporan<br/>TSA<br/>Penyulang
                                                </button>
                                            </a>
                                        </div>
                                        <div class="font-icon-list col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                            <a href="" rel="tooltip" title="" data-original-title="">
                                                <button class="font-icon-detail btn btn-info btn-fill btn-wd">
                                                    <i class="pe-7s-graph"></i><br/>Laporan<br/>Deviasi<br/><br/>
                                                </button>
                                            </a>
                                        </div>
                                        <div class="font-icon-list col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                            <a href="" rel="tooltip" title="" data-original-title="">
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
                </div>
            </div>

            @include('admin.master.footer')

        </div>
    </div>
@endsection