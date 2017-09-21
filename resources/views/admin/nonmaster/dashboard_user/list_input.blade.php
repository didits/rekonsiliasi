@extends('admin.master.app')
@section('title', 'Si-Oneng, Rekonsiliasi Energi')

@section('content')

<div class="wrapper">
@include('admin.master.navbar')

    <div class="main-panel">
        @include('admin.master.top_navbar', ['navbartitle' => "RAYON " .    Auth::user()->nama_organisasi])

        <div class="content">
            <div class="container-fluid">
                @if(!$gi)

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                @if($gi)

                                <h4 class="title">Gardu Induk {{$gi->nama_gi}}</h4>
                                @elseif($t_gi)

                                <h4 class="title">Trafo GI {{$t_gi->nama_trafo_gi}}</h4>
                                @elseif($penyulang)

                                <h4 class="title">Penyulang {{$penyulang->nama_penyulang}}</h4>
                                @endif

                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                    @if($gi)

                                        <th>Nama Gardu Induk</th>
                                        <th>Alamat Gardu Induk</th>
                                        <th class="td-actions text-right">Input Gardu Induk</th>
                                    @elseif($t_gi)

                                        <th>Nama Trafo GI</th>
                                        <th>Alamat Trafo GI</th>
                                        <th class="td-actions text-right">Input Trafo GI</th>
                                    @elseif($penyulang)

                                        <th>Nama Penyulang</th>
                                        <th class="td-actions text-right">Input Penyulang</th>
                                    @endif

                                    </thead>
                                    <tbody>
                                    <tr>
                                        @if($gi)

                                            <td>{{$gi->nama_gi}}</td>
                                            <td>{{$gi->alamat_gi}}</td>
                                            <td class="td-actions text-right">
                                                <a href="{{url("/rayon/input_data/$gi->id/gi")}}" rel="tooltip" title="" class="btn btn-success btn-fill" data-original-title="Input Transaksi Beli Gardu Induk">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            </td>
                                        @elseif($t_gi)

                                            <td>{{$t_gi->nama_trafo_gi}}</td>
                                            <td>{{$t_gi->alamat_trafo_gi}}</td>
                                            <td class="td-actions text-right">
                                                <a href="{{url("/rayon/input_data/$t_gi->id/trafo_gi")}}" rel="tooltip" title="" class="btn btn-success btn-fill" data-original-title="Input Transaksi Beli Trafo GI">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            </td>
                                        @elseif($penyulang)

                                            <td>{{$penyulang->nama_penyulang}}</td>
                                            <td>{{$penyulang->alamat_penyulang}}</td>
                                            <td class="td-actions text-right">
                                                <a href="{{url("/rayon/input_data/$penyulang->id/penyulang")}}" rel="tooltip" title="" class="btn btn-success btn-fill" data-original-title="Input Transaksi Beli Penyulang">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            </td>
                                        @endif

                                    </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <div class="row">
                    <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            @if($gi)

                                <h4 class="title">List Trafo GI pada Gardu Induk {{$gi->nama_gi}}</h4>
                            @elseif($t_gi)

                                <h4 class="title">List Penyulang pada Trafo GI {{$t_gi->nama_gi}}</h4>
                            @elseif($penyulang)

                                <h4 class="title">List Gardu/PCT/TM pada Penyulang {{$penyulang->nama_gi}}</h4>
                            @endif

                        </div>
                        <div class="content table-responsive table-full-width">
                            <table class="table table-hover table-striped">
                                <thead>
                                @if($gi)

                                    <th>Nama Trafo GI</th>
                                    <th>Alamat Trafo GI</th>
                                @elseif($t_gi)

                                    <th>Nama Penyulang</th>
                                    <th>Alamat Penyulang</th>
                                @elseif($penyulang)

                                    <th>Nama Gardu</th>
                                    <th>Alamat Gardu</th>
                                    <th>Tipe</th>
                                @endif

                                <th></th>
                                </thead>
                                <tbody>
                                {{--{{dd($data)}}--}}

                                @if($data)
                                    @foreach($data as $list)
                                        <tr>
                                            @if($gi)

                                                <td>{{$list->nama_trafo_gi}}</td>
                                                <td>{{$list->alamat_trafo_gi}}</td>
                                                <td class="td-actions text-right">
                                                    <a href="{{url("/rayon/input_data/$list->id/trafo_gi")}}" rel="tooltip" title="" class="btn btn-success btn-fill" data-original-title="Input Transaksi">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a href="{{route('input.list_penyulang', $list->id)}}" rel="tooltip" title="" class="btn btn-info btn-fill" data-original-title="Lihat List Penyulang">
                                                        <i class="fa fa-th-list"></i>
                                                    </a>
                                                </td>
                                            @elseif($t_gi)

                                                <td>{{$list->nama_penyulang}}</td>
                                                <td>{{$list->alamat_penyulang}}</td>
                                                <td class="td-actions text-right">
                                                    <a href="{{url("/rayon/input_data/$list->id/penyulang")}}" rel="tooltip" title="" class="btn btn-success btn-fill" data-original-title="Input Transaksi">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a href="{{route('input.list_gd', $list->id)}}" rel="tooltip" title="" class="btn btn-info btn-fill" data-original-title="Lihat List Gardu">
                                                        <i class="fa fa-th-list"></i>
                                                    </a>
                                                </td>
                                            @elseif($penyulang)

                                                <td>{{$list->nama_gardu}}</td>
                                                <td>{{$list->alamat_gardu}}</td>
                                                @if($list->tipe_gardu == 0)

                                                <td>GD</td>
                                                <td class="td-actions text-right">
                                                    <a href="{{url("/rayon/input_data/$list->id/gd")}}" rel="tooltip" title="" class="btn btn-success btn-fill" data-original-title="Input Transaksi">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                </td>
                                                @elseif($list->tipe_gardu == 1)

                                                <td>PCT</td>
                                                <td class="td-actions text-right">
                                                    <a href="{{url("/rayon/input_data/$list->id/pct")}}" rel="tooltip" title="" class="btn btn-success btn-fill" data-original-title="Input Transaksi">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                </td>
                                                @elseif($list->tipe_gardu == 2)

                                                <td>TM</td>
                                                <td class="td-actions text-right">
                                                    <a href="{{url("/rayon/input_data/$list->id/tm")}}" rel="tooltip" title="" class="btn btn-success btn-fill" data-original-title="Input Transaksi">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                </td>
                                                @endif
                                            @endif

                                        </tr>
                                    @endforeach
                                @endif
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