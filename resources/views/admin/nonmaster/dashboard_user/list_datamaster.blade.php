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
                                                <a href="{{route('area.get_structure', $list->id)}}" class="btn btn-info btn-fill pull-right" style="margin-left:5pt">Single line</a>

                                                @endif
                                                @if($laporan)
                                                <a href="{{route('area.list_master_gi', $list->id_organisasi)}}" class="btn btn-info btn-fill pull-right" >List GI</a>
                                                @elseif($transaksi)
                                                <a href="{{route('area.view_beli_deviasi', [$list->id_organisasi, 'rayon',  $list->id])}}" style="margin-left:5pt"  class="btn btn-success btn-fill pull-right">View Deviasi</a>
                                                <a href="{{route('area.view_beli_tsa', [$list->id_organisasi, 'rayon', $list->id])}}" style="margin-left:5pt"  class="btn btn-success btn-fill pull-right">View TSA Penyulang</a>
                                                <a href="{{route('area.list_beli_gi', $list->id_organisasi)}}" class="btn btn-info btn-fill pull-right">List GI</a>

                                                @else
                                                <a href="{{route('area.list_datamaster', $list->id_organisasi)}}" class="btn btn-info btn-fill pull-right" >List GI</a>

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
                                        <div class="font-icon-list col-md-2">
                                            <a href="{{route('area.view_beli_tsa', [Auth::user()->id_organisasi, 'area', 0])}}" rel="tooltip" title="" data-original-title="">
                                                <button class="font-icon-detail btn btn-info btn-fill btn-wd"><i class="pe-7s-folder"></i><br/>Laporan<br/>TSA<br/>Penyulang</button>
                                            </a>
                                        </div>
                                        <div class="font-icon-list col-md-2">
                                            <a href="{{route('area.view_beli_deviasi', [Auth::user()->id_organisasi, 'area', 0])}}" rel="tooltip" title="" data-original-title="">
                                                <button class="font-icon-detail btn btn-info btn-fill btn-wd"><i class="pe-7s-graph"></i><br/>Laporan<br/>Deviasi<br/><br/></button>
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