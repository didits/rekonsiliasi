@extends('admin.master.app')

@section('title', 'Si-Oneng, Rekonsiliasi Energi')

@section('content')

    <div class="wrapper">
        @include('admin.master.navbar')

        <div class="main-panel">
            @include('admin.master.top_navbar', ['navbartitle' => "LIST GARDU INDUK RAYON " . $nama_rayon])

            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title">Daftar Gardu Induk</h4>
                                    <p class="category">Daftar Gardu Induk Rayon {{$nama_rayon}} </p>
                                </div>
                                <div class="content table-responsive table-full-width">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <th>Nama Gardu Induk</th>
                                            <th>Alamat Gardu Induk</th>
                                            <th></th>
                                        </thead>
                                        <tbody>
                                        @foreach($data as $list)

                                            <tr>
                                                <td>
                                                    {{--<a href="{{url('/area/list_datamaster_trafo/'.$id_organisasi.'/'.$list->id)}}"> {{$list->nama_gi}} </a>--}}
                                                     {{$list->nama_gi}}
                                                </td>
                                                <td> {{$list->alamat_gi}} </td>
                                                @if($laporan)

                                                <td class="td-actions text-right">
                                                        <a href="{{url('/area/list_datamaster_gi/'.$id_organisasi.'/'.$list->id)}}" rel="tooltip" title="" class="btn btn-info btn-fill" data-original-title="View Datamaster">
                                                            <i class="fa fa-info"></i>
                                                        </a>
                                                        <a href="{{url('/area/list_datamaster_list_trafo_gi/'.$id_organisasi.'/'.$list->id)}}"" rel="tooltip" title="" class="btn btn-success btn-fill" data-original-title="List Trafo GI">
                                                            <i class="fa fa-th-list"></i>
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
                                                {{--<td>--}}
                                                    {{--<a class="btn btn-info btn-fill pull-right" href="{{url('/area/list_datamaster_list_trafo_gi/'.$id_organisasi.'/'.$list->id)}}">Lihat Datamaster</a></td>--}}
                                                    {{--<a href="{{url('/area/list_datamaster_gi/'.$id_organisasi.'/'.$list->id)}}" class="btn btn-info btn-fill pull-right" >Lihat Datamaster</a>--}}
                                                {{--</td>--}}
                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{--Transfer--}}
                    @if(!$laporan)
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title">Daftar PCT</h4>
                                    <p class="category">Daftar PCT Rayon {{$nama_rayon}} </p>
                                </div>
                                <div class="content table-responsive table-full-width">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <th>Nama Gardu Induk</th>
                                            <th>Alamat Gardu Induk</th>
                                            <th></th>
                                        </thead>
                                        <tbody>
                                        @foreach($data2 as $list)

                                            <tr>
                                                <td>
                                                    {{$list->nama_gi}}
                                                </td>
                                                <td> {{$list->alamat_gi}} </td>
                                                <td class="td-actions text-right">
                                                    <a href="{{url('/area/list_datamaster_list_trafo_gi_transfer/'.$list->id_organisasi.'/'.$list->id_gi)}}" rel="tooltip" title="" class="btn btn-info btn-fill" data-original-title="View List Trafo GI">
                                                        <i class="fa fa-user"></i>
                                                    </a>
                                                </td>
                                                {{--<td>--}}
                                                    {{--<a href="{{url('/area/list_datamaster_list_trafo_gi_transfer/'.$list->id_organisasi.'/'.$list->id_gi)}}">Lihat--}}
                                                        {{--List Trafo Gardu</a>--}}
                                                {{--</td>--}}
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
                                <form action="{{route('input_datamaster.store')}}" method="post">
                                    <input type="hidden" name="_method" value="POST">
                                    <input type="hidden" name="id_organisasi" value="{{$id_organisasi}}">
                                    {{ csrf_field() }}
                                    {{--<form id="registerFormValidation" action="{{route('input_datamaster.create')}}" method="post" method="" novalidate="novalidate">--}}
                                    {{--{{ csrf_field() }}--}}
                                    <div class="header">Tambah Gardu Induk</div>
                                    <div class="content">
                                        <div class="form-group">
                                            <label class="control-label">Nama Gardu Induk
                                                <star>*</star>
                                            </label>
                                            <input class="form-control" name="tambahnamagardu" type="text"
                                                   required="required" aria-required="true">
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Alamat Gardu Induk
                                                <star>*</star>
                                            </label>
                                            <input class="form-control" name="tambahalamatgardu" type="text"
                                                   required="required" aria-required="true">
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Rayon
                                                <star>*</star>
                                            </label>
                                            <input class="form-control" name="tambahnamarayon" type="text" disabled=""
                                                   value="{{$nama_rayon}}" required="required" aria-required="true">
                                        </div>

                                        <div class="category">
                                            <star>*</star>
                                            Required fields
                                        </div>
                                    </div>

                                    <div class="footer">
                                        <button type="submit" class="btn btn-info btn-fill pull-right">Tambah Gardu</button>
                                        <div class="clearfix"></div>
                                    </div>
                                </form>
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