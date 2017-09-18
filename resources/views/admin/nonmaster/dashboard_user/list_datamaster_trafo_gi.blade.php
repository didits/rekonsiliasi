@extends('admin.master.app')
@section('title', 'Si-Oneng, Rekonsiliasi Energi')

@section('content')
    <div class="wrapper">
        @include('admin.master.navbar')
        <div class="main-panel">
            @if($nama_gi)
            @include('admin.master.top_navbar', ['navbartitle' => "LIST TRAFO GARDU INDUK, GARDU INDUK " . $nama_gi . ", RAYON " . $nama_rayon])
            @elseif($nama_tgi)
            @include('admin.master.top_navbar', ['navbartitle' => "LIST TRAFO GARDU INDUK, GARDU INDUK " . $nama_tgi . ", RAYON " . $nama_rayon])
            @endif
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12"> 
                            <div class="card">
                                <div class="header">
                                    <h4 class="title">Daftar Trafo Gardu Induk</h4>
                                    <p class="category">Daftar Trafo Gardu Induk, {{ $nama_gi }}, RAYON {{$nama_rayon}} </p>
                                </div>
                                <div class="content table-responsive table-full-width">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <th>Nama Trafo Gardu Induk</th>
                                            <th>Alamat Trafo Gardu Induk</th>
                                            <th></th>
                                        </thead>
                                        <tbody>

                                        @foreach($data as $list)
                                            <tr>
                                                {{--{{dd($data)}}--}}
                                                {{--@if($list->id_gi)--}}
                                                    {{--<td><a href="{{url('/area/list_datamaster_trafo_gi/'.$id_organisasi.'/'.$list->id)}}"> {{$list->nama_trafo_gi}} </a></td>--}}
                                                {{--@else--}}
                                                @if($nama_gi)
                                                    <td> {{$list->nama_trafo_gi}} </td>
                                                    <td> {{$list->alamat_trafo_gi}} </td>
                                                @elseif($nama_tgi)
                                                    <td> {{$list->nama_penyulang}} </td>
                                                    <td> {{$list->alamat_penyulang}} </td>
                                                @endif
                                                {{--@if($list->id_gi)--}}
                                                    {{--<td><a href="{{url('/area/list_datamaster_list_penyulang/'.$id_organisasi.'/'.$list->id)}}">Lihat List Penyulang</a></td>--}}
                                                {{--@else--}}
                                                    {{--<td><a href="{{url('/area/list_datamaster_list_penyulang_transfer/'.$id_organisasi.'/'.$list->id)}}">Lihat List Penyulang</a></td>--}}
                                                {{--@endif--}}

                                                <td class="td-actions text-right">

                                                    @if($nama_gi)
                                                        <a href="{{url('/area/list_datamaster_list_penyulang_transfer/'.$id_organisasi.'/'.$list->id)}}" rel="tooltip" title="" class="btn btn-info btn-fill" data-original-title="View List Trafo GI">
                                                        <i class="fa fa-user"></i>
                                                    </a>
                                                    @elseif($nama_tgi)
                                                   {{--<a href="{{url('/area/list_datamaster_penyulang/'."t".$id_organisasi.'/'.$list->id)}}"> {{$list->nama_penyulang}} </a>--}}
                                                        {{--<a href="{{url('/area/list_datamaster_list_penyulang_transfer/'.$list->id_organisasi.'/'.$list->id_trafo_gi)}}" rel="tooltip" title="" class="btn btn-info btn-fill" data-original-title="View List Trafo GI">--}}
                                                        {{--<i class="fa fa-user"></i>--}}
                                                        {{--</a>--}}
                                                    <a href="{{url('/area/list_datamaster_penyulang/'."t".$list->id_organisasi.'/'.$list->id)}}" rel="tooltip" title="" class="btn btn-info btn-fill" data-original-title="View List Trafo GI">
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
                </div>
            </div>

            @include('admin.master.footer')

        </div>
    </div>
@endsection