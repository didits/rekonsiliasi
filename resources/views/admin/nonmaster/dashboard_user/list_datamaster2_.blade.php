@extends('admin.master.app')

@section('title', 'Si-Oneng, Rekonsiliasi Energi')

@section('content')

    <div class="wrapper">
        @include('admin.master.navbar')

        <div class="main-panel">
            @if($tipe=="gi")
                @include('admin.master.top_navbar', ['navbartitle' => "DATAMASTER GARDU INDUK: " . $nama_rayon])
            @elseif($tipe=="tgi")
                @include('admin.master.top_navbar', ['navbartitle' => "DATAMASTER TRAFO GI: " . $nama['nama_gi']])
            @elseif($tipe=="penyulang")
                @include('admin.master.top_navbar', ['navbartitle' => "DATAMASTER PENYULANG: " . $nama['nama_trafo_gi']])
            @elseif($tipe=="gd")
                @include('admin.master.top_navbar',  ['navbartitle' => "DATAMASTER GD/PCT/TM: " . $nama['nama_penyulang']])
                {{--{{dd($data)}}--}}
            @endif

            <div class="content">
                <div class="container-fluid">

                    @if($tipe=="gd")

                    <div class="row">
                        <div class="col-md-12">
                            <div class="nav-container">
                                <ul class="nav nav-icons" role="tablist">
                                    <li class="active">
                                        <a href="#home-logo" role="tab" data-toggle="tab" aria-expanded="false">
                                            <i class="fa fa-home"></i><br>List GD
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#code-fork-logo" role="tab" data-toggle="tab" aria-expanded="false">
                                            <i class="fa fa-code-fork"></i><br>List PCT
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#industry-logo" role="tab" data-toggle="tab" aria-expanded="false">
                                            <i class="fa fa-industry"></i><br>List Pelanggan TM
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-content">
                                <div class="tab-pane active" id="home-logo">
                                    <div class="content">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card">
                                                    <div class="header">
                                                        <h4 class="title">Dafta GD</h4>
                                                        <p class="category">Daftar GD {{$nama_rayon}} </p>
                                                    </div>
                                                    <div class="content table-responsive table-full-width">
                                                        <table class="table table-hover table-striped">
                                                            <thead>
                                                                <th class="text-center">#</th>
                                                                <th>Nama GD</th>
                                                                <th>Alamat GD</th>
                                                                <th></th>
                                                            </thead>
                                                            <tbody>
                                                                <div class="{{$num = 0}}" style="display: none"></div>
                                                            @if($data==null)
                                                            @else
                                                            @foreach($data as $list)
                                                                @if($list->tipe_gardu == 0)

                                                                <tr>
                                                                    <td class="text-center">{{$num+1}}</td>
                                                                    <td>{{$list->nama_gardu}}</td>
                                                                    <td>{{$list->alamat_gardu}}</td>
                                                                    @if($laporan)

                                                                        <td class="td-actions text-right">
                                                                        @if (Auth::user()->tipe_organisasi == 3)

                                                                            <a href="{{route('rayon.view_datamaster', [$id_organisasi, $tipe, $list->id])}}" rel="tooltip" title="" class="btn btn-info btn-fill" data-original-title="View Datamaster">
                                                                        @else

                                                                            <a href="{{route('area.view_datamaster', [$id_organisasi, $tipe, $list->id])}}" rel="tooltip" title="" class="btn btn-info btn-fill" data-original-title="View Datamaster">
                                                                        @endif

                                                                                <i class="fa fa-info"></i>
                                                                            </a>
                                                                        </td>
                                                                    @elseif($rayon)

                                                                        <td class="td-actions text-right">
                                                                            <a href="{{route('rayon.view_beli', [$id_organisasi, $tipe, $list->id])}}" rel="tooltip" title="" class="btn btn-info btn-fill" data-original-title="View Laporan Beli">
                                                                                <i class="fa fa-info"></i>
                                                                            </a>
                                                                        </td>
                                                                    @elseif($transaksi)

                                                                        <td class="td-actions text-right">
                                                                            <a href="{{route('area.view_beli', [$id_organisasi, $tipe, $list->id])}}" rel="tooltip" title="" class="btn btn-info btn-fill" data-original-title="View Laporan Beli">
                                                                                <i class="fa fa-info"></i>
                                                                            </a>
                                                                        </td>
                                                                    @else

                                                                        <td class="td-actions text-right">
                                                                            <a href="{{url('/area/list_datamaster_gi/'.$id_organisasi.'/'.$list->id)}}" rel="tooltip" title="" class="btn btn-info btn-fill" data-original-title="View Datamaster">
                                                                                <i class="fa fa-user"></i>
                                                                            </a>
                                                                            <a href="#" rel="tooltip" title="" class="btn btn-success btn-fill" data-original-title="Edit Profile"
                                                                               onclick="edit_datamaster.showSwal('gi', {{$list->id}},'{{$list->nama_gi}}','{{$list->alamat_gi}}')">
                                                                                <i class="fa fa-edit"></i>
                                                                            </a>
                                                                            <a href="#" rel="tooltip" title="" class="btn btn-danger btn-fill " data-original-title="Remove"
                                                                               onclick="hapus_datamaster.showSwal('gi', {{$id_organisasi}}, {{$list->id}},'{{$list->nama_gi}}')">
                                                                                <i class="fa fa-times"></i>
                                                                            </a>
                                                                        </td>
                                                                    @endif

                                                                </tr>
                                                                @endif
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

                                <div class="tab-pane" id="code-fork-logo">
                                    <div class="content">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card">
                                                    <div class="header">
                                                        <h4 class="title">Dafta PCT</h4>
                                                        <p class="category">Daftar PCT {{$nama_rayon}} </p>
                                                    </div>
                                                    <div class="content table-responsive table-full-width">
                                                        <table class="table table-hover table-striped">
                                                            <thead>
                                                                <th class="text-center">#</th>
                                                                <th>Nama PCT</th>
                                                                <th>Alamat PCT</th>
                                                                <th></th>
                                                            </thead>
                                                            <tbody>
                                                                <div class="{{$num = 0}}" style="display: none"></div>
                                                            @if($data==null)
                                                            @else
                                                            @foreach($data as $list)
                                                                @if($list->tipe_gardu == 1)

                                                                <tr>
                                                                    <td class="text-center">{{$num+1}}</td>
                                                                    <td>{{$list->nama_gardu}}</td>
                                                                    <td>{{$list->alamat_gardu}}</td>
                                                                    @if($laporan)

                                                                        <td class="td-actions text-right">
                                                                        @if (Auth::user()->tipe_organisasi == 3)

                                                                            <a href="{{route('rayon.view_datamaster', [$id_organisasi, $tipe, $list->id])}}" rel="tooltip" title="" class="btn btn-info btn-fill" data-original-title="View Datamaster">
                                                                        @else

                                                                            <a href="{{route('area.view_datamaster', [$id_organisasi, $tipe, $list->id])}}" rel="tooltip" title="" class="btn btn-info btn-fill" data-original-title="View Datamaster">
                                                                        @endif

                                                                                <i class="fa fa-info"></i>
                                                                            </a>
                                                                        </td>
                                                                    @elseif($rayon)

                                                                        <td class="td-actions text-right">
                                                                            <a href="{{route('rayon.view_beli', [$id_organisasi, $tipe, $list->id])}}" rel="tooltip" title="" class="btn btn-info btn-fill" data-original-title="View Laporan Beli">
                                                                                <i class="fa fa-info"></i>
                                                                            </a>
                                                                        </td>
                                                                    @elseif($transaksi)

                                                                        <td class="td-actions text-right">
                                                                            <a href="{{route('area.view_beli', [$id_organisasi, $tipe, $list->id])}}" rel="tooltip" title="" class="btn btn-info btn-fill" data-original-title="View Laporan Beli">
                                                                                <i class="fa fa-info"></i>
                                                                            </a>
                                                                        </td>
                                                                    @else

                                                                        <td class="td-actions text-right">
                                                                            <a href="{{url('/area/list_datamaster_gi/'.$id_organisasi.'/'.$list->id)}}" rel="tooltip" title="" class="btn btn-info btn-fill" data-original-title="View Datamaster">
                                                                                <i class="fa fa-user"></i>
                                                                            </a>
                                                                            <a href="#" rel="tooltip" title="" class="btn btn-success btn-fill" data-original-title="Edit Profile"
                                                                               onclick="edit_datamaster.showSwal('gi', {{$list->id}},'{{$list->nama_gi}}','{{$list->alamat_gi}}')">
                                                                                <i class="fa fa-edit"></i>
                                                                            </a>
                                                                            <a href="#" rel="tooltip" title="" class="btn btn-danger btn-fill " data-original-title="Remove"
                                                                               onclick="hapus_datamaster.showSwal('gi', {{$id_organisasi}}, {{$list->id}},'{{$list->nama_gi}}')">
                                                                                <i class="fa fa-times"></i>
                                                                            </a>
                                                                        </td>
                                                                    @endif

                                                                </tr>
                                                                @endif
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

                                <div class="tab-pane" id="industry-logo">
                                    <div class="content">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card">
                                                    <div class="header">
                                                        <h4 class="title">Dafta Pelanggan TM</h4>
                                                        <p class="category">Daftar Pelanggan TM {{$nama_rayon}} </p>
                                                    </div>
                                                    <div class="content table-responsive table-full-width">
                                                        <table class="table table-hover table-striped">
                                                            <thead>
                                                                <th class="text-center">#</th>
                                                                <th>Nama Pelanggan TM</th>
                                                                <th>Alamat Pelanggan TM</th>
                                                                <th></th>
                                                            </thead>
                                                            <tbody>
                                                                <div class="{{$num = 0}}" style="display: none"></div>
                                                            @if($data==null)
                                                            @else
                                                            @foreach($data as $list)
                                                                @if($list->tipe_gardu == 2)

                                                                <tr>
                                                                    <td class="text-center">{{$num+1}}</td>
                                                                    <td>{{$list->nama_gardu}}</td>
                                                                    <td>{{$list->alamat_gardu}}</td>
                                                                    @if($laporan)

                                                                        <td class="td-actions text-right">
                                                                        @if (Auth::user()->tipe_organisasi == 3)

                                                                            <a href="{{route('rayon.view_datamaster', [$id_organisasi, $tipe, $list->id])}}" rel="tooltip" title="" class="btn btn-info btn-fill" data-original-title="View Datamaster">
                                                                        @else

                                                                            <a href="{{route('area.view_datamaster', [$id_organisasi, $tipe, $list->id])}}" rel="tooltip" title="" class="btn btn-info btn-fill" data-original-title="View Datamaster">
                                                                        @endif

                                                                                <i class="fa fa-info"></i>
                                                                            </a>
                                                                        </td>
                                                                    @elseif($rayon)

                                                                        <td class="td-actions text-right">
                                                                            <a href="{{route('rayon.view_beli', [$id_organisasi, $tipe, $list->id])}}" rel="tooltip" title="" class="btn btn-info btn-fill" data-original-title="View Laporan Beli">
                                                                                <i class="fa fa-info"></i>
                                                                            </a>
                                                                        </td>
                                                                    @elseif($transaksi)

                                                                        <td class="td-actions text-right">
                                                                            <a href="{{route('area.view_beli', [$id_organisasi, $tipe, $list->id])}}" rel="tooltip" title="" class="btn btn-info btn-fill" data-original-title="View Laporan Beli">
                                                                                <i class="fa fa-info"></i>
                                                                            </a>
                                                                        </td>
                                                                    @else

                                                                        <td class="td-actions text-right">
                                                                            <a href="{{url('/area/list_datamaster_gi/'.$id_organisasi.'/'.$list->id)}}" rel="tooltip" title="" class="btn btn-info btn-fill" data-original-title="View Datamaster">
                                                                                <i class="fa fa-user"></i>
                                                                            </a>
                                                                            <a href="#" rel="tooltip" title="" class="btn btn-success btn-fill" data-original-title="Edit Profile"
                                                                               onclick="edit_datamaster.showSwal('gi', {{$list->id}},'{{$list->nama_gi}}','{{$list->alamat_gi}}')">
                                                                                <i class="fa fa-edit"></i>
                                                                            </a>
                                                                            <a href="#" rel="tooltip" title="" class="btn btn-danger btn-fill " data-original-title="Remove"
                                                                               onclick="hapus_datamaster.showSwal('gi', {{$id_organisasi}}, {{$list->id}},'{{$list->nama_gi}}')">
                                                                                <i class="fa fa-times"></i>
                                                                            </a>
                                                                        </td>
                                                                    @endif

                                                                </tr>
                                                                @endif
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
                            </div>
                        </div>
                    </div>

                    @else

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="header">
                                @if($tipe=="gi")

                                    <h4 class="title">Daftar Gardu Induk</h4>
                                    <p class="category">Daftar Gardu Induk Rayon {{$nama_rayon}} </p>
                                @elseif($tipe=="tgi")

                                    <h4 class="title">Daftar Trafo GI</h4>
                                    <p class="category">Daftar Trafo GI {{$nama_rayon}} </p>
                                @elseif($tipe=="penyulang")

                                    <h4 class="title">Daftar Penyulang</h4>
                                    <p class="category">Daftar Penyulang {{$nama_rayon}} </p>
                                @endif

                                </div>
                                <div class="content table-responsive table-full-width">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                        @if($tipe=="gi")
                                            <th>Nama Gardu Induk</th>
                                            <th>Alamat Gardu Induk</th>
                                        @elseif($tipe=="tgi")

                                            <th>Nama Trafo GI</th>
                                            <th>Alamat Trafo GI</th>
                                        @elseif($tipe=="penyulang")

                                            <th>Nama Penyulang</th>
                                            <th>Alamat Penyulang</th>
                                        @endif

                                            <th></th>
                                        </thead>
                                        <tbody>
                                        @if($data==null)
                                        @else
                                        @foreach($data as $list)

                                            <tr>
                                                <td>
                                                    {{--<a href="{{url('/area/list_datamaster_trafo/'.$id_organisasi.'/'.$list->id)}}"> {{$list->nama_gi}} </a>--}}
                                                    @if($tipe=="gi")
                                                        {{$list->nama_gi}}
                                                    @elseif($tipe=="tgi")
                                                        {{$list->nama_trafo_gi}}
                                                    @elseif($tipe=="penyulang")
                                                        {{$list->nama_penyulang}}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($tipe=="gi")
                                                        {{$list->alamat_gi}}
                                                    @elseif($tipe=="tgi")
                                                        {{$list->alamat_trafo_gi}}
                                                    @elseif($tipe=="penyulang")
                                                        {{$list->alamat_penyulang}}
                                                    @endif
                                                </td>
                                                @if($laporan)

                                                    <td class="td-actions text-right">
                                                        {{--@if($list->nama_organisasi)--}}
                                                        {{--<a href="{{url('/area/laporan_master_list/'.$list->id_organisasi.'/'.$list->id_organisasi)}}" class="btn btn-info btn-fill pull-right" >List GI</a>--}}
                                                        {{--@elseif($list->id_gi)--}}
                                                        {{--<a href="{{url('/area/laporan_master_list/'.$id_org.'/'.$list->id)}}" class="btn btn-info btn-fill pull-right" >List GI</a>--}}
                                                        {{--@endif--}}
                                                        {{--{{dd($tipe)}}--}}
                                                        @if (Auth::user()->tipe_organisasi == 3)

                                                        <a href="{{route('rayon.view_datamaster', [$id_organisasi, $tipe, $list->id])}}" rel="tooltip" title="" class="btn btn-info btn-fill" data-original-title="View Datamaster">
                                                        @else

                                                        <a href="{{route('area.view_datamaster', [$id_organisasi, $tipe, $list->id])}}" rel="tooltip" title="" class="btn btn-info btn-fill" data-original-title="View Datamaster">
                                                        @endif

                                                            <i class="fa fa-info"></i>
                                                        </a>
                                                        @if($tipe=="gi")
                                                            @if (Auth::user()->tipe_organisasi == 3)

                                                            <a href="{{route('rayon.list_master', [$id_organisasi ,'tgi', $list->id])}}" rel="tooltip" title="" class="btn btn-success btn-fill" data-original-title="List Trafo GI">
                                                            @else

                                                            <a href="{{route('area.list_master', [$id_organisasi ,'tgi', $list->id])}}" rel="tooltip" title="" class="btn btn-success btn-fill" data-original-title="List Trafo GI">
                                                            @endif

                                                                <i class="fa fa-th-list"></i>
                                                            </a>
                                                        @elseif($tipe=="tgi")
                                                            @if (Auth::user()->tipe_organisasi == 3)

                                                            <a href="{{route('rayon.list_master', [$id_organisasi ,'penyulang', $list->id])}}" rel="tooltip" title="" class="btn btn-success btn-fill" data-original-title="List Penyulang">
                                                            @else

                                                            <a href="{{route('area.list_master', [$id_organisasi ,'penyulang', $list->id])}}" rel="tooltip" title="" class="btn btn-success btn-fill" data-original-title="List Penyulang">
                                                            @endif

                                                                <i class="fa fa-th-list"></i>
                                                            </a>
                                                        @elseif($tipe=="penyulang")
                                                            @if (Auth::user()->tipe_organisasi == 3)

                                                            <a href="{{route('rayon.list_master', [$id_organisasi ,'gtt_pct', $list->id])}}" rel="tooltip" title="" class="btn btn-success btn-fill" data-original-title="List GTT, PCT, TM">
                                                            @else

                                                            <a href="{{route('area.list_master', [$id_organisasi ,'gtt_pct', $list->id])}}" rel="tooltip" title="" class="btn btn-success btn-fill" data-original-title="List GTT, PCT, TM">
                                                            @endif

                                                                <i class="fa fa-th-list"></i>
                                                            </a>
                                                        {{--@elseif($tipe=="gd")--}}
                                                            {{--<a href="" rel="tooltip" title="" class="btn btn-success btn-fill" data-original-title="List Trafo GI">--}}
                                                                {{--<i class="fa fa-th-list"></i>--}}
                                                            {{--</a>--}}
                                                        @endif
                                                        {{--<a href="{{route('area.view_datamaster', [$id_organisasi, 'gi', $list->id])}}" rel="tooltip" title="" class="btn btn-info btn-fill" data-original-title="View Datamaster">--}}
                                                        {{--<i class="fa fa-info"></i>--}}
                                                        {{--</a>--}}
                                                        {{--<a href="{{url('/area/laporan_master_list/'.$id_organisasi.'/tgi/'.$list->id)}}" rel="tooltip" title="" class="btn btn-success btn-fill" data-original-title="List Trafo GI">--}}
                                                        {{--<i class="fa fa-th-list"></i>--}}
                                                        {{--</a>--}}
                                                    </td>
                                                @elseif($rayon)

                                                    <td class="td-actions text-right">
                                                        <a href="{{route('rayon.view_beli', [$id_organisasi, $tipe, $list->id])}}" rel="tooltip" title="" class="btn btn-info btn-fill" data-original-title="View Laporan Beli">
                                                            <i class="fa fa-info"></i>
                                                        </a>
                                                        @if($tipe=="gi")
                                                            <a href="{{route('rayon.list_beli', [$id_organisasi, 'tgi', $list->id])}}" rel="tooltip" title="" class="btn btn-success btn-fill" data-original-title="List Trafo GI">
                                                                <i class="fa fa-th-list"></i>
                                                            </a>
                                                            <a href="{{route('rayon.view_beli_tsa', [$list->id_organisasi, 'gi', $list->id])}}" rel="tooltip" title="" class="btn btn-warning btn-fill" data-original-title="View TSA Penyulang">
                                                                <i class="fa fa-folder"></i>
                                                            </a>
                                                            <a href="{{route('rayon.view_beli_deviasi', [$list->id_organisasi, 'gi', $list->id])}}" rel="tooltip" title="" class="btn btn-warning btn-fill" data-original-title="View Deviasi">
                                                                <i class="fa fa-pie-chart"></i>
                                                            </a>
                                                        @elseif($tipe=="tgi")
                                                            <a href="{{route('rayon.list_beli', [$id_organisasi, 'penyulang', $list->id])}}" rel="tooltip" title="" class="btn btn-success btn-fill" data-original-title="List Penyulang">
                                                                <i class="fa fa-th-list"></i>
                                                            </a>
                                                        @elseif($tipe=="penyulang")
                                                            <a href="{{route('rayon.list_beli', [$id_organisasi, 'gtt_pct', $list->id])}}" rel="tooltip" title="" class="btn btn-success btn-fill" data-original-title="List GD, PCT, TM">
                                                                <i class="fa fa-th-list"></i>
                                                            </a>
                                                            {{--@elseif($tipe=="gd")--}}
                                                            {{--<a href="#" rel="tooltip" title="" class="btn btn-success btn-fill" data-original-title="List">--}}
                                                            {{--<i class="fa fa-th-list"></i>--}}
                                                            {{--</a>--}}
                                                        @endif
                                                        {{--<a href="{{route('area.view_datamaster', [$id_organisasi, 'gi', $list->id])}}" rel="tooltip" title="" class="btn btn-info btn-fill" data-original-title="View Datamaster">--}}
                                                        {{--<i class="fa fa-info"></i>--}}
                                                        {{--</a>--}}
                                                        {{--<a href="{{url('/area/laporan_master_list/'.$id_organisasi.'/tgi/'.$list->id)}}" rel="tooltip" title="" class="btn btn-success btn-fill" data-original-title="List Trafo GI">--}}
                                                        {{--<i class="fa fa-th-list"></i>--}}
                                                        {{--</a>--}}
                                                    </td>
                                                @elseif($transaksi)

                                                    <td class="td-actions text-right">
                                                        <a href="{{route('area.view_beli', [$id_organisasi, $tipe, $list->id])}}" rel="tooltip" title="" class="btn btn-info btn-fill" data-original-title="View Laporan Beli">
                                                            <i class="fa fa-info"></i>
                                                        </a>
                                                        @if($tipe=="gi")
                                                            <a href="{{route('area.list_beli', [$id_organisasi, 'tgi', $list->id])}}" rel="tooltip" title="" class="btn btn-success btn-fill" data-original-title="List Trafo GI">
                                                                <i class="fa fa-th-list"></i>
                                                            </a>
                                                            <a href="{{route('area.view_beli_tsa', [$list->id_organisasi, 'gi', $list->id])}}" rel="tooltip" title="" class="btn btn-warning btn-fill" data-original-title="View TSA Penyulang">
                                                                <i class="fa fa-folder"></i>
                                                            </a>
                                                            <a href="{{route('area.view_beli_deviasi', [$list->id_organisasi, 'gi', $list->id])}}" rel="tooltip" title="" class="btn btn-warning btn-fill" data-original-title="View Deviasi">
                                                                <i class="fa fa-pie-chart"></i>
                                                            </a>
                                                        @elseif($tipe=="tgi")
                                                            <a href="{{route('area.list_beli', [$id_organisasi, 'penyulang', $list->id])}}" rel="tooltip" title="" class="btn btn-success btn-fill" data-original-title="List Penyulang">
                                                                <i class="fa fa-th-list"></i>
                                                            </a>
                                                        @elseif($tipe=="penyulang")
                                                            <a href="{{route('area.list_beli', [$id_organisasi, 'gtt_pct', $list->id])}}" rel="tooltip" title="" class="btn btn-success btn-fill" data-original-title="List GTT, PCT, TM">
                                                                <i class="fa fa-th-list"></i>
                                                            </a>
                                                        {{--@elseif($tipe=="gd")--}}
                                                            {{--<a href="#" rel="tooltip" title="" class="btn btn-success btn-fill" data-original-title="List">--}}
                                                                {{--<i class="fa fa-th-list"></i>--}}
                                                            {{--</a>--}}
                                                        @endif
                                                        {{--<a href="{{route('area.view_datamaster', [$id_organisasi, 'gi', $list->id])}}" rel="tooltip" title="" class="btn btn-info btn-fill" data-original-title="View Datamaster">--}}
                                                        {{--<i class="fa fa-info"></i>--}}
                                                        {{--</a>--}}
                                                        {{--<a href="{{url('/area/laporan_master_list/'.$id_organisasi.'/tgi/'.$list->id)}}" rel="tooltip" title="" class="btn btn-success btn-fill" data-original-title="List Trafo GI">--}}
                                                        {{--<i class="fa fa-th-list"></i>--}}
                                                        {{--</a>--}}
                                                    </td>
                                                @else

                                                    <td class="td-actions text-right">
                                                        <a href="{{url('/area/list_datamaster_gi/'.$id_organisasi.'/'.$list->id)}}" rel="tooltip" title="" class="btn btn-info btn-fill" data-original-title="View Datamaster">
                                                            <i class="fa fa-user"></i>
                                                        </a>
                                                        <a href="#" rel="tooltip" title="" class="btn btn-success btn-fill" data-original-title="Edit Profile"
                                                           onclick="edit_datamaster.showSwal('gi', {{$list->id}},'{{$list->nama_gi}}','{{$list->alamat_gi}}')">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <a href="#" rel="tooltip" title="" class="btn btn-danger btn-fill " data-original-title="Remove"
                                                           onclick="hapus_datamaster.showSwal('gi', {{$id_organisasi}}, {{$list->id}},'{{$list->nama_gi}}')">
                                                            <i class="fa fa-times"></i>
                                                        </a>
                                                    </td>
                                                @endif
                                                {{--<td>--}}
                                                {{--<a class="btn btn-info btn-fill pull-right" href="{{url('/area/list_datamaster_list_trafo_gi/'.$id_organisasi.'/'.$list->id)}}">Lihat Datamaster</a></td>--}}
                                                {{--<a href="{{url('/area/list_datamaster_gi/'.$id_organisasi.'/'.$list->id)}}" class="btn btn-info btn-fill pull-right" >Lihat Datamaster</a>--}}
                                                {{--</td>--}}
                                            </tr>
                                        @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                {{--Transfer--}}
                {{--@if(!$laporan && !$transaksi && !$rayon)--}}
                    {{--<div class="row">--}}
                        {{--<div class="col-md-12">--}}
                            {{--<div class="card">--}}
                                {{--<div class="header">--}}
                                    {{--<h4 class="title">Daftar PCT</h4>--}}
                                    {{--<p class="category">Daftar PCT Rayon {{$nama_rayon}} </p>--}}
                                {{--</div>--}}
                                {{--<div class="content table-responsive table-full-width">--}}
                                    {{--<table class="table table-hover table-striped">--}}
                                        {{--<thead>--}}
                                        {{--@if($tipe=="gi")--}}
                                            {{--<th>Nama Gardu Induk</th>--}}
                                            {{--<th>Alamat Gardu Induk</th>--}}
                                        {{--@elseif($tipe=="tgi")--}}
                                            {{--<th>Nama Trafo GI</th>--}}
                                            {{--<th>Alamat Trafo GI</th>--}}
                                        {{--@elseif($tipe=="penyulang")--}}
                                            {{--<th>Nama Penyulang</th>--}}
                                            {{--<th>Alamat Penyulang</th>--}}
                                        {{--@elseif($tipe=="gd")--}}
                                            {{--<th>Nama Gardu</th>--}}
                                            {{--<th>Alamat Gardu</th>--}}
                                        {{--@endif--}}
                                        {{--<th></th>--}}
                                        {{--</thead>--}}
                                        {{--<tbody>--}}
                                        {{--@foreach($data2 as $list)--}}

                                            {{--<tr>--}}
                                                {{--<td>--}}
                                                    {{--{{$list->nama_gi}}--}}
                                                {{--</td>--}}
                                                {{--<td> {{$list->alamat_gi}} </td>--}}
                                                {{--<td class="td-actions text-right">--}}
                                                    {{--<a href="{{url('/area/list_datamaster_list_trafo_gi_transfer/'.$list->id_organisasi.'/'.$list->id_gi)}}" rel="tooltip" title="" class="btn btn-info btn-fill" data-original-title="View List Trafo GI">--}}
                                                        {{--<i class="fa fa-user"></i>--}}
                                                    {{--</a>--}}
                                                {{--</td>--}}
                                                {{--<td>--}}
                                                {{--<a href="{{url('/area/list_datamaster_list_trafo_gi_transfer/'.$list->id_organisasi.'/'.$list->id_gi)}}">Lihat--}}
                                                {{--List Trafo Gardu</a>--}}
                                                {{--</td>--}}
                                            {{--</tr>--}}
                                        {{--@endforeach--}}

                                        {{--</tbody>--}}
                                    {{--</table>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="row">--}}
                        {{--<div class="col-md-12">--}}
                            {{--<div class="card">--}}
                                {{--<form action="{{route('input_datamaster.store')}}" method="post">--}}
                                    {{--<input type="hidden" name="_method" value="POST">--}}
                                    {{--<input type="hidden" name="id_organisasi" value="{{$id_organisasi}}">--}}
                                    {{--{{ csrf_field() }}--}}
                                    {{--<form id="registerFormValidation" action="{{route('input_datamaster.create')}}" method="post" method="" novalidate="novalidate">--}}
                                    {{--{{ csrf_field() }}--}}
                                    {{--<div class="header">Tambah Gardu Induk</div>--}}
                                    {{--<div class="content">--}}
                                        {{--<div class="form-group">--}}
                                            {{--<label class="control-label">Nama Gardu Induk--}}
                                                {{--<star>*</star>--}}
                                            {{--</label>--}}
                                            {{--<input class="form-control" name="tambahnamagardu" type="text"--}}
                                                   {{--required="required" aria-required="true">--}}
                                        {{--</div>--}}

                                        {{--<div class="form-group">--}}
                                            {{--<label class="control-label">Alamat Gardu Induk--}}
                                                {{--<star>*</star>--}}
                                            {{--</label>--}}
                                            {{--<input class="form-control" name="tambahalamatgardu" type="text"--}}
                                                   {{--required="required" aria-required="true">--}}
                                        {{--</div>--}}

                                        {{--<div class="form-group">--}}
                                            {{--<label class="control-label">Rayon--}}
                                                {{--<star>*</star>--}}
                                            {{--</label>--}}
                                            {{--<input class="form-control" name="tambahnamarayon" type="text" disabled=""--}}
                                                   {{--value="{{$nama_rayon}}" required="required" aria-required="true">--}}
                                        {{--</div>--}}

                                        {{--<div class="category">--}}
                                            {{--<star>*</star>--}}
                                            {{--Required fields--}}
                                        {{--</div>--}}
                                    {{--</div>--}}

                                    {{--<div class="footer">--}}
                                        {{--<button type="submit" class="btn btn-info btn-fill pull-right">Tambah Gardu</button>--}}
                                        {{--<div class="clearfix"></div>--}}
                                    {{--</div>--}}
                                {{--</form>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--@endif--}}

                </div>
            </div>

            @include('admin.master.footer')

        </div>
    </div>
@endsection